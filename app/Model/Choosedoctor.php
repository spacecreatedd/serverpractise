<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'choosedoctor'; // Указываем имя вашей таблицы
    public $timestamps = false;
    protected $fillable = [
        'patient_id'
    ];

    public function getId():int{
        return $this->id;
    }
}
