<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use App\Models\classTb;
use App\Models\subjectTB;
use App\Models\User;
use App\Models\userRole;
use App\Models\permissionPage;
use App\Models\permissionPageforuser;
use App\Models\user_privet_data;
use App\Models\perHouserSalaryForTecher;
use App\Models\transpoer_detail;
use App\Models\transpoer_price_details;
use App\Models\allowanceTb;
use App\Models\additional_allowance;
use App\Models\credit_d3;
use App\Models\creditTB_d1;
use App\Models\creditTB_d2;
use App\Models\time_arrangemtn_confirm_and_transfer;
use App\Models\how_gen_salary;
use App\Models\schedul_cal;
use App\Models\salary_summary_by_month;
use App\Models\chat_of_summery;
use App\Models\summery_schema;
use App\Models\summery_recomendation;

class pgControll extends Controller
{
   public $generallyInfo;
   public $teacher_task_info;
    public function __construct()
    {
        // Constructor logic goes here
        $this->generallyInfo = new Public_qry();
        $this->teacher_task_info = new teacher_for_task();
    }
    // This function is responsible for the welcome section of the route
    public function index(){
        return view('welcome');
    }

    // This function is responsible for the login section of the route
    public function login(){
        return view('login.login');
    }

    // This function is responsible for system maintenance. It is part of the administrative functionalities.
    public function systemMaintenance(){
        $admintb = User::all();
        $permissionTB = permissionPage::all();
        $userRole = userRole::all();
        $proccessTypeData = credit_d3::all();

        return view('adm.homeStaff', compact('admintb', 'permissionTB', 'userRole', 'proccessTypeData'));
    }

    //Administrative section of route 
    public function administrativehub(){
        $salarySummaries = salary_summary_by_month::all(); // Fetch all records from the view
        $loanForMonth = $this->generallyInfo->monthLoanTotal();
         $admin_Confirmed_all_session_of_month_for_admin = $this->teacher_task_info->admin_Confirmed_all_session_of_month_for_admin();
         $admin_GetFullScheduleOfMonth_all = $this->teacher_task_info->admin_GetFullScheduleOfMonth_all();
         $get_allSalary_for_this_month = $this->generallyInfo->get_allSalary_for_this_month();
         $get_allSalary_for_previous_month = $this->generallyInfo->get_allSalary_for_previous_month();
         $month_total_loan = $this->generallyInfo->month_total_loan();
         $month_total_additional_allowance = $this->generallyInfo->month_total_additional_allowance();
         $rank_with_month_salary_of_teacher = $this->generallyInfo->rank_with_month_salary_of_teacher();
        return view('layout.home', compact(
            'salarySummaries', 
            'loanForMonth', 
            'admin_Confirmed_all_session_of_month_for_admin',
            'admin_GetFullScheduleOfMonth_all',
            'get_allSalary_for_this_month',
            'get_allSalary_for_previous_month',
            'month_total_loan',
            'month_total_additional_allowance',
            'rank_with_month_salary_of_teacher'
        ));
    }


    // This function is responsible for  class and subject. It is part of the administrative functionalities.
    public function administrativehubClassAndSubject(){
        $getClassData = classTb::all();
        $getSubjectData = subjectTB::all();
        return view('layout.createClassAndSubject', compact('getClassData', 'getSubjectData'));
    }


    // This function is responsible for staff and teacher members. It is part of the administrative functionalities.
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

    // Route for managing permissions in the administrative section
    public function administrativehubpermission($id){

         $getStaff = User::join('user_roles', 'users.user_role', '=', 'user_roles.id')
            ->where('users.id', '=', $id)
            ->select('users.*', 'user_roles.roleType')
            ->get();
            
            $HimOrherPermision = permissionPageforuser::groupBy('permission_pageforusers.user_id', 'permission_pageforusers.id', 'users.name')
    ->join('users', 'permission_pageforusers.user_id', '=', 'users.id')
    ->join('permission_pages', 'permission_pages.id', '=', 'permission_pageforusers.permission_id')
    ->where('permission_pageforusers.user_id', '=', $id)
    ->select('permission_pageforusers.id AS pmvid', 'users.name AS name', permissionPageforuser::raw("GROUP_CONCAT(permission_pages.nameOfPage ORDER BY permission_pageforusers.permission_id) AS permissionTg"))
    ->get();


        return view('layout.pemissionAddOrUpdate', compact('getStaff', 'HimOrherPermision'));
        
    }    

    //This function is responsible for private data for staff members. It is part of the administrative functionalities.
    public function addPrivateDataUserByStaff($id){
        $getData = User::join('user_privet_datas', 'users.id', '=', 'user_privet_datas.user_id')
            ->where('users.id', '=', $id)
            ->select('users.name', 
                'user_privet_datas.user_id',
                'user_privet_datas.first_name',
                'user_privet_datas.second_name',
                'user_privet_datas.address',
                'user_privet_datas.NIC',
                'user_privet_datas.contact_number',
            )
            ->get();
           
        return view('layout.addPrivateData', compact('getData'));
        
    }    

    // This function is responsible for salary bands for staff members. It is part of the administrative functionalities.
    public function addSalaryRangeData(){
        $getData = user_privet_data::all();

        $getslarydata = perHouserSalaryForTecher::join('user_privet_datas', 'per_houser_salary_for_techers.user_id', '=' , 'user_privet_datas.user_id')
        ->select('user_privet_datas.first_name', 
            'user_privet_datas.second_name', 
            'per_houser_salary_for_techers.user_id', 
            'per_houser_salary_for_techers.perHourSalary',
            'per_houser_salary_for_techers.id',
            'per_houser_salary_for_techers.published',
            'per_houser_salary_for_techers.Default_set')
        ->get();
        return view('layout.salaryBand', compact('getData', 'getslarydata'));
        
    }    

    // this function is responsible for transport information and price.
    public function trasnportInformation(){
        $getTransportInformation = $this->generallyInfo->transportDetials();

        $getTransportPrice = transpoer_detail::join('transpoer_price_details', 'transpoer_details.trasporot_code', '=' , 'transpoer_price_details.trasporot_code')
        ->select('transpoer_details.description',
        'transpoer_details.trasporot_code',
        'transpoer_price_details.id',
        'transpoer_price_details.transport_price',
        'transpoer_price_details.setDef')
        ->get();
        return view('layout.tarnsportInformation', compact('getTransportInformation', 'getTransportPrice'));
        
    }    

    // this function is responsible for allowance.
    public function get_allowance(){
        $allowanceData = allowanceTb::all();

        return view('layout.aollowance', compact('allowanceData'));
        
    }    

    // this function is responsible for additional allowance.
    public function get_additional_allowance(){
        $additional_allowanceData = additional_allowance::join('user_privet_datas', 'additional_allowances.user_id', '=', 'user_privet_datas.user_id')
        ->select(
            'user_privet_datas.first_name',
            'user_privet_datas.second_name',
            'additional_allowances.allowance_amount',
            'additional_allowances.Description',
            'additional_allowances.id'
        )        
        ->get();
         $getTeacher = $this->generallyInfo->teacherName();
        return view('layout.additionalAllowance', compact('additional_allowanceData', 'getTeacher'));
        
    }  

    // this function is responsible for credit section.
    public function get_creditSection(){
      $getTeacher = $this->generallyInfo->teacherName();

    $getloanDetails = creditTB_d1::join('credit_t_b_d2s', 'credit_t_b_d1s.id', '=', 'credit_t_b_d2s.credit_id')
    ->join('credit_d3s', 'credit_t_b_d2s.type_id', '=', 'credit_d3s.id')
    ->join('user_privet_datas', 'credit_t_b_d1s.user_id', '=', 'user_privet_datas.user_id')
    ->select('credit_t_b_d1s.id AS credit_id_of_baseTB',
        'user_privet_datas.first_name AS first_name', 
        'user_privet_datas.second_name AS second_name', 
        'user_privet_datas.user_id AS user_id',
        'credit_t_b_d1s.amount AS amount',
        'credit_t_b_d1s.provide_date AS provide_date',
        DB::raw("CASE
                WHEN credit_t_b_d1s.type_id = 1 THEN 'Pending'
                WHEN credit_t_b_d1s.type_id = 2 THEN 'Reject'
                WHEN credit_t_b_d1s.type_id = 3 THEN 'Confirmed'
                WHEN credit_t_b_d1s.type_id = 4 THEN 'Completed'
                ELSE 'Unknown'
            END AS type_ofmainTB"),
        'credit_t_b_d2s.id AS credit_id_of_detail_subTB',
        'credit_t_b_d2s.installment AS installment',
        'credit_t_b_d2s.installment_date AS installment_date',
        'credit_d3s.type AS type_ofsubTB')
    ->get();

        return view('layout.creaditSection', compact('getTeacher', 'getloanDetails'));
        
    }    

    /**
    * Time Table Arrangement
    */
    public function TimeTableArrangement(){
        $getTeacher = $this->generallyInfo->teacherName();
        $getClassVal = $this->generallyInfo->classTBValues();
        $getSubjectVal = $this->generallyInfo->subjectTBValues();
        $getTransportInformation = $this->generallyInfo->transport_DefaultValues();
        $getTimeArrangementDetails = $this->generallyInfo->selectTimeArrangement();
        return view('layout.timeTable', compact('getTeacher', 'getClassVal', 'getSubjectVal', 'getTransportInformation', 'getTimeArrangementDetails'));
    }

    /**
     * Login section
     */
    protected function login_data(Request $request){
    try {
        // Retrieve the user and additional details by username
        $user_details = User::join('user_privet_datas', 'users.id', '=', 'user_privet_datas.user_id')
            ->join('user_roles', 'users.user_role', '=', 'user_roles.id')
            ->select(
                'users.id',
                'users.name',
                'users.password', // Ensure the password is selected for authentication check
                'user_privet_datas.first_name',
                'user_privet_datas.second_name',
                'user_roles.roleType'
            )
            ->where('users.name', $request->user_name) // Assuming 'users.name' is the correct column
            ->first();

        // Check if user details exist and password is correct
        if ($user_details && Hash::check($request->user_pass, $user_details->password)) {
            // Manually log in the user
            Auth::login($user_details);

            // Authentication passed, user is logged in
            return response()->json(['success' => true, 'message' => 'Login successful.', 'redirectUrl' => route('administrativehub')]);
        }
        
        // Authentication failed
        return response()->json(['success' => false, 'message' => 'Invalid credentials.']);

        } catch (\Throwable $th) {
            //throw $th;
             return response()->json(['success' => false, 'message' => $th]);
        }
    }

/**
 * 
 */
public function teacher_time_tableConfirm(){
    $getTeacher = $this->generallyInfo->teacherName();
    $getTimeArrangementDetails = $this->generallyInfo->selectTimeArrangementForTeacher();
    return view('layout.timetble_Teacher', compact('getTeacher', 'getTimeArrangementDetails'));
    
}
/**
 * 
 */
public function myActivity_salaryCal(){
    $getMyActivity = $this->generallyInfo->for_myActivity_salaryCal();
    $getTotalCompleted_task = $this->teacher_task_info->Teacher_for_total_Completed_Task(); // completed Task
    $getTotalAdditionalTask = $this->teacher_task_info->Teacher_for_total_additional_Task(); // additional Task
    $getTotalReceived_task = $this->teacher_task_info->Teacher_for_total_Received_Task(); //month for task
    $getTotalSchedule_calculationForMonth = $this->teacher_task_info->Teacher_for_total_Schedule_calculation(); //month for task
    $Teacher_for_total_Additional_Allowance_Task = $this->teacher_task_info->Teacher_for_total_Additional_Allowance_Task(); //month for task
    $Teacher_for_total_trp_Task = $this->teacher_task_info->Teacher_for_total_trp_Task(); //month for task
    $Teacher_for_total_Allowance_Task = $this->teacher_task_info->Teacher_for_total_Allowance_Task(); //month for task
    $Teacher_for_total_credit_Task = $this->teacher_task_info->Teacher_for_total_credit_Task(); //month for task
    $Teacher_for_total_Total_Salary = $this->teacher_task_info->Teacher_for_total_Total_Salary(); //month for task
    return view('layout.myActivity', compact('getMyActivity',
     'getTotalCompleted_task',
      'getTotalAdditionalTask', 
      'getTotalReceived_task',
       'getTotalSchedule_calculationForMonth',
       'Teacher_for_total_Additional_Allowance_Task',
       'Teacher_for_total_Allowance_Task',
       'Teacher_for_total_credit_Task',
       'Teacher_for_total_Total_Salary',
        'Teacher_for_total_trp_Task'));
    
}

//Summery for staff
public function summery_for_staff() {
    $getClassData = classTb::all();
    $getTeacherData = $this->generallyInfo->teacherName();
    $summery_view_for_staff = $this->generallyInfo->summery_view_for_staff();

    return view('layout.staff_summery', compact('getClassData', 'getTeacherData', 'summery_view_for_staff'));
    
}
//Summery for chat
public function summery_for_chat(Request $request) {
    try {
    $summeryId = $request->id;  
    $columnId = $request->cellIndex; 
    $chats = chat_of_summery::leftJoin('users', 'chat_of_summeries.staff_id', '=', 'users.id')
    ->leftJoin('user_privet_datas', 'chat_of_summeries.teacher_id', '=', 'user_privet_datas.user_id')
    ->select('chat_of_summeries.chat_time as chat_time', 'chat_of_summeries.chat_staff as chat_staff', 'users.name as name', 'chat_of_summeries.chat_teacher as chat_teacher', 'user_privet_datas.first_name as first_name', 'user_privet_datas.second_name as second_name')
    ->where('chat_of_summeries.summery_id', $summeryId)
    ->where('chat_of_summeries.column_id', $columnId)
    ->orderBy('chat_of_summeries.chat_time')
    ->get();
    return response()->json($chats);
      } catch (\Throwable $th) {
        //throw $th;
         return response()->json(['success' => false, 'message' => $th]);
    }
}
//Summery recommended teachers
public function summery_recommendedTeacher(Request $request) {
    try {
    $summeryId = $request->id; 
    // dd($summeryId);
    $summeryRecommendations = summery_recomendation::leftJoin('user_privet_datas', 'user_privet_datas.user_id', '=', 'summery_recomendations.teacher_id')
    ->select('summery_recomendations.id', 'user_privet_datas.first_name', 'user_privet_datas.second_name')
    ->where('summery_recomendations.summery_id',  $summeryId)
    ->get();
    return response()->json($summeryRecommendations);
      } catch (\Throwable $th) {
         return response()->json(['success' => false, 'message' => $th]);
    }
}

//Summery for teacher
public function summery_for_teacher() {
    $summery_view_for_teacher = $this->generallyInfo->summery_view_for_teacher();
    return view('layout.teacher_summery', compact('summery_view_for_teacher'));
    
}
}











/**
 * ==========================================general query============================
 */
class Public_qry{
    // Get Only Teachers Name
    public function teacherName() {
       return $getTeacher = User::join('user_roles', 'users.user_role', '=', 'user_roles.id')
        ->join('user_privet_datas', 'users.id', '=', 'user_privet_datas.user_id')
        ->where('user_roles.roleType', 'teacher')
        ->select('user_privet_datas.first_name', 'user_privet_datas.second_name', 'user_privet_datas.user_id')
        ->get();
        
    }
    // Get ClassTb Values
    public function classTBValues() {
       return $getClassData = classTb::all();
        
    }
    // Get SubjectTB Values
    public function subjectTBValues() {
       return $getSubjectData = subjectTB::all();
        
    }

    // Transport details
    public function transportDetials() {
        return $getTransportInformation = transpoer_detail::all();
        
    }

    //select Default transport values
    public function transport_DefaultValues(){
        return $getTransportPrice_default = transpoer_detail::join('transpoer_price_details', 'transpoer_details.trasporot_code', '=' , 'transpoer_price_details.trasporot_code')
       ->where('setDef', '1')
        ->select('transpoer_details.description',
        'transpoer_details.trasporot_code',
        'transpoer_price_details.id',
        'transpoer_price_details.transport_price',
        'transpoer_price_details.setDef')
        ->get();
        
    } 

    // select Time Arrangement data for Staff and admin
public function selectTimeArrangement(){
    return time_arrangemtn_confirm_and_transfer::join('user_privet_datas', 'time_arrangemtn_confirm_and_transfers.user_id', '=', 'user_privet_datas.user_id')
    ->join('class_tbs', 'time_arrangemtn_confirm_and_transfers.class_id', '=', 'class_tbs.id')
    ->join('subject_t_b_s', 'time_arrangemtn_confirm_and_transfers.subject_id', '=', 'subject_t_b_s.id')
    ->join('transpoer_price_details', 'time_arrangemtn_confirm_and_transfers.transport_id', '=', 'transpoer_price_details.id')
    ->select(
        'user_privet_datas.first_name',
        'user_privet_datas.second_name',
        'class_tbs.dpcclass',
        'subject_t_b_s.subject',
        'transpoer_price_details.trasporot_code',
        'time_arrangemtn_confirm_and_transfers.confirm',
        'time_arrangemtn_confirm_and_transfers.Transfer',
        'time_arrangemtn_confirm_and_transfers.Time_arrangement',
        'time_arrangemtn_confirm_and_transfers.start_time',
        'time_arrangemtn_confirm_and_transfers.end_time',
        'time_arrangemtn_confirm_and_transfers.id',
        DB::raw("CASE 
            WHEN time_arrangemtn_confirm_and_transfers.Trp_for_whom_user_id = user_privet_datas.user_id THEN 
                CONCAT(user_privet_datas.first_name, ' ', user_privet_datas.second_name) 
            ELSE 'none' 
            END AS first_name_second_name"),
        'time_arrangemtn_confirm_and_transfers.Trp_confirmed'
    )
    ->get();

    }
// Select Time Arrangement data for Teacher
public function selectTimeArrangementForTeacher() {
    $getSessionID = auth()->user()->id;
    // dd($getSessionID);

    return time_arrangemtn_confirm_and_transfer::where('time_arrangemtn_confirm_and_transfers.user_id', '=', $getSessionID)
    ->orWhere('time_arrangemtn_confirm_and_transfers.Trp_for_whom_user_id', '=', $getSessionID)
    ->join('user_privet_datas', 'time_arrangemtn_confirm_and_transfers.user_id', '=', 'user_privet_datas.user_id')
    ->join('class_tbs', 'time_arrangemtn_confirm_and_transfers.class_id', '=', 'class_tbs.id')
    ->join('subject_t_b_s', 'time_arrangemtn_confirm_and_transfers.subject_id', '=', 'subject_t_b_s.id')
    ->join('transpoer_price_details', 'time_arrangemtn_confirm_and_transfers.transport_id', '=', 'transpoer_price_details.id')
    ->select(
        'user_privet_datas.first_name',
        'user_privet_datas.second_name',
        'class_tbs.dpcclass',
        'subject_t_b_s.subject',
        'transpoer_price_details.trasporot_code',
        'time_arrangemtn_confirm_and_transfers.confirm',
        'time_arrangemtn_confirm_and_transfers.Transfer',
        'time_arrangemtn_confirm_and_transfers.Time_arrangement',
        'time_arrangemtn_confirm_and_transfers.start_time',
        'time_arrangemtn_confirm_and_transfers.end_time',
        'time_arrangemtn_confirm_and_transfers.id',
        DB::raw("CASE 
            WHEN time_arrangemtn_confirm_and_transfers.Trp_for_whom_user_id = user_privet_datas.user_id THEN 
                CONCAT(user_privet_datas.first_name, ' ', user_privet_datas.second_name) 
            ELSE 'none' 
            END AS first_name_second_name"),
        'time_arrangemtn_confirm_and_transfers.Trp_confirmed'
    )
    ->get();

}
/**
 * Teacher Activity
 */
public function for_myActivity_salaryCal(){
    $getSessionID = auth()->user()->id;
    //dd($getSessionID);

    return how_gen_salary::where('how_gen_salaries.user_id', $getSessionID)
        ->leftJoin('user_privet_datas', 'how_gen_salaries.user_id', '=', 'user_privet_datas.user_id')
        ->leftJoin('schedul_cals', 'how_gen_salaries.schedule_id', '=', 'schedul_cals.schedule_id_of_cal_gen')
        ->leftJoin('allowance_for_users', function ($join) {
            $join->on('how_gen_salaries.user_id', '=', 'allowance_for_users.user_id')
                ->whereRaw("DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = DATE_FORMAT(how_gen_salaries.today_day, '%Y-%m')");
        })
        ->leftJoin('allowance_tbs', 'allowance_for_users.allowance_id', '=', 'allowance_tbs.id')
        ->leftJoin('transpoer_price_details', 'how_gen_salaries.trp_transport_id', '=', 'transpoer_price_details.id')
        ->leftJoin('additional_allowances', 'how_gen_salaries.additional_allowance_id', '=', 'additional_allowances.id')
        ->leftJoin('credit_t_b_d2s', 'how_gen_salaries.credit_id', '=', 'credit_t_b_d2s.id')
        ->select(
            'how_gen_salaries.id',
            'how_gen_salaries.today_day',
            'how_gen_salaries.description',
            'user_privet_datas.first_name',
            'user_privet_datas.second_name',
            'schedul_cals.salary_on_schedul',
            DB::raw("CASE
            WHEN schedul_cals.time_duration != 0 AND schedul_cals.time_duration IS NOT NULL THEN schedul_cals.time_duration
            ELSE 'None'
            END AS `timeduration`"),
            DB::raw("CASE 
            WHEN how_gen_salaries.schedule_id != NULL OR how_gen_salaries.schedule_id != 0 THEN
            'Schedule'
            WHEN DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = DATE_FORMAT(how_gen_salaries.today_day, '%Y-%m') AND how_gen_salaries.user_id = allowance_for_users.user_id THEN
            'Allowance'
            WHEN how_gen_salaries.trp_transport_id != 0 OR how_gen_salaries.trp_transport_id != NULL THEN
            'Transport'
            WHEN how_gen_salaries.additional_allowance_id != 0 OR how_gen_salaries.additional_allowance_id != NULL THEN
            'Additional Allowance'
            END AS `Paymenent_description`"),
            DB::raw("CASE 
            WHEN how_gen_salaries.schedule_id != NULL OR how_gen_salaries.schedule_id != 0 THEN
            schedul_cals.salary_on_schedul
            WHEN DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = DATE_FORMAT(how_gen_salaries.today_day, '%Y-%m') AND how_gen_salaries.user_id = allowance_for_users.user_id THEN
            allowance_tbs.allowance
            WHEN how_gen_salaries.trp_transport_id != 0 OR how_gen_salaries.trp_transport_id != NULL THEN
            transpoer_price_details.transport_price
            WHEN how_gen_salaries.additional_allowance_id != 0 OR how_gen_salaries.additional_allowance_id != NULL THEN
            additional_allowances.allowance_amount
            END AS `Paymenent`")
        )
        ->get();


}
public function monthLoanTotal() {
    return $creditsPerMonth = DB::table('credit_t_b_d1s')
    ->select(
        DB::raw("DATE_FORMAT(provide_date, '%Y-%m') as `date_and_year`"),
        DB::raw('COALESCE(SUM(amount), 0.00) as `credit_month`')
    )
    ->groupBy(DB::raw("DATE_FORMAT(provide_date, '%Y-%m')"))
    ->get();
}
// current month all salary
public function get_allSalary_for_this_month() {
    $year_month = date("Y-m"); 
    return  DB::table('how_gen_salaries as hgs')
            ->select(
                DB::raw("DATE_FORMAT(hgs.today_day, '%Y-%m') as salary_month"),
                DB::raw("COALESCE(SUM(sc.salary_on_schedul), 0.00) as schedule_total"),
                DB::raw("COALESCE(SUM(at.allowance), 0.00) as allowance_total"),
                DB::raw("COALESCE(SUM(aa.allowance_amount), 0.00) as additional_allowance_total"),
                DB::raw("COALESCE(SUM(tpd.transport_price), 0.00) as transport_total"),
                DB::raw("COALESCE(SUM(cred.installment), 0.00) as credit_total"),
                DB::raw("(COALESCE(SUM(sc.salary_on_schedul), 0) + 
                         COALESCE(SUM(at.allowance), 0) + 
                         COALESCE(SUM(aa.allowance_amount), 0) + 
                         COALESCE(SUM(tpd.transport_price), 0) - 
                         COALESCE(SUM(cred.installment), 0)) as groupnetSumV")
            )
            ->leftJoin('schedul_cals as sc', 'hgs.schedule_id', '=', 'sc.id')
            ->leftJoin('allowance_for_users as afu', 'hgs.user_id', '=', 'afu.user_id')
            ->leftJoin('allowance_tbs as at', 'afu.allowance_id', '=', 'at.id')
            ->leftJoin('additional_allowances as aa', 'hgs.additional_allowance_id', '=', 'aa.id')
            ->leftJoin('transpoer_price_details as tpd', 'hgs.trp_transport_id', '=', 'tpd.id')
            ->leftJoin('credit_t_b_d2s as cred', 'hgs.credit_id', '=', 'cred.id')
            ->whereRaw("DATE_FORMAT(hgs.today_day, '%Y-%m') = $year_month")
            ->groupBy(DB::raw("DATE_FORMAT(hgs.today_day, '%Y-%m')"))
            ->get();
}
// previous month all salary
public function get_allSalary_for_previous_month() {
    $year_month = date("Y/m", strtotime("-1 month"));
    return  DB::table('how_gen_salaries as hgs')
            ->select(
                DB::raw("DATE_FORMAT(hgs.today_day, '%Y-%m') as salary_month"),
                DB::raw("COALESCE(SUM(sc.salary_on_schedul), 0.00) as schedule_total"),
                DB::raw("COALESCE(SUM(at.allowance), 0.00) as allowance_total"),
                DB::raw("COALESCE(SUM(aa.allowance_amount), 0.00) as additional_allowance_total"),
                DB::raw("COALESCE(SUM(tpd.transport_price), 0.00) as transport_total"),
                DB::raw("COALESCE(SUM(cred.installment), 0.00) as credit_total"),
                DB::raw("(COALESCE(SUM(sc.salary_on_schedul), 0) + 
                         COALESCE(SUM(at.allowance), 0) + 
                         COALESCE(SUM(aa.allowance_amount), 0) + 
                         COALESCE(SUM(tpd.transport_price), 0) - 
                         COALESCE(SUM(cred.installment), 0)) as groupnetSumV")
            )
            ->leftJoin('schedul_cals as sc', 'hgs.schedule_id', '=', 'sc.id')
            ->leftJoin('allowance_for_users as afu', 'hgs.user_id', '=', 'afu.user_id')
            ->leftJoin('allowance_tbs as at', 'afu.allowance_id', '=', 'at.id')
            ->leftJoin('additional_allowances as aa', 'hgs.additional_allowance_id', '=', 'aa.id')
            ->leftJoin('transpoer_price_details as tpd', 'hgs.trp_transport_id', '=', 'tpd.id')
            ->leftJoin('credit_t_b_d2s as cred', 'hgs.credit_id', '=', 'cred.id')
            ->whereRaw("DATE_FORMAT(hgs.today_day, '%Y-%m') = $year_month")
            ->groupBy(DB::raw("DATE_FORMAT(hgs.today_day, '%Y-%m')"))
            ->get();
}
// Month provide loan total
public function month_total_loan() {
    $year_month = date("Y-m"); 
    return  DB::table('credit_t_b_d1s')
                ->select(DB::raw('COALESCE(SUM(amount), 0.00) as monthcredit'))
                ->whereRaw("DATE_FORMAT(provide_date, '%Y-%m') = $year_month")
                ->get();
}
// month_total_additional_allowance
public function month_total_additional_allowance() {
    $year_month = date("Y-m"); 
    return   DB::table('how_gen_salaries')
    ->rightJoin('additional_allowances', 'additional_allowances.id', '=', 'how_gen_salaries.additional_allowance_id')
    ->select(DB::raw('COALESCE(SUM(additional_allowances.allowance_amount), 0.00) AS monthlyadditional_allowance'))
    ->whereRaw("DATE_FORMAT(how_gen_salaries.today_day, '%Y-%m') = $year_month")
    ->get();
}
// month_total_transport
public function month_total_transport() {
    $year_month = date("Y-m"); 
    return   DB::table('how_gen_salaries')
    ->rightJoin('additional_allowances', 'additional_allowances.id', '=', 'how_gen_salaries.additional_allowance_id')
    ->select(DB::raw('COALESCE(SUM(additional_allowances.allowance_amount), 0.00) AS monthlyadditional_allowance'))
    ->whereRaw("DATE_FORMAT(how_gen_salaries.today_day, '%Y-%m') = $year_month")
    ->get();
}
// rank_with_month_salary_of_teacher
public function rank_with_month_salary_of_teacher() {
    $year_month = date("Y-m"); 
    return  $result = DB::table('how_gen_salaries as hgs')
    ->select([
        'upd.first_name',
        'upd.second_name',
        DB::raw('COALESCE(SUM(sc.salary_on_schedul), 0.00) as schedule_total'),
        DB::raw('COALESCE(SUM(at.allowance), 0.00) as allowance_total'),
        DB::raw('COALESCE(SUM(aa.allowance_amount), 0.00) as additional_allowance_total'),
        DB::raw('COALESCE(SUM(tpd.transport_price), 0.00) as transport_total'),
        DB::raw('COALESCE(SUM(cred.installment), 0.00) as credit_total'),
        DB::raw('(COALESCE(SUM(sc.salary_on_schedul), 0) + 
                  COALESCE(SUM(at.allowance), 0) + 
                  COALESCE(SUM(aa.allowance_amount), 0) + 
                  COALESCE(SUM(tpd.transport_price), 0) - 
                  COALESCE(SUM(cred.installment), 0)) as groupnetSumV')
    ])
    ->leftJoin('user_privet_datas as upd', 'hgs.user_id', '=', 'upd.user_id')
    ->leftJoin('schedul_cals as sc', 'hgs.schedule_id', '=', 'sc.id')
    ->leftJoin('allowance_for_users as afu', 'hgs.user_id', '=', 'afu.user_id')
    ->leftJoin('allowance_tbs as at', 'afu.allowance_id', '=', 'at.id')
    ->leftJoin('additional_allowances as aa', 'hgs.additional_allowance_id', '=', 'aa.id')
    ->leftJoin('transpoer_price_details as tpd', 'hgs.trp_transport_id', '=', 'tpd.id')
    ->leftJoin('credit_t_b_d2s as cred', 'hgs.credit_id', '=', 'cred.id')
    ->whereRaw("DATE_FORMAT(hgs.today_day, '%Y-%m') = $year_month")
    ->groupBy('hgs.user_id', 'upd.first_name', 'upd.second_name')
    ->orderBy('groupnetSumV', 'desc')
    ->get();

}
/**
 * summery view for staff
 */
public function summery_view_for_staff(){
    return summery_schema::leftJoin('class_tbs', 'summery_schemas.class_id', '=', 'class_tbs.id')
    ->select(
        'summery_schemas.id',
        'summery_schemas.month_of_summery',
        'summery_schemas.summery_col_1',
        'summery_schemas.Percentage_sum_co_1',
        'summery_schemas.summery_col_2',
        'summery_schemas.Percentage_sum_co_2',
        'summery_schemas.summery_col_3',
        'summery_schemas.Percentage_sum_co_3',
        'summery_schemas.summery_col_4',
        'summery_schemas.Percentage_sum_co_4',
        'summery_schemas.summery_col_5',
        'summery_schemas.Percentage_sum_co_5',
        'summery_schemas.summery_col_6',
        'summery_schemas.Percentage_sum_co_6',
        'summery_schemas.summery_col_7',
        'summery_schemas.Percentage_sum_co_7',
        'class_tbs.dpcclass'
        )
    ->get();
}
/**
 * summery view for teacher
 */
public function summery_view_for_teacher(){
     $getSessionID = auth()->user()->id;
    return summery_schema::leftJoin('class_tbs', 'summery_schemas.class_id', '=', 'class_tbs.id')
    ->rightJoin('summery_recomendations', 'summery_schemas.id', '=', 'summery_recomendations.summery_id')
    ->where('summery_recomendations.teacher_id', $getSessionID)
    ->select(
        'summery_schemas.id',
        'summery_schemas.month_of_summery',
        'summery_schemas.summery_col_1',
        'summery_schemas.Percentage_sum_co_1',
        'summery_schemas.summery_col_2',
        'summery_schemas.Percentage_sum_co_2',
        'summery_schemas.summery_col_3',
        'summery_schemas.Percentage_sum_co_3',
        'summery_schemas.summery_col_4',
        'summery_schemas.Percentage_sum_co_4',
        'summery_schemas.summery_col_5',
        'summery_schemas.Percentage_sum_co_5',
        'summery_schemas.summery_col_6',
        'summery_schemas.Percentage_sum_co_6',
        'summery_schemas.summery_col_7',
        'summery_schemas.Percentage_sum_co_7',
        'class_tbs.dpcclass'
        )
    ->get();
}
}
/**
 * ================================================================================
 * get Data salary sheet for teacher
 */
//

class teacher_for_task{

    public $year_month;

        // received task for one month
public function __construct() {
    // Assign values directly to properties without the extra $
    $this->year_month = date("Y-m"); 
  
}
public function Teacher_for_total_Received_Task()
{
    $user_id = auth()->user()->id;
    return $taskCount = DB::select("SELECT total_received_task(?, ?) AS taskCount", [$this->year_month, $user_id])[0]->taskCount;
}
// Completed additional Task
public function Teacher_for_total_additional_Task(){
    $user_id = auth()->user()->id;
    return $totalTasks = DB::select("SELECT total_additional_tasks(?, ?) AS totalTasks", [$this->year_month, $user_id])[0]->totalTasks;
}
// Completed Task
public function Teacher_for_total_Completed_Task() {
    $user_id = auth()->user()->id;
    return $scheduleConfrimed = DB::select("SELECT confirm_schedule_Completed(?, ?) AS cnfOwnerTask", [$this->year_month, $user_id])[0]->cnfOwnerTask;
}
// Schedule calculation
public function Teacher_for_total_Schedule_calculation() {
    $user_id = auth()->user()->id;
   return $totalSalary = DB::select("SELECT get_total_salary_of_mounthly_schedule(?, ?) AS total_salary", [$user_id, $this->year_month])[0]->total_salary;
}
// Total Allowance
public function Teacher_for_total_Allowance_Task(){
     $user_id = auth()->user()->id;
   return $allowanceAmount = DB::select("SELECT get_allowance(?, ?) AS allowanceAmount", [$user_id, $this->year_month])[0]->allowanceAmount;
}
public function Teacher_for_total_trp_Task(){
    $user_id = auth()->user()->id;
   return $transportPriceSum = DB::select("SELECT get_transport_price_sum(?, ?) AS transportPriceSum", [$user_id, $this->year_month])[0]->transportPriceSum;
}
public function Teacher_for_total_Additional_Allowance_Task(){
     $user_id = auth()->user()->id;
   return $myAdditionalAllowance = DB::select("SELECT get_my_additional_allowance(?, ?) AS myAdditionalAllowance", [$user_id, $this->year_month])[0]->myAdditionalAllowance;
}
public function Teacher_for_total_credit_Task() {
      $user_id = auth()->user()->id;
   return $installmentSum = DB::select("SELECT get_credit_installment_sum(?, ?) AS installmentSum", [$user_id, $this->year_month])[0]->installmentSum;
}
public function Teacher_for_total_Total_Salary() {
      $user_id = auth()->user()->id;
   return $netSumV = DB::select("SELECT monthly_total_of_teacher(?, ?) AS netSumV", [$user_id, $this->year_month])[0]->netSumV;
}
// confirmed all session of month for admin
public function admin_Confirmed_all_session_of_month_for_admin() {
   return $count_confirmed_month = DB::select("SELECT GetConfirmedArrangementsCount(?) AS count_confirmed_month", [$this->year_month])[0]->count_confirmed_month;
}
// confirmed all session of month for admin
public function admin_GetFullScheduleOfMonth_all() {
   return $timesedule_MonthOf = DB::select("SELECT GetFullScheduleOfMonth(?) AS timesedule_MonthOf", [$this->year_month])[0]->timesedule_MonthOf;
}

}

