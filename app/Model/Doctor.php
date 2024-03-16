<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctor'; // Указываем имя вашей таблицы
    public $timestamps = false;
    protected $fillable = [
        'name',
        'surname',
        'patronym',
        'date_of_birth',
        'job',
        'specialization'
    ];

    public function getId():int{
        return $this->id;
    }
}
