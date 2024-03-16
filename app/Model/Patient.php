<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patient'; // Указываем имя вашей таблицы
    public $timestamps = false;
    protected $fillable = [
        'name',
        'surname',
        'patronym',
        'date_of_birth'
    ];

}
