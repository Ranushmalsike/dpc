<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class allowanceTb extends Model
{
    use HasFactory;
    
    protected $fillable = [
     'startSalary',
        'endSalary',
        'allowance',
    ];

    /**
     * Get the for_allowance_for_user associated with the allowanceTb
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function for_allowance_for_user(): HasOne
    {
        return $this->hasOne(allowance_for_user::class, 'allowance_id');
    }
}
