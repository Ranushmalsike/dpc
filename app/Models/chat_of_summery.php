<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chat_of_summery extends Model
{
    use HasFactory;
     protected $fillable=[
        'id',
        'cellIndex'
    ];
}
