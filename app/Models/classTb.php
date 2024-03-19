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

    public function join_with_otherTB(){
        return $this->hasOne(time_arrangemtn_confirm_and_transfer::class, 'class_id');
    }
}
