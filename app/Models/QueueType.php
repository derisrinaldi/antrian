<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueType extends Model
{
    use HasFactory;

    protected $fillable=['unit_id','name'];
    
    public function unit()
    {
        # code...
        return $this->hasMany(Unit::class,'id','unit_id');
    }
}
