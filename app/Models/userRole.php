<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userRole extends Model
{
    use HasFactory;

    protected $fillable=[
        'permisiontext'
    ];
    
        public function users() {
        return $this->hasMany(User::class, 'user_role');
    }

}
