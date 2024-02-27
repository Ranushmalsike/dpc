<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\classTb;
use App\Models\userRole;
use App\Models\subjectTB;
use Illuminate\Http\Request;
use App\Models\permissionPage;
use App\Models\permissionPageforuser;
use App\Rules\customPasswordValidation;


class insertData extends Controller
{
   /**
    * System Developer section
    * >> Add the admin
    */
    public function adminData(Request $request){

         //check empty values
         $request->validate([
            'username'=>'required',
            'useremail'=>'required',
            'pass'=>'required'
         ]);

         //save date into database
        $getUserSendData = $request->username;
        $foundData = User::where('name', $getUserSendData)->first();
        if (!$foundData) {

        User::create([
            'name'=>$request->username,
            'email'=>$request->useremail,
            'password'=>bcrypt($request->pass)
        ]);
        return $this->redirectOptionCompleted();
        } else {
        return $this->redirectOptionFail();
        }
        
    }

    /*
    >> System Developer - Add Dada to permission table 
    */
    public function permissionData(Request $request){

        //Check empty data
        $request->validate([
            'permisiontext' => 'required|string',
        ]);
        
        //save data
        $getUserSendData = $request->permisiontext;
        $foundData = userRole::where('roleType', $getUserSendData)->first();
        if (!$foundData) {
        userRole::insert([
            'roleType'=>$request->permisiontext,     
        ]);
        return $this->redirectOptionCompleted();
        } else {
        return $this->redirectOptionFail();
        }
    }

    /*
    >> System Developer - Add the page permission
    */
    public function addPagepermission(Request $request){
        $request->validate([
            'pageName' =>'required|string',
        ]);
        $getUserSendData = $request->pageName;
        $foundData = permissionPage::where('nameOfPage', $getUserSendData)->first();
        if (!$foundData) {
        permissionPage::insert([
            
           'nameOfPage'=>$request->pageName,
        ]);
        return $this->redirectOptionCompleted();
        } else {
        return $this->redirectOptionFail();
        }
        
        
          
    }
    /*
    >>Add Dada to ClassTB table 
    */
    public function classInputeData(Request $request){

        //Check empty data
        $request->validate([
            'class_name' => 'required',
            'str_date' => 'required',
        ]);

        //save data
        $getUserSendData = $request->class_name;
        $foundData = classTb::where('dpcclass', $getUserSendData)->first();
        if (!$foundData) {
        classTb::insert([
            'dpcclass'=>$request->class_name,     
            'start_date'=>$request->str_date,     
            'end_date'=>$request->end_date,     
        ]);
        return $this->redirectOptionCompleted();
        } else {
        return $this->redirectOptionFail();
        }

    }
    /*
    >>Add Dada to SubjectTb table 
    */
    public function subjectInputeData(Request $request){

        //Check empty data
        $request->validate([
            'subject_name' => 'required',
        ]);

        //save data
        $getUserSendData = $request->subject_name;
        $foundData = subjectTB::where('subject', $getUserSendData)->first();
        if (!$foundData) {
        subjectTB::insert([
            'subject'=>$request->subject_name,        
        ]);
        return $this->redirectOptionCompleted();
        } else {
        return $this->redirectOptionFail();
        }

    }
    /*
    >>Add Dada to userTb - staff reg table 
    */
    public function staffRegInputeData(Request $request){

        //Check empty data and condition
        $pass = $request->supper_user_pass;
        $this->validate($request, [
            'supper_user' => 'required|string',
            'supper_user_pass' => ['required', new CustomPasswordValidation($pass), ],
        ]);

        //save data
        $getUserSendData = $request->supper_user;
        $foundData = User::where('name', $getUserSendData)->first();
        if (!$foundData) {
        User::insert([
            'name'=>$request->supper_user,     
            'user_role'=>"2",     
            'password'=> bcrypt($request->supper_user_pass)     
        ]);
        return $this->redirectOptionCompleted();
        } else {
        return $this->redirectOptionFail();
        }

    }    
    /*
    >>Add Dada to userTb - Teacher reg table 
    */
    public function teacherRegInputeData(Request $request){

        //Check empty data condition
        $pass = $request->pass_teacher;
        $this->validate($request, [
            'teacher_name' => 'required|string',
            'pass_teacher' => ['required', new CustomPasswordValidation($pass)],
        ]);

        //save data
        $getUserSendData = $request->teacher_name;
        $foundData = User::where('name', $getUserSendData)->first();
        if (!$foundData) {
        User::insert([
            'name'=>$request->teacher_name,     
            'user_role'=>"3",     
            'password'=> bcrypt($request->pass_teacher)     
        ]);

        return $this->redirectOptionCompleted();
        } else {
        return $this->redirectOptionFail();
        }

    }

    /**
     * >> Add permission for user By Admin or Staff
     */

     public function addPermisisonByAdminOrStaff(Request $request){
        //dd($request->selectedValues);


        
        foreach ($request->selectedValues as $selectedValue) {

        permissionPageforuser::insertOrIgnore([
            'permission_id' => $selectedValue,
            'user_id' => $request->idOfTheUser,
        ]);
        }
        return response()->json(['status' => 'success', 'message' => 'Permission added successfully']);
             // return $this->redirectOptionCompleted();
     }



    /**
     * Alert within redirect function
     */
    public function redirectOptionCompleted(){
        return redirect()->back()->with('success', 'Add data successful');
        }
    public function redirectOptionFail(){   
        return redirect()->back()->with('fail', 'Fail data');

    }
}
