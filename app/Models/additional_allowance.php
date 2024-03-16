<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class additional_allowance extends Model
{
    use HasFactory;
    protected $fillable = [
        'additionalAllowance',
        'description',
    ];
}
