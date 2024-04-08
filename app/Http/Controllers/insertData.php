<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\models\
use App\Models\User;
use App\Models\classTb;
use App\Models\userRole;
use App\Models\subjectTB;
use App\Models\permissionPage;
use App\Models\permissionPageforuser;
use App\Models\perHouserSalaryForTecher;
use App\Models\transpoer_detail;
use App\Models\transpoer_price_details;
use App\Models\allowanceTb;
use App\Models\additional_allowance;
use App\Models\credit_d3;
use App\Models\creditTB_d1;
use App\Models\creditTB_d2;
use App\Models\gathherTo_a_delete_date_from_TimeArrangement;
use App\Models\time_arrangemtn_confirm_and_transfer;
use App\Models\summery_schema;
use App\Models\summery_recomendation;
use App\Models\chat_of_summery;


// use Carbon\Carbon;
// use DateTime;
// use format_date;

// use App\Rules\
use App\Rules\customPasswordValidation;

// Importing DB
use Illuminate\Support\Facades\DB;


class insertData extends Controller
{
    /**
     * Validate request data.
     */
    private function validateRequest($request, $rules)
    {
        $request->validate($rules);
    }

    /**
     * Check if data exists in the database.
     */
    private function dataExists($model, $column, $value)
    {
        return $model::where($column, $value)->first() ? true : false;
    }

    /**
     * Insert data into the database.
     */
    private function insertData($model, $data)
    {
        $model::insert($data);
    }

    /**
     * Handle the process of adding data.
     */
    private function handleAddData($request, $rules, $model, $data, $checkColumn = null, $checkValue = null)
    {
        $this->validateRequest($request, $rules);

        if ($checkColumn && $checkValue) {
            if ($this->dataExists($model, $checkColumn, $checkValue)) {
                return $this->redirectOptionFail();
            }
        }

        $this->insertData($model, $data);
        return $this->redirectOptionCompleted();
    }

    //adminData method
    public function adminData(Request $request)
    {
        return $this->handleAddData(
            $request,
            ['username' => 'required', 'useremail' => 'required', 'pass' => 'required'],
            User::class,
            ['name' => $request->username, 'email' => $request->useremail, 'password' => bcrypt($request->pass)],
            'name',
            $request->username
        );
    }

    //permissionData method
    public function permissionData(Request $request)
    {
        return $this->handleAddData(
            $request,
            ['permisiontext' => 'required|string'],
            userRole::class,
            ['roleType' => $request->permisiontext],
            'roleType',
            $request->permisiontext
        );
    }
    
    //Add process text
    public function add_proccessText(Request $request)
    {
        return $this->handleAddData(
            $request,
            ['process_text' => 'required|string'],
            credit_d3::class,
            ['type' => $request->process_text],
            'type',
            $request->process_text
        );
    }

    //TranportData method
    public function insert_TranportData(Request $request)
    {
        return $this->handleAddData(
            $request,
            ['TransportCode' => 'required|string', 'TransportDescription' => 'required|string'],
            transpoer_detail::class,
            ['trasporot_code' => $request->TransportCode, 'description' => $request->TransportDescription],
            'trasporot_code',
            $request->TransportCode
        );
    }

    //TranportData_price method
    public function insert_TranportData_price(Request $request)
    {
        return $this->handleAddData(
            $request,
            ['TransportCodeSelect' => 'required|string', 'TRPA' => 'required|string'],
            transpoer_price_details::class,
            ['trasporot_code' => $request->TransportCodeSelect, 'transport_price' => $request->TRPA]
        );
    }

    //insert_allowance method
    public function insert_allowance(Request $request)
    {
        return $this->handleAddData(
            $request,
            ['startSalary' => 'required|string', 'endSalary' => 'required|string', 'allowance' => 'required|string'],
            allowanceTb::class,
            ['start_salary' => $request->startSalary, 'end_star' => $request->endSalary, 'allowance' => $request->allowance],
            'allowance',
            $request->allowance
        );
    }

    
    //insert_Additional_allowance method
        public function insert_Additional_allowance(Request $request)
    {
        // Validation
        $this->validate($request, [
            'TeacherName' => 'required|integer', // Assuming this is a user ID, validate accordingly
            'additionalAllowance' => 'required|string',
            'description' => 'required|string'
        ]);

        // Use the DB facade with parameter binding to prevent SQL injection
           $result = \DB::select("SELECT insert_additional_allowance(:TeacherName, :additionalAllowance, :description) AS last_insert_id", [
        'TeacherName' => $request->TeacherName,
        'additionalAllowance' => $request->additionalAllowance,
        'description' => $request->description,
    ]);

        if (!empty($result)) {
           $lastInsertId = $result[0]->last_insert_id;
            $query = "CALL Insert_allowance_into_how_gen(:teacher_id, :id_of_allowance_additional);";

            $bind = [
                'teacher_id' => $request->TeacherName,
                'id_of_allowance_additional' => $lastInsertId // Ensure this is correct
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
        } else {
            return $this->redirectOptionFail();
            // Handle the case where $result is empty, indicating the function did not execute as expected
        }
        return $this->redirectOptionCompleted();
    }

    //insert_creditSection method
public function insert_creditSection(Request $request)
{
     $this->handleAddData(
        $request,
        ['credit' => 'required|string'],
        creditTB_d1::class,
        ['user_id' => $request->TeacherName, 'amount' => $request->credit, 'provide_date' => now()]
    );

    // get Last id of creditTB_d1
    $last_id = creditTB_d1::latest('id')->value('id');


    $Month = '';
  foreach ($request->dataToInsert as $data) {

    if(!empty($data['month'])){
        $vart = $data['month'];
        $cleanDateString = preg_replace('/[^A-Za-z0-9]/', '', $vart);
        preg_match_all('/[A-Za-z]+(\d+)/', $cleanDateString, $matches);

        $Year = substr($cleanDateString, 0, 4);
        $Month = preg_replace('/[^A-Za-z]/', '', $cleanDateString);
        $Date = end($matches[1]);

            switch ($Month) {
                case 'January':
                    // code...
                    $Month = '01';
                    $combineData = $Year . $Month . $Date;
                    break;
                 case 'February':
                    // code...
                    $Month = '02';
                    $combineData = $Year . $Month . $Date;
                    break;
                 case 'March':
                    // code...
                    $Month = '03';
                    $combineData = $Year . $Month . $Date;
                    break;
                 case 'April':
                    // code...
                    $Month = '04';
                    $combineData = $Year . $Month . $Date;
                    break;
                 case 'May':
                    // code...
                    $Month = '05';
                    $combineData = $Year . $Month . $Date;
                    break;
                 case 'June':
                    // code...
                    $Month = '06';
                    $combineData = $Year . $Month . $Date;
                    break;
                 case 'July':
                    // code...
                    $Month = '07';
                    $combineData = $Year . $Month . $Date;
                    break;
                 case 'August':
                    // code...
                    $Month = '08';
                    $combineData = $Year . $Month . $Date;
                    break;
                 case 'September':
                    // code...
                    $Month = '09';
                    $combineData = $Year . $Month . $Date;
                    break;
                 case 'October':
                    // code...
                     $Month = '10';
                     $combineData = $Year . $Month . $Date;
                    break;
                 case 'November':
                    // code...
                    $Month = '11';
                    $combineData = $Year . $Month . $Date;
                    break;
                 case 'December':
                    // code...
                     $Month = '12';
                     $combineData = $Year . $Month . $Date;
                    break;
                
                     default:
                    // code...
                    break;
            }

        // $combineData = $Year . $Month . $Date;
         $formatted_date = date('Y-m-d', strtotime($combineData));

         creditTB_d2::insert([
            'credit_id' =>  $last_id, 
            'installment' => $data['installment'],
            'installment_date' => $formatted_date
        ]);
         
    }   
    else{
        continue;
    }
   
}
    return $this->redirectOptionCompleted();
}


// subjectInputeData
public function subjectInputeData(Request $request){
    return $this->handleAddData(
        $request,
        ['subject_name' => 'required|string'],
        subjectTB::class,
        ['subject' => $request->subject_name],
        'subject',
        $request->subject_name
    );
}

// classInputeData
public function classInputeData(Request $request){
    return $this->handleAddData(
        $request,
        ['class_name' => 'required|string', 'str_date' => 'required|string'],
        classTb::class,
        ['dpcclass' => $request->class_name, 'start_date' => $request->str_date, 'end_date' => $request->end_date],
        'dpcclass',
        $request->class_name
    );
}

// Add Delete Date from arrange Time Table by System
public function insert_DateFromArrangeTimeTable(Request $request){
    $dateOfRequest = $request->dateText;
    $formatted_date = date('Y-m-d', strtotime($dateOfRequest));

   
    gathherTo_a_delete_date_from_TimeArrangement::insert([
        'delete_date_from_TimeArrangement' => $formatted_date
    ]);
}


/***
 * Time Arrangement
 */
public function timeArrangement_save(Request $request){

    foreach ($request->timeArrangement_array as $data_ofTimeArrangement) {
        // print($data_ofTimeArrangement['getTeacher_idV']);
        # code...
        $formatted_date_of_time_arrangement = date('Y-m-d', strtotime($data_ofTimeArrangement['date_text_val']));
                 time_arrangemtn_confirm_and_transfer::insert([
            'Time_arrangement' =>  $formatted_date_of_time_arrangement, 
            'start_time' => $data_ofTimeArrangement['starttime_text_val'],
            'end_time' => $data_ofTimeArrangement['endtime_text_val'],
            'user_id' => $data_ofTimeArrangement['getTeacher_idV'],
            'class_id' => $data_ofTimeArrangement['classNameVal_data'],
            'subject_id' => $data_ofTimeArrangement['subjectVal_data'],
            'transport_id' => $data_ofTimeArrangement['transport_data'] == null ? 1 : $data_ofTimeArrangement['transport_data']
        ]);
    }
}
/**
 * per hour salary
 *
 */

 public function addSalaryBand(Request $request) {
    return $this->handleAddData(
        $request,
        ['TeacherName' => 'required|string', 'Salary' => 'required|string'],
        perHouserSalaryForTecher::class,
        ['user_id' => $request->TeacherName, 'perHourSalary' => $request->Salary, 'published' => now()]
    );
 }
 /**
  * Add Summery
  */
 public function Add_summery_schema(Request $request) {
      summery_schema::insert(
         [
         'month_of_summery'=>$request->month_of_summery,
         'summery_col_1'=> $request->EXERCS_POEMS,
         'summery_col_2'=> $request->VOCABULARY,
         'summery_col_3'=> $request->IDENTIFICATION_3,
         'summery_col_4'=> $request->CONVERSATION_4,
         'summery_col_5'=> $request->INSTRCTNS_5,
         'summery_col_6'=> $request->READING_6,
         'summery_col_7'=> $request->WRITING_7,
         'class_id'=>$request->class_id
         ]
     );
     return $this->redirectOptionCompleted();
 }

 /**
  * selected teacher
  */
public function selected_teacher(Request $request) {
     $summery_id = $request->summery_id;

    try {
        foreach ($request->selected_values as $selectedData) {
            // Insert each selected teacher ID with the summary ID
            summery_recomendation::insert([
                'summery_id' => $summery_id,
                'teacher_id' => $selectedData  // Assuming $selectedData is the teacher ID
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Data saved successfully']);
    } catch (\Exception $e) {
        // Log the exception
        Log::error('Error saving teacher selection: ' . $e->getMessage());
        // Return an error response
        return response()->json(['success' => false, 'message' => 'Error saving data'], 500);
    }
}

/**
 * chat input
 */
public function chat_input(Request $request){
    $getSessionID = auth()->user()->id;

    $getrole = User::join('user_roles', 'users.user_role', '=', 'user_roles.id')
    ->select('user_roles.roleType')
    ->where('users.id', $getSessionID)
    ->first();

    if($getrole->roleType == 'admin' || $getrole->roleType == 'staff'){
        try {
        chat_of_summery::insert(
        ['summery_id' => $request->idOfRow, 'chat_staff'=> $request->chatInput, 'staff_id'=> $getSessionID,'staff_id_view'=> 1, 'Column_id'=> $request->columnNumberOfRow]
        );
        return response()->json(['success' => true, 'message' => 'Data send successfully']);
    } catch (\Throwable $th) {
        //throw $th;
        return response()->json(['success' => false, 'message' => $th]);
    }
    }
    else{
  try {
        chat_of_summery::insert(
        ['summery_id' => $request->idOfRow, 'chat_teacher'=> $request->chatInput, 'teacher_id'=> $getSessionID,'teacher_id_view' => 1, 'Column_id'=> $request->columnNumberOfRow]
        );
        return response()->json(['success' => true, 'message' => 'Data send successfully']);
    } catch (\Throwable $th) {
        //throw $th;
        return response()->json(['success' => false, 'message' => $th]);
    }
    }
    
}
    /**
     * Alert within redirect function
     */
    public function redirectOptionCompleted()
    {
        return redirect()->back()->with('success', 'Add data successful');
    }

    public function redirectOptionFail()
    {
        return redirect()->back()->with('fail', 'Data already exists');
    }

}
