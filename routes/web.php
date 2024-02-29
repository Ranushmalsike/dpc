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
Route::get('/systemMaintenance.index', [pgControll::class, 'systemMaintenance'])->name('homeStaff');
//Insert option for system developer
Route::POST('/admin.register', [insertData::class, 'adminData'])->name('adminsave');
Route::POST('/permision.register', [insertData::class, 'permissionData'])->name('permisionData');
Route::POST('/permision.pagePermission', [insertData::class, 'addPagepermission'])->name('addPagepermission.add');
// >> system maintenance route of delete section
Route::get('/systemMaintenance.user.delete/{id}', [deleteData::class, 'adminDelete'])->name('delete.userBySystemDeveloper');
Route::get('/systemMaintenance.userRole.delete/{id}', [deleteData::class, 'userRoleDelete'])->name('delete.userRoleBySystemDeveloper');
Route::get('/systemMaintenance.permissionPage.delete/{id}', [deleteData::class, 'permissionPgDelete'])->name('delete.permissionBySystemDeveloper');

/*
>> administrative route
*/
Route::get('/administrativehub.index', [pgControll::class, 'administrativehub'])->name('administrativehub');
Route::get('/administrativehub.Class&Subject', [pgControll::class, 'administrativehubClassAndSubject'])->name('classAndSubject');
Route::get('/administrativehub.RegisterStaff', [pgControll::class, 'administrativehubRegStaffAndTeacher'])->name('RegisterStaff');
Route::get('/administrativehub.permission/{id}', [pgControll::class, 'administrativehubpermission'])->name('permissionForStaffOrTeacher');
Route::get('/administrativehub.userPrivateData/{id}', [pgControll::class, 'addPrivateDataUserByStaff'])->name('userPrivateData');
Route::get('/administrativehub.SalaryRangePerHour', [pgControll::class, 'addSalaryRangeData'])->name('SalaryRangePerHour');


/*
>> Data transpiring through routes
*/
//Insert
Route::POST('/input.class', [insertData::class, 'classInputeData'])->name('class_input');
Route::POST('/input.subject', [insertData::class, 'subjectInputeData'])->name('Subject_input');
Route::POST('/input.registerStaff', [insertData::class, 'staffRegInputeData'])->name('staff_input');
Route::POST('/input.registerTeacher', [insertData::class, 'teacherRegInputeData'])->name('teacher_input');
Route::POST('/input.AddPermission', [insertData::class, 'addPermisisonByAdminOrStaff'])->name('AddPermissionForUser');


//Delete
Route::GET('/administrativehub.Class.delete/{id}', [deleteData::class, 'classDelete'])->name('class.delete');
Route::GET('/administrativehub.subject.delete/{id}', [deleteData::class, 'subjectDelete'])->name('subject.delete');
Route::GET('/administrativehub.staff.delete/{id}', [deleteData::class, 'staffDelete'])->name('staff.delete');
Route::GET('/administrativehub.teacher.delete/{id}', [deleteData::class, 'teacherDelete'])->name('teacher.delete');
Route::GET('/administrativehub.permissionForUser.delete/{id}', [deleteData::class, 'permission_foruserDelete'])->name('permissionForUser.delete');

//Update
Route::GET('/administrativehub.Class.edit/{class_id}', [updateData::class, 'classEdit'])->name('class.edit');
Route::GET('/administrativehub.Subject.edit/{subject_id}', [updateData::class, 'subjectEdit'])->name('subject.edit');
Route::GET('/administrativehub.staff.edit/{staff_id}', [updateData::class, 'staffEdit'])->name('staff.edit');
Route::GET('/administrativehub.teacher.edit/{teacher_id}', [updateData::class, 'teacherEdit'])->name('teacher.edit');
Route::POST('/administrativehub.teacher.PrivateData/', [updateData::class, 'addUserPrivateDataByStaff'])->name('teacher.PrivateData');





//Route::GET('/administrativehub.Class.delete/{id}', [deleteData::class, 'classDelete'])->name('class.delete');
//Route::GET('/administrativehub.subject.delete/{id}', [deleteData::class, 'subjectDelete'])->name('subject.delete');
//Route::GET('/administrativehub.staff.delete/{id}', [deleteData::class, 'staffDelete'])->name('staff.delete');
// Route::GET('/administrativehub.teacher.delete/{id}', [deleteData::class, 'teacherDelete'])->name('teacher.delete');



//Update
//Route::GET('/administrativehub.Class.edit/{class_id}', [updateData::class, 'classEdit'])->name('class.edit');
//Route::GET('/administrativehub.Subject.edit/{subject_id}', [updateData::class, 'subjectEdit'])->name('subject.edit');
//Route::GET('/administrativehub.staff.edit/{staff_id}', [updateData::class, 'staffEdit'])->name('staff.edit');
