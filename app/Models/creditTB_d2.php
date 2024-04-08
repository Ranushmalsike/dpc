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
/**
 * Get the for_how_gen_salary associated with the creditTB_d2
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
public function for_how_gen_salary(): HasOne
{
    return $this->hasOne(how_gen_salary::class, 'credit_id');
}
}
