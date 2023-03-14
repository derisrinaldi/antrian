<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $guarded =['id'];
    protected $with=['unit','loket'];

    public function unit()
    {
        # code...
        return $this->belongsTo(Unit::class,'unit_id','id');
    }

    public function loket()
    {
        # code...
        return $this->belongsTo(Loket::class);
    }

    public function queueType()
    {
        # code...
        return $this->belongsTo(QueueType::class);
    }
}
