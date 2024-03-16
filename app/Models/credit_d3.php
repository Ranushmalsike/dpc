<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class credit_d3 extends Model
{
    use HasFactory;

    //add fillable data
    protected $fillable = ['process_text'];

    // Add the join function
    public function JoinFn()
    {
        return $this->hasOne(creditTB_d1::class, 'type_id');
        return $this->hasOne(creditTB_d2::class, 'type_id');
    }
}
