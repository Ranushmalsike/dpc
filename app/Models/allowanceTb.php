<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class allowanceTb extends Model
{
    use HasFactory;
    
    protected $fillable = [
     'startSalary',
        'endSalary',
        'allowance',
    ];
}
