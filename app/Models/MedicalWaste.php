<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MedicalWaste extends Model
{
    use HasFactory;

    protected $fillable = ['waste_type', 'waste_quantity', 'status', 'created_by_id', 'created_by_type'];

    public function createdBy(): MorphTo
    {
        return $this->morphTo();
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['created_by_type'] = $this->getCreatedByTypeName();
        return $array;
    }

    protected function getCreatedByTypeName()
    {
        if ($this->created_by_type === 'App\\Models\\Doctor') {
            return 'Doctor';
        } elseif ($this->created_by_type === 'App\\Models\\Nurse') {
            return 'Nurse';
        }
        return $this->created_by_type;
    }
}
