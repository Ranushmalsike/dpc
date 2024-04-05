<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pgControll;
use App\Http\Controllers\insertData;
use App\Http\Controllers\deleteData;
use App\Http\Controllers\updateData;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
>> front pages of route
*/
Route::get('/', [pgControll::class, 'index'])->name('home');
Route::get('login.login', [pgControll::class, 'login'])->name('login');



/*
>> system maintenance route
*/
Route::group(['prefix' => '/systemMaintenance'], function () {
    Route::get('/index', [pgControll::class, 'systemMaintenance'])->name('homeStaff');
    Route::POST('/admin.register', [insertData::class, 'adminData'])->name('adminsave');
    Route::POST('/permision.register', [insertData::class, 'permissionData'])->name('permisionData');
    Route::POST('/permision.pagePermission', [insertData::class, 'addPagepermission'])->name('addPagepermission.add');

    Route::POST('/proccessTextData', [insertData::class, 'add_proccessText'])->name('processData.add');

    Route::get('/user.delete/{id}', [deleteData::class, 'adminDelete'])->name('delete.userBySystemDeveloper');
    Route::get('/userRole.delete/{id}', [deleteData::class, 'userRoleDelete'])->name('delete.userRoleBySystemDeveloper');
    Route::get('/permissionPage.delete/{id}', [deleteData::class, 'permissionPgDelete'])->name('delete.permissionBySystemDeveloper');
});

/*
>> administrative route
*/
Route::group(['prefix' => '/administrativehub'], function () {
    Route::get('/index', [pgControll::class, 'administrativehub'])->name('administrativehub');
    Route::POST('/login_data', [pgControll::class, 'login_data'])->name('login');
    Route::get('/Class&Subject', [pgControll::class, 'administrativehubClassAndSubject'])->name('classAndSubject');
    Route::get('/RegisterStaff', [pgControll::class, 'administrativehubRegStaffAndTeacher'])->name('RegisterStaff');
    Route::get('/permission/{id}', [pgControll::class, 'administrativehubpermission'])->name('permissionForStaffOrTeacher');
    Route::get('/userPrivateData/{id}', [pgControll::class, 'addPrivateDataUserByStaff'])->name('userPrivateData');
    Route::get('/SalaryRangePerHour', [pgControll::class, 'addSalaryRangeData'])->name('SalaryRangePerHour');
    Route::get('/trasnportInformation', [pgControll::class, 'trasnportInformation'])->name('trasnportInformationAdd');
    Route::get('/allowance', [pgControll::class, 'get_allowance'])->name('allowance');
    Route::get('/additional_allowance', [pgControll::class, 'get_additional_allowance'])->name('additional_allowance');
    Route::get('/credit', [pgControll::class, 'get_creditSection'])->name('credit');
    Route::get('/TimeTableArrangement', [pgControll::class, 'TimeTableArrangement'])->name('TimeTableArrangement');
    Route::get('/teacher_time_tableConfirm', [pgControll::class, 'teacher_time_tableConfirm'])->name('teacher_time_tableConfirm');
    Route::get('/myActivity_salaryCal', [pgControll::class, 'myActivity_salaryCal'])->name('myActivity_salaryCal');
    Route::get('/summery_add', [pgControll::class, 'summery_for_staff'])->name('summery_add');
    Route::POST('/summery_for_chat', [pgControll::class, 'summery_for_chat'])->name('summery_for_chat');
    Route::POST('/summery_recommendedTeacher', [pgControll::class, 'summery_recommendedTeacher'])->name('summery_recommendedTeacher');
    Route::get('/summery_for_teacher', [pgControll::class, 'summery_for_teacher'])->name('summery_for_teacher');
   
});

/*
>> Data transpiring through routes
*/
//Insert
Route::group(['prefix' => '/input'], function () {
    Route::POST('/class', [insertData::class, 'classInputeData'])->name('class_input');
    Route::POST('/subject', [insertData::class, 'subjectInputeData'])->name('Subject_input');
    Route::POST('/registerStaff', [insertData::class, 'staffRegInputeData'])->name('staff_input');
    Route::POST('/registerTeacher', [insertData::class, 'teacherRegInputeData'])->name('teacher_input');
    Route::POST('/AddPermission', [insertData::class, 'addPermisisonByAdminOrStaff'])->name('AddPermissionForUser');
    Route::POST('/AddsalaryBand', [insertData::class, 'addSalaryBand'])->name('AddTeacherSalaryByStaff');
    Route::POST('/AddTrasnport', [insertData::class, 'insert_TranportData'])->name('AddTrasnportData');
    Route::POST('/AddTrasnportPrice', [insertData::class, 'insert_TranportData_price'])->name('AddTrasnportDataPrice');
    Route::POST('/Addallowance', [insertData::class, 'insert_allowance'])->name('Addallowance');
    Route::POST('/Addadditional_allowance', [insertData::class, 'insert_Additional_allowance'])->name('Addadditional_allowance');
    Route::POST('/creditInsert', [insertData::class, 'insert_creditSection'])->name('creditInsert');
    Route::POST('/Add_DeleteData_from_timeArrangement', [insertData::class, 'insert_DateFromArrangeTimeTable'])->name('Add_DeleteData_from_timeArrangement');
    Route::POST('/timeArrangement_save', [insertData::class, 'timeArrangement_save'])->name('timeArrangement_save');
    Route::POST('/Add_summery_schema', [insertData::class, 'Add_summery_schema'])->name('Add_summery_schema');
    Route::POST('/selected_teacher_forSummery', [insertData::class, 'selected_teacher'])->name('selected_teacher_forSummery');
    Route::POST('/chat_input', [insertData::class, 'chat_input'])->name('chat_input');
   
});

//Delete
Route::group(['prefix' => '/administrativehub'], function () {
    Route::GET('/Class.delete/{id}', [deleteData::class, 'classDelete'])->name('class.delete');
    Route::GET('/subject.delete/{id}', [deleteData::class, 'subjectDelete'])->name('subject.delete');
    Route::GET('/staff.delete/{id}', [deleteData::class, 'staffDelete'])->name('staff.delete');
    Route::GET('/teacher.delete/{id}', [deleteData::class, 'teacherDelete'])->name('teacher.delete');
    Route::GET('/permissionForUser.delete/{id}', [deleteData::class, 'permission_foruserDelete'])->name('permissionForUser.delete');
    Route::GET('/PerHourSalaryBand.delete/{id}', [deleteData::class, 'PerHour_SalaryBandDelete'])->name('perHourSalaryBand.delete');
    Route::GET('/Trasnport_detials.delete/{id}', [deleteData::class, 'delete_Transport_detials'])->name('Trasnport_detials.delete');
    Route::GET('/Trasnport_detials_price.delete/{id}', [deleteData::class, 'delete_transport_detials_price'])->name('Trasnport_detials_price.delete');
    Route::GET('/allowance.delete/{id}', [deleteData::class, 'delete_allowance'])->name('allowance.delete');
    Route::GET('/additional_allowance.delete/{id}', [deleteData::class, 'delete_additional_allowance'])->name('additional_allowance.delete');
    Route::GET('/credit.delete/{id}', [deleteData::class, 'delete_Creadit'])->name('credit.delete');
    Route::GET('/delete_TimeArrangement.delete/{id}', [deleteData::class, 'delete_TimeArrangement'])->name('delete_TimeArrangement.delete');
    Route::GET('/delete_summery.delete/{id}', [deleteData::class, 'delete_summery'])->name('delete_summery.delete');
    Route::GET('/delete_recommended.delete/{id}', [deleteData::class, 'delete_recommended'])->name('delete_recommended.delete');
});


//Update
Route::group(['prefix' => '/administrativehub/edit'], function () {
    Route::GET('/Class/{class_id}', [updateData::class, 'classEdit'])->name('class.edit');
    Route::GET('/Subject/{subject_id}', [updateData::class, 'subjectEdit'])->name('subject.edit');
    Route::GET('/staff/{staff_id}', [updateData::class, 'staffEdit'])->name('staff.edit');
    Route::GET('/teacher/{teacher_id}', [updateData::class, 'teacherEdit'])->name('teacher.edit');
    Route::POST('/teacher/PrivateData', [updateData::class, 'addUserPrivateDataByStaff'])->name('teacher.PrivateData');
    Route::GET('/updateCredit_reject_loan/{id}', [updateData::class, 'updateCredit_reject_loan'])->name('updateCredit_reject_loan.Update');
    Route::GET('/updateCredit_confirmed_loan/{id}', [updateData::class, 'updateCredit_confirmed_loan'])->name('updateCredit_confirmed_loan.Update');
    Route::GET('/updateCredit_allcompleted/{id}', [updateData::class, 'updateCredit_allcompleted'])->name('updateCredit_allcompleted.Update');
    Route::GET('/SetDefaultTrasportCode/{id}', [updateData::class, 'setDefaultTransportPrice'])->name('SetDefaultTrasportCode.Update');
    Route::GET('/confirmedByAdmin/schedule/{id}', [updateData::class, 'confirm_schedule'])->name('confirmedByAdmin.Update');
    Route::GET('/resetByAdmin/schedule/{id}', [updateData::class, 'reset_schedule'])->name('resetByAdmin.Update');
    Route::GET('/trp_schedule_Up/schedule/{id}', [updateData::class, 'trp_schedule_Up'])->name('trp_schedule_Up.Update');
    Route::POST('/schedule_edit/schedule/', [updateData::class, 'schedule_edit'])->name('schedule_edit.Update');
    Route::GET('/setDefaultSalaryBand/{id}', [updateData::class, 'setDefaultSalaryBand'])->name('setDefaultSalaryBand.Update');
    Route::POST('/Update_percentage', [updateData::class, 'Update_percentage'])->name('Update_percentage.Update');
});




//Route::GET('/administrativehub.Class.delete/{id}', [deleteData::class, 'classDelete'])->name('class.delete');
//Route::GET('/administrativehub.subject.delete/{id}', [deleteData::class, 'subjectDelete'])->name('subject.delete');
//Route::GET('/administrativehub.staff.delete/{id}', [deleteData::class, 'staffDelete'])->name('staff.delete');
// Route::GET('/administrativehub.teacher.delete/{id}', [deleteData::class, 'teacherDelete'])->name('teacher.delete');



//Update
//Route::GET('/administrativehub.Class.edit/{class_id}', [updateData::class, 'classEdit'])->name('class.edit');
//Route::GET('/administrativehub.Subject.edit/{subject_id}', [updateData::class, 'subjectEdit'])->name('subject.edit');
//Route::GET('/administrativehub.staff.edit/{staff_id}', [updateData::class, 'staffEdit'])->name('staff.edit');
