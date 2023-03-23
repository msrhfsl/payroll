<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    protected $table = 'attend';

    protected $fillable = [
        'id',
        'shiftID',
        'staffID',
        'timein',
        'timeout',
        'attendStatus',
        'attendDate',
    ];    
}
