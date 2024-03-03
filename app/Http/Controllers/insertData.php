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
            ['trasporot_code' => $request->TransportCodeSelect, 'transport_price' => $request->TRPA],
            'trasporot_code',
            $request->TransportCodeSelect
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
        return $this->handleAddData(
            $request,
            ['additionalAllowance' => 'required|string', 'description' => 'required|string'],
            additional_allowance::class,
            ['allowance_amount' => $request->additionalAllowance, 'Description' => $request->description],
            'allowance_amount',
            $request->additionalAllowance
        );
    }

    // Implement other methods similarly...

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
