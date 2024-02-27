<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permissionPageforuser extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'selectedValues',
        'idOfTheUser',
    ];
    public function joinOfuser() {
        return $this->belongsTo(User::class, 'user_id');
        return $this->belongsTo(permissionPage::class, 'id');
        

    }
}
