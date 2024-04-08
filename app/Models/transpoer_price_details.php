<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transpoer_price_details extends Model
{
    use HasFactory;

    protected $fillable = ['TransportCodeSelect', 'TRPA'];
public function transpoerDetails()
{
    return $this->hasMany(transpoer_detail::class, 'trasporot_code');
    return $this->hasOne(time_arrangemtn_confirm_and_transfer::class, 'transport_id');
}
/**
 * Get the for_how_gen_salary associated with the transpoer_price_details
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
public function for_how_gen_salary(): HasOne
{
    return $this->hasOne(how_gen_salary::class, 'trp_transport_id');
}
}
