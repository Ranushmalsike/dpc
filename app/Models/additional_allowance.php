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
        'TeacherName'
    ];

    /**
     * Get the for_how_gen_salary associated with the additional_allowance
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function for_how_gen_salary(): HasOne
    {
        return $this->hasOne(how_gen_salary::class, 'additional_allowance_id');
    }
}
