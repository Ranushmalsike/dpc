<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class time_arrangemtn_confirm_and_transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'timeArrangement_array',
        'edit_TB_id',
        'edit_start_time',
        'edit_end_time',
        'edit_class',
        'edit_subject',
        'edit_trp'
    ];

    public function join_with_timeArrangement(){
        return $this->belongsTo(user_privet_data::class, 'user_id');
        return $this->belongsTo(classTb::class, 'id');
        return $this->belongsTo(subjectTB::class, 'id');
        return $this->belongsTo(transpoer_price_details::class, 'id');
    } 
}
