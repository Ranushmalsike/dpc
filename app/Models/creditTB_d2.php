<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class creditTB_d2 extends Model
{
    use HasFactory;

    protected $fillable = ['dataToInsert',
    'credit',
    'TeacherName'];

    public function JoinFn()
    {
        return $this->hasMany(creditTB_d1::class, 'id');
        return $this->belongsTo(credit_d3::class, 'id');
    }
}
