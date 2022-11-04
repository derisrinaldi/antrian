<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function unit()
    {
        # code...
        return $this->belongsTo(Unit::class,'unit_id','id');
    }
}