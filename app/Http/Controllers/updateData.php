<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\classTb;
use App\Models\subjectTB;
use App\Models\User;
use App\Rules\customPasswordValidation;

class updateData extends Controller
{

    /*
    >> Class Update
    */
   public function classEdit($class_id, Request $request){
    $upd = classTb::findOrFail($class_id);

    if (!empty($request->dpcclass)) {
        $upd->dpcclass = $request->dpcclass;
    }

    if (!empty($request->start_date)) {
        $upd->start_date = $request->start_date;
    }

    if (!empty($request->end_date)) {
        $upd->end_date = $request->end_date;
    }

    // Alert
    $upd->update();
    if($upd){
            return redirect(route('classAndSubject'))->with('success', 'Add data successful');
     }
        else{
           return redirect(route('classAndSubject'))->with('fail', 'Fail data');
    }

}

    /*
    >> Class Update
    */
    public function subjectEdit($subject_id, Request $request){
        $request->validate([
            'subject_name_edit' => 'required|string',
        ]);

        $upd = subjectTB::findOrFail($subject_id);
        if(!empty($request->subject_name_edit)){
             $upd->subject=$request->subject_name_edit;
        }
         $upd->update();
        
    if($upd){
            return redirect(route('classAndSubject'))->with('success', 'Add data successful');
     }
        else{
            return redirect(route('classAndSubject'))->with('fail', 'Fail data');
    }
    }
    /*
    >> Staff Update
    */
    public function staffEdit($staff_id, Request $request){
        //Check empty data and condition
        $pass = $request->staff_password_edit;
        $this->validate($request, [
            'staff_password_edit' => ['required', new CustomPasswordValidation($pass), ],
        ]);

        $upd = User::findOrFail($staff_id);
        if(!empty($request->staff_password_edit)){
             $upd->password=$request->staff_password_edit;
        }
         $upd->update();
        
    if($upd){
            return redirect(route('RegisterStaff'))->with('success', 'Add data successful');
     }
        else{
            return redirect(route('RegisterStaff'))->with('fail', 'Fail data');
    }
    }
    /*
    >> Teacher Update
    */
    public function teacherEdit($teacher_id, Request $request){
        //Check empty data and condition
        $pass = $request->teacher_password_edit;
        $this->validate($request, [
            'teacher_password_edit' => ['required', new CustomPasswordValidation($pass), ],
        ]);

        $upd = User::findOrFail($teacher_id);
        if(!empty($request->teacher_password_edit)){
             $upd->password=$request->teacher_password_edit;
        }
         $upd->update();
        
    if($upd){
            return redirect(route('RegisterStaff'))->with('success', 'Add data successful');
     }
        else{
            return redirect(route('RegisterStaff'))->with('fail', 'Fail data');
    }
    }
}

