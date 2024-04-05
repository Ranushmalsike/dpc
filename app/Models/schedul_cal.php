<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedul_cal extends Model
{
    use HasFactory;

    /**
     * Get all of the comments for the schedul_cal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function for_how_gen_sal(): HasMany
    {
        return $this->hasMany(how_gen_salary::class, 'schedule_id');
    }
    
}
