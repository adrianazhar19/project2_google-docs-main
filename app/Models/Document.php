<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    /**
     * Pemilik dokumen
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Daftar collaborator
     */
    public function collaborators()
    {
        return $this->hasMany(DocumentCollaborator::class);
    }

    /**
     * History dokumen
     */
    public function histories()
    {
        return $this->hasMany(DocumentHistory::class);
    }

    /**
     * Presence user
     */
    public function presences()
    {
        return $this->hasMany(DocumentPresence::class);
    }
}