<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\classTb;
use App\Models\userRole;
use App\Models\subjectTB;
use Illuminate\Http\Request;
use App\Models\permissionPage;

class deleteData extends Controller
{
    //>> Class delete
    public function classDelete($id){
       $del = classTb::findOrFail($id)->delete();
       $alertCall = new forAlert();
       $alertCall->alertTp($del);
    }
    // >> subject delete
    public function subjectDelete($id){
       $del = subjectTB::findOrFail($id)->delete();
       $alertCall = new forAlert();
       $alertCall->alertTp($del);
    }
    // >> staff delete
    public function staffDelete($id){
       $del = User::findOrFail($id)->delete();
       $alertCall = new forAlert();
       $alertCall->alertTp($del);
    }
    // >> teacher delete
    public function teacherDelete($id){
       $del = User::findOrFail($id)->delete();
       $alertCall = new forAlert();
       $alertCall->alertTp($del);
    }
    // >> admin delete
    public function adminDelete($id){
       $del = User::findOrFail($id)->delete();
       $alertCall = new forAlert();
       $alertCall->alertTp($del);
    }
    // >> userRole delete
    public function userRoleDelete($id){
       $del = userRole::findOrFail($id)->delete();
       $alertCall = new forAlert();
       $alertCall->alertTp($del);
    }
    // >> PermissionPG delete
    public function permissionPgDelete($id){
       $del = permissionPage::findOrFail($id)->delete();
       $alertCall = new forAlert();
       $alertCall->alertTp($del);
    }
    
}

/*
Alert
*/
class forAlert{
    public function alertTp($del){
        $TpData;
        if($del){
            return $TpData = "success";
        }
        else{
            return $TpData = "fail";
        }
    }
}
