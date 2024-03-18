<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'choosepatient'; // Указываем имя вашей таблицы
    public $timestamps = false;
    protected $fillable = [
        'doctor_id'
    ];

    public function getId():int{
        return $this->id;
    }
}
