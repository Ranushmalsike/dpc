<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class summery_schema extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'month_of_summery',
        'EXERCS_POEMS',
        'VOCABULARY',
        'IDENTIFICATION_3',
        'CONVERSATION_4',
        'INSTRCTNS_5',
        'READING_6',
        'WRITING_7'
    ];
}
