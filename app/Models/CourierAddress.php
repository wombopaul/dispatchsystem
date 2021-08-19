<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierAddress extends Model
{
    use HasFactory;
    
    public function courier()
    {
        return $this->belongsTo(CourierInfo::class, 'courier_id');
    }
}
