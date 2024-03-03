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
}
}
