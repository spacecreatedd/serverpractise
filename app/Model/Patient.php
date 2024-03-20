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
        'date_of_birth',
        'image'
    ];

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function getId(): int
    {
        return $this->id;
    }
}

