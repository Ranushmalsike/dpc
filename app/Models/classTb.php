<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classTb extends Model
{
    use HasFactory;
    protected $fillable=[
        'class_name',
        'str_date',
        'end_date',
        'dpcclass',
        'start_date',
        'end_date'

    ];
}
