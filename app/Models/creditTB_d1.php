<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class creditTB_d1 extends Model
{
    use HasFactory;

    protected $fillable = [
        'dataToInsert',
        'credit',
        'TeacherName'
    ];

    // Add the join function
    public function JoinFn()
    {
        return $this->belongsTo(creditTB_d2::class, 'credit_id');
        return $this->belongsTo(user_privet_data::class, 'user_id');
        return $this->belongsTo(credit_d3::class, 'id');
    }
}
