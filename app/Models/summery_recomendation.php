<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class summery_recomendation extends Model
{
    use HasFactory;
    protected $fillable = [
        'summery_id',
        'selected_values'
    ];
}
