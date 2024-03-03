<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transpoer_detail extends Model
{
    use HasFactory;

    protected $fillable = ['trasporot_code', 'description'];

public function joinQueryTD()
{
    return $this->belongsTo(transpoer_price_details::class, 'trasporot_code');
}
}
