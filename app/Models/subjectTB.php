<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subjectTB extends Model
{
    use HasFactory;
    protected $fillable=[
        'subject_name',
        'subject_name_edit',
        
    ];
}
