<?php

namespace App\Models;

use App\Models\Loket;
use App\Models\Antrian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function antrian()
    {
        # code...
        return $this->hasMany(Antrian::class);
    }

    public function loket()
    {
        # code...
        return $this->hasMany(Loket::class);
    }
}
