<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    protected $table = 'jenis';
    protected $guarded = [];

    function antrian()
    {
        return $this->hasMany(Antrian::class);
    }

    function lastAntrian()
    {
        return $this->hasOne(Antrian::class)->whereDate('created_at', Carbon::today())->latestOfMany();
    }
}
