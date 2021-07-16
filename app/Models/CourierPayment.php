<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierPayment extends Model
{
    use HasFactory;


    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function brach()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
