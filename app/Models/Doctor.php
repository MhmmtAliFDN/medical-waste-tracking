<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'registry_number', 'specialization'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function medicalWastes(): MorphMany
    {
        return $this->morphMany(MedicalWaste::class, 'created_by');
    }
}
