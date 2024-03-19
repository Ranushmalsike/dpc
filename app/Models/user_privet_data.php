<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_privet_data extends Model
{
    use HasFactory;
    protected $fillable=[
        'idOfUser',
        'first_name',
        'Second_Name',
        'Address',
        'NIC',
        'Contact_Number'
    ];

    public function joinDataOtherTB(){
        return $this->hasOne(User::class, 'id');
        return $this->hasMany(perHouserSalaryForTecher::class, 'user_id');
        return $this->hasOne(creditTB_d1::class, 'user_id');
        return $this->hasOne(time_arrangemtn_confirm_and_transfer::class, 'user_id');
    }
}
