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
use App\Models\transpoer_detail;
use App\Models\transpoer_price_details;
use App\Models\time_arrangemtn_confirm_and_transfer;
use App\Models\perHouserSalaryForTecher;
use App\Models\summery_schema;


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
    >> admin Update
    */
    public function adminEdit(Request $request){
        //Check empty data and condition
        $id = $request->id;
        $pass = $request->password;
        $this->validate($request, [
            'password' => ['required', new CustomPasswordValidation($pass), ],
        ]);

        $upd = User::findOrFail($id);
        if(!empty($request->password)){
             $upd->password= bcrypt($request->password);
        }
         $upd->update();
        
    // if($upd){
    //         // return redirect(route('homeStaff'))->with('success', 'Add data successful');
    //  }
    //     else{
    //         // return redirect(route('homeStaff'))->with('fail', 'Fail data');
    // }
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



public function setDefaultTransportPrice($id)
{
    
    $query = "CALL updateTransportSetDefByEntryId(:your_data);";

    $bind = [
        'your_data' => $id,
    ];

    DB::beginTransaction();
    try {
        DB::statement($query, $bind);
        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        // Handle the exception
    }
   
    
}

/**
 * Update - schedule arrangement data
 * confirm schedule by admin or user
 * reject process Up
 * Transfer section Up
 */
// confirmed
public function confirm_schedule($id){
    $confirmed_schedule = time_arrangemtn_confirm_and_transfer::findOrFail($id);
    $confirmed_schedule->confirm = '1'; 
    $confirmed_schedule->update();
    // ProcessTimeArrangementFinal
     $query = "CALL ProcessTimeArrangementFinal(:your_data);";

    $bind = [
        'your_data' => $id,
    ];

    DB::beginTransaction();
    try {
        DB::statement($query, $bind);
        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        // Handle the exception
    }
}
// reset
public function reset_schedule($id){
    $confirmed_schedule = time_arrangemtn_confirm_and_transfer::findOrFail($id);
    $confirmed_schedule->confirm = '0'; 
    $confirmed_schedule->Transfer = '0'; 
    $confirmed_schedule->update();
}
// transfer _ confirmed
public function trp_schedule_Up($id){
    $confirmed_schedule = time_arrangemtn_confirm_and_transfer::findOrFail($id);
    $confirmed_schedule->Trp_confirmed = '1';
    $confirmed_schedule->update();
}
// transfer _ active
public function trp_schedule_Active($id, $Teacher_id_ofTRp){
    $confirmed_schedule = time_arrangemtn_confirm_and_transfer::findOrFail($id);
    $confirmed_schedule->Trp_for_whom_user_id = $Teacher_id_ofTRp;
    $confirmed_schedule->update();
}
// timeArrangement _ Update
public function schedule_edit(Request $request){
    // print($request->edit_TB_id);
    $Edit_schedule = time_arrangemtn_confirm_and_transfer::findOrFail($request->edit_TB_id);
    if($request->edit_start_time != null){
    $Edit_schedule-> start_time = $request->edit_start_time;
    }
    if($request->edit_end_time != null){
    $Edit_schedule-> end_time = $request->edit_end_time;
     }
    if($request->edit_class != 0){
    $Edit_schedule-> class_id = $request->edit_class;
    }
    if($request->edit_subject != 0){
    $Edit_schedule-> subject_id = $request->edit_subject;
    }
    if($request->edit_trp != "bypass"){
    $Edit_schedule-> transport_id = $request->edit_trp;
    }
    $Edit_schedule->update();
}

/**
 * Percentage Update
 */
public function Update_percentage(Request $request){
    $columnId = $request->column_id;
    $balancecol = $columnId - 2;
    $Percentage = "Percentage_sum_co_".(string)$balancecol;
    for ($i=3; $i <= 9 ; $i++) {
        if($i == $columnId){ 
    $summery_percentage = summery_schema::findOrFail($request->summery_id);
    $summery_percentage-> $Percentage = $request->percentage_val;
    $summery_percentage->update();
        // dd($i);
        }
    }
    return response()->json(['success' => true, 'message' => 'ok']);
}
/**
 * Salary band update set to defualt
 */
public function setDefaultSalaryBand($id){
    
    $query = "CALL salaryBand_defaults(:your_data);";

    $bind = [
        'your_data' => $id,
    ];

    DB::beginTransaction();
    try {
        DB::statement($query, $bind);
        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        // Handle the exception
    }
}


    /*
    >> Staff Update
    */
    public function ownChangePassword(Request $request){
        $getSessionID = auth()->user()->id;
        //Check empty data and condition
        $pass = $request->new_pass;
        $this->validate($request, [
            'new_pass' => ['required', new CustomPasswordValidation($pass), ],
        ]);

        $upd = User::findOrFail($getSessionID);
        if(!empty($request->new_pass)){
             $upd->password=$request->new_pass;
        }
         $upd->update();
        
    if($upd){
            return redirect(route('addPrivateDataUserBy_teacher'))->with('success', 'Add data successful');
     }
        else{
            return redirect(route('addPrivateDataUserBy_teacher'))->with('fail', 'Fail data');
    }
    }
/*
>> Confirm updated in additional allowance and save in how gen table
*/
    public function update_additional_allowance($id){

        DB::table('additional_allowances')
        ->where('id', $id)
        ->update(['confirmed' => 1]);

        $user_id = DB::table('additional_allowances')
              ->where('id', $id)
              ->value('user_id');
              
        $query = "CALL Insert_allowance_into_how_gen(:teacher_id, :id_of_allowance_additional);";

            $bind = [
                'teacher_id' => $user_id,
                'id_of_allowance_additional' => $id // Ensure this is correct
            ];

            DB::beginTransaction();
            try {
                DB::statement($query, $bind);
                DB::commit();
                // Consider adding a return statement here to indicate success
            } catch (\Exception $e) {
                DB::rollBack();
                // Log the error or return an error response
            }
    }
}

