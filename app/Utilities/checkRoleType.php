<?php
namespace App\Utilities;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class checkRoleType {
    public function checkType() {
        if (auth()->check()) {
        $getSessionID = Auth::user()->id;
        return User::join('user_roles', 'users.user_role', '=', 'user_roles.id')
                   ->select('user_roles.roleType')
                   ->where('users.id', $getSessionID)
                   ->first();
        }
        else{
             return response('Unauthorized', 401);
        }
    }
}
