<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentCollaborator;
use App\Models\User;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    /**
     * Mengundang collaborator berdasarkan email.
     */
    public function invite(Request $request, Document $document)
    {
        $request->validate([
            'email' => 'required|email',
            'role'  => 'required|in:editor,viewer',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        // Jangan invite diri sendiri
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Tidak dapat mengundang diri sendiri.');
        }

        // Cek apakah sudah menjadi collaborator
        $exists = DocumentCollaborator::where('document_id', $document->id)
                    ->where('user_id', $user->id)
                    ->exists();

        if ($exists) {
            return back()->with('error', 'User sudah menjadi collaborator.');
        }

        // Simpan collaborator
        DocumentCollaborator::create([
            'document_id' => $document->id,
            'user_id'     => $user->id,
            'role'        => $request->role,
        ]);

        return back()->with('success', 'Collaborator berhasil ditambahkan.');
    }

    /**
     * Menghapus collaborator.
     */
    public function destroy(Document $document, User $user)
    {
        DocumentCollaborator::where('document_id', $document->id)
            ->where('user_id', $user->id)
            ->delete();

        return back()->with('success', 'Collaborator berhasil dihapus.');
    }

    /**
     * Mengubah role collaborator.
     */
    public function update(Request $request, Document $document, User $user)
    {
        $request->validate([
            'role' => 'required|in:editor,viewer',
        ]);

        DocumentCollaborator::where('document_id', $document->id)
            ->where('user_id', $user->id)
            ->update([
                'role' => $request->role
            ]);

        return back()->with('success', 'Role berhasil diubah.');
    }
}