<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class allowance_for_user extends Model
{
    use HasFactory;

    /**
     * Get all of the for_how_gen_salary for the allowance_for_user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function for_how_gen_salary(): HasMany
    {
        return $this->hasMany(how_gen_salary::class, 'user_id', 'today_day');
    }

    /**
     * Get the for_allowanceBase that owns the allowance_for_user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function for_allowanceBase(): BelongsTo
    {
        return $this->belongsTo(allowanceTb::class, 'id');
    }

}
