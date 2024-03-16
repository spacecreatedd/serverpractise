<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $table = 'record';
    public $timestamps = false;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'date'
    ];

    public function getId():int{
        return $this->id;
    }
}
