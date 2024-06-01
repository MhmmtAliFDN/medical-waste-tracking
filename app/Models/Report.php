<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['authorized_officer_id', 'title', 'content'];

    public function authorizedOfficer(): BelongsTo
    {
        return $this->belongsTo(AuthorizedOfficer::class, 'authorized_officer_id');
    }

    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, AuthorizedOfficer::class, 'id', 'id', 'authorized_officer_id', 'user_id');
    }
}
