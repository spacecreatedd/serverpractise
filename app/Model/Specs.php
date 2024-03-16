<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specs extends Model
{
    use HasFactory;
    protected $table = 'specs'; // Указываем имя вашей таблицы
    public $timestamps = false;
    protected $fillable = [
        'spec'
    ];
    
    public function getId():int{
        return $this->id;
    }
}
