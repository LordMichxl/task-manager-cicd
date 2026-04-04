<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes; // ✅ garder SoftDeletes

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'user_id'
    ];

    // ✅ Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ Scope pour filtrer par statut
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }
}