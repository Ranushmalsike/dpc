<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class how_gen_salary extends Model
{
    use HasFactory;


/**
 * Get the user that owns the how_gen_salary
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function for_user(): BelongsTo
{
    return $this->belongsTo(schedul_cal::class, 'user_id');
}
/**
 * Get the user that owns the how_gen_salary
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function for_schedule_cal(): BelongsTo
{
    return $this->belongsTo(schedul_cal::class, 'schedule_id_of_cal_gen');
}
/**
 * The for_allowance_for_user that belong to the how_gen_salary
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
 */
public function for_allowance_for_user(): BelongsToMany
{
    return $this->belongsToMany(allowance_for_user::class, 'user_id', 'define_month');

}

/**
 * Get the for_transport that owns the how_gen_salary
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function for_transport(): BelongsTo
{
    return $this->belongsTo(transpoer_price_details::class, 'id');
}

/**
 * Get the for_additional_allowance that owns the how_gen_salary
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function for_additional_allowance(): BelongsTo
{
    return $this->belongsTo(additional_allowance::class, 'id');
}

/**
 * Get the for_creditTB_d2 that owns the how_gen_salary
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function for_creditTB_d2(): BelongsTo
{
    return $this->belongsTo(creditTB_d2::class, 'id');
}
}
