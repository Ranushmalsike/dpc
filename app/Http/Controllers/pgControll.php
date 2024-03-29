<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

class pgControll extends Controller
{
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
        return view('layout.home');
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
            'per_houser_salary_for_techers.published')
        ->get();
        return view('layout.salaryBand', compact('getData', 'getslarydata'));
        
    }    

    // this function is responsible for transport information and price.
    public function trasnportInformation(){
        $getTransportInformation = transpoer_detail::all();

        $getTransportPrice = transpoer_detail::join('transpoer_price_details', 'transpoer_details.trasporot_code', '=' , 'transpoer_price_details.trasporot_code')
        ->select('transpoer_details.description',
        'transpoer_details.trasporot_code',
        'transpoer_price_details.id',
        'transpoer_price_details.transport_price',)
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
        $additional_allowanceData = additional_allowance::all();

        return view('layout.additionalAllowance', compact('additional_allowanceData'));
        
    }  

    // this function is responsible for credit section.
    public function get_creditSection(){
        $getTeacher = User::join('user_roles', 'users.user_role', '=', 'user_roles.id')
            ->join('user_privet_datas', 'users.id', '=', 'user_privet_datas.user_id')
            ->where('user_roles.roleType', 'teacher')
            ->select('user_privet_datas.first_name', 'user_privet_datas.second_name', 'user_privet_datas.user_id')
            ->get();

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
       
        return view('layout.timeTable');
    }

}
