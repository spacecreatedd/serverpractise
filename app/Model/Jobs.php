<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;
    protected $table = 'jobs';
    public $timestamps = false;
    protected $fillable = [
        'job'
    ];
    
    public function getId():int{
        return $this->id;
    }
}
