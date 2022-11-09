<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loket extends Model
{
    use HasFactory;

    protected $guarded =['id'];
    

    public function unit()
    {
        # code...
        return $this->belongsTo(Unit::class);
    }

    public function antrian()
    {
        # code...
        return $this->hasMany(Antrian::class);
    }
}
