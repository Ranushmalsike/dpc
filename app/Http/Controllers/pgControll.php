<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\classTb;
use App\Models\subjectTB;
use App\Models\User;
use App\Models\userRole;
use App\Models\permissionPage;

class pgControll extends Controller
{
    //welcome section of route
    public function index(){
        return view('welcome');
    }

    //Login section of route
    public function login(){
        return view('login.login');
    }

    //System maintenance section of route
    public function systemMaintenance(){
        $admintb = User::all();
        $permissionTB = permissionPage::all();
        $userRole = userRole::all();
        return view('adm.homeStaff', compact('admintb', 'permissionTB', 'userRole'));
    }
    //Administrative section of route
    public function administrativehub(){
        return view('layout.home');
    }

    //Administrative section of route class and subject
    public function administrativehubClassAndSubject(){
        $getClassData = classTb::all();
        $getSubjectData = subjectTB::all();
        return view('layout.createClassAndSubject', compact('getClassData', 'getSubjectData'));
    }
    //Administrative section of route register Staff or Teacher
    public function administrativehubRegStaffAndTeacher(){
        $getStaff = User::join('user_roles', 'users.user_role', '=', 'user_roles.id')
            ->where('user_roles.roleType', 'staff')
            ->select('users.*', 'user_roles.roleType')
            ->get();
            //dd($getStaff);
        $getTeacher = User::join('user_roles', 'users.user_role', '=', 'user_roles.id')
            ->where('user_roles.roleType', 'teacher')
            ->select('users.*', 'user_roles.roleType')
            ->get();
        return view('layout.createSupperUserAndTeacher', compact('getStaff', 'getTeacher'));
    }
    //Administrative section of route permission
    public function administrativehubpermission($id){
        //$id = $this->$id;
        // dd($id);
         $getStaff = User::join('user_roles', 'users.user_role', '=', 'user_roles.id')
            ->where('users.id', '=', $id)
            ->select('users.*', 'user_roles.roleType')
            ->get();
            
        return view('layout.pemissionAddOrUpdate', compact('getStaff'));
        
    }    
}
