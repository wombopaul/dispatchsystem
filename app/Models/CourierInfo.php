<?php

namespace App\Models;

use App\Models\User;
use App\Models\CourierPayment;
use App\Models\CourierProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourierInfo extends Model
{
    use HasFactory;


    public function senderStaff()
    {
        return $this->belongsTo(User::class, 'sender_staff_id');
    }

    public function receiverStaff()
    {
        return $this->belongsTo(User::class, 'receiver_staff_id');
    }

    public function receiverBranch()
    {
        return $this->belongsTo(Branch::class, 'receiver_branch_id');
    }

    public function senderBranch()
    {
        return $this->belongsTo(Branch::class, 'sender_branch_id');
    }

    public function courieraddresses()
    {
        return $this->belongsTo(CourierAddress::class, 'courier_id');
    }


    public function paymentInfo()
    {
        return $this->hasOne(CourierPayment::class, 'courier_info_id');
    }


    public function courierDetail()
    {
        return $this->hasMany(CourierProduct::class, 'courier_info_id')->with('type');
    }
}
