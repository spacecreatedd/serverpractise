<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'date'
    ];

    // Определяем отношение "многие к одному" с моделью Patient
    public function patient()
    {
        return $this->belongsTo('Model\Patient');
    }

    // Определяем отношение "многие к одному" с моделью Doctor
    public function doctor()
    {
        return $this->belongsTo('Model\Doctor');
    }
}
