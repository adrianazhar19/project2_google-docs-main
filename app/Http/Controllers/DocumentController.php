<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Document;
use App\Models\DocumentCollaborator;
use App\Models\DocumentHistory;
use App\Models\DocumentPresence;

use App\Events\UserTyping;
use App\Events\DocumentUpdated;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::where('user_id', Auth::id())
            ->orWhereHas('collaborators', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->get();

        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable',
        ]);

        Document::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil dibuat.');
    }

    public function show(string $id)
{
    $document = Document::with('collaborators.user')
        ->findOrFail($id);

    $isOwner = $document->user_id == Auth::id();

    $isCollaborator = DocumentCollaborator::where('document_id', $document->id)
        ->where('user_id', Auth::id())
        ->exists();

    if (!$isOwner && !$isCollaborator) {
        abort(403);
    }

    DocumentPresence::updateOrCreate(
        [
            'document_id' => $document->id,
            'user_id' => Auth::id(),
        ]
    );

    $presenceCount = DocumentPresence::where(
        'document_id',
        $document->id
    )->count();

    $typingUsers = DocumentPresence::where(
        'document_id',
        $document->id
    )
    ->where('is_typing', true)
    ->count();

    return view(
        'documents.show',
        compact(
            'document',
            'presenceCount',
            'typingUsers'
        )
    );
}
public function edit(string $id)
{
    $document = Document::findOrFail($id);

    $isOwner = $document->user_id == Auth::id();

    $isEditor = DocumentCollaborator::where('document_id', $document->id)
        ->where('user_id', Auth::id())
        ->where('role', 'editor')
        ->exists();

    if (!$isOwner && !$isEditor) {
        abort(403);
    }

    DocumentPresence::updateOrCreate(
        [
            'document_id' => $document->id,
            'user_id' => Auth::id(),
        ],
        [
            'is_typing' => true,
        ]
    );

    return view('documents.edit', compact('document'));
}
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable',
        ]);

        $document = Document::findOrFail($id);

        $isOwner = $document->user_id == Auth::id();

        $isEditor = DocumentCollaborator::where('document_id', $document->id)
            ->where('user_id', Auth::id())
            ->where('role', 'editor')
            ->exists();

        if (!$isOwner && !$isEditor) {
            abort(403, 'Anda tidak memiliki izin.');
        }

        if ($request->last_updated_at != $document->updated_at->toDateTimeString()) {

            DocumentPresence::where('document_id', $document->id)
                ->where('user_id', Auth::id())
                ->update([
                    'is_typing' => false,
                ]);

            return back()->with(
                'error',
                'Dokumen telah diubah oleh pengguna lain.'
            );
        }

        DocumentHistory::create([
            'document_id' => $document->id,
            'user_id' => Auth::id(),
            'content' => $document->content,
        ]);

        $document->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        broadcast(new DocumentUpdated($document))->toOthers();

        DocumentPresence::updateOrCreate(
            [
                'document_id' => $document->id,
                'user_id' => Auth::id(),
            ],
            [
                'is_typing' => false,
            ]
        );

        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function typing(string $id)
    {
        $document = Document::findOrFail($id);

        broadcast(new UserTyping($document))->toOthers();

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy(string $id)
    {
        $document = Document::findOrFail($id);

        if ($document->user_id != Auth::id()) {
            abort(403, 'Hanya pemilik yang dapat menghapus.');
        }

        $document->delete();

        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil dihapus.');
    }
}