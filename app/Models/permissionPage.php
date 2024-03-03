<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permissionPage extends Model
{
    use HasFactory;
    protected $fillable = [
        'pageName',
    ];
    public function pemissionPageForsys() {
        return $this->hasMany(permissionPageforuser::class, 'permission_id');
    }
}
