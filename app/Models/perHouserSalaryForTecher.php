<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perHouserSalaryForTecher extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'TeacherName',
        'Salary',
    ];

    public function AddJoinConstrained(){
        return $this->belongsTo(user_privet_data::class, 'user_id');
    }
}
