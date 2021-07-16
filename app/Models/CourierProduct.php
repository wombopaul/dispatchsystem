<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierProduct extends Model
{
    use HasFactory;


    public function type()
    {
        return $this->belongsTo(Type::class, 'courier_type_id');
    }
}
