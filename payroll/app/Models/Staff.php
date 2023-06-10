<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = [
        'id',
        'userId',
        'phoneNum',
        'homeAdd',
        'gender',
        'position',
        'bank',
        'accNum',
        'epfNo',
        'socsoNo',
        'basicPay',

    ];
}
