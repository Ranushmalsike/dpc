<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\classTb;
use App\Models\subjectTB;
use App\Models\User;
use App\Models\user_privet_data;
use App\Models\credit_d3;
use App\Models\creditTB_d1;
use App\Models\creditTB_d2;

use App\Rules\customPasswordValidation;
// use App\Rules\user_privet_data;
// use App\Rules\UserPrivateData;
use Illuminate\Support\Facades\DB;


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


    /**
     * >> Add user Private data for user By Admin or Staff
     */
public function addUserPrivateDataByStaff(Request $request){
        $id = $request->idOfUser;
        $user = user_privet_data::find($id); // Assuming your model is named UserPrivateData

        if ($user) {
            if (!empty($request->first_name)) {
                $user->first_name = $request->first_name;
            }
            if (!empty($request->Second_Name)) {
                $user->second_name = $request->Second_Name;
            }
            if (!empty($request->Address)) {
                $user->address = $request->Address;
            }
            if (!empty($request->NIC)) {
                $user->NIC = $request->NIC;
            }
            if (!empty($request->Contact_Number)) {
                $user->contact_number = $request->Contact_Number;
            }

            $user->update();

            if(empty($request->first_name) && empty($request->Second_Name) && empty($request->Address) && empty($request->NIC) && empty($request->Contact_Number)){
            return redirect()->back()->with('fail', 'Fail data');
            }


            return redirect(route('userPrivateData', ['id' => $id]))->with('success', 'Add data successful');
        }
         else {
            return redirect()->back()->with('fail', 'Fail data');
        }
            }

/**
 * Update pending to Confirmed in Credit Table
 * confirmed_loan
 * reject_loan_option
 * all installment completed of loan
 */
public function updateCredit_reject_loan($id){
    $credit = creditTB_d1::findOrFail($id);
    $credit->type_id = '2'; 
    $credit->update();
}
 public function updateCredit_confirmed_loan($id){
    $credit = creditTB_d1::findOrFail($id);
    $credit->type_id = '3'; 
    $credit->update();
}

public function updateCredit_allcompleted($id){
    $credit = creditTB_d1::findOrFail($id);
    $credit->type_id = '4'; 
    $credit->update();

    $installment = creditTB_d2::where('credit_id' , $id)->update(['type_id' => '4']);
    
}

}

