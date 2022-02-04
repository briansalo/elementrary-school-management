<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\backend\setup\StudentClassController;
use App\Http\Controllers\backend\setup\StudentYearController;
use App\Http\Controllers\backend\setup\StudentGradeController;
use App\Http\Controllers\backend\setup\StudentFeeController;
use App\Http\Controllers\backend\setup\FeeAmountController;
use App\Http\Controllers\backend\setup\SchoolSubjectController;
use App\Http\Controllers\backend\setup\AssignGradeController;
use App\Http\Controllers\backend\setup\DesignationController;

use App\Http\Controllers\backend\student\StudentFeeAmountController;
use App\Http\Controllers\backend\student\StudentRegistrationController;

use App\Http\Controllers\backend\employee\EmployeeRegistrationController;
use App\Http\Controllers\backend\employee\EmployeeSalaryController;
use App\Http\Controllers\backend\employee\EmployeeAttendanceController;
use App\Http\Controllers\backend\employee\EmployeeMonthlySalaryController;
use App\Http\Controllers\backend\employee\EmployeeGeneratePayrollController;

use App\Http\Controllers\backend\class\ClassAssignController;
use App\Http\Controllers\backend\class\ClassStudentGradeController;

use App\Http\Controllers\backend\account\AccountStudentFeeController;
                                    
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');



// UserController All routes

Route::prefix('users')->group(function(){

    Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
    Route::get('/add', [UserController::class, 'UserAdd'])->name('user.add');
    Route::post('/store', [UserController::class, 'UserStore'])->name('user.store');

    Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('user.edit');
    Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('user.update'); 
    
    Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('user.delete');   
}); // end of users prefix




// User profile and change password
Route::prefix('profiles')->group(function(){

    Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');

    Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');
    Route::post('/update', [ProfileController::class, 'ProfileUpdate'])->name('profile.update');

    Route::get('/change_pasword', [ProfileController::class, 'ChangePassword'])->name('profile.change_password'); 
    Route::post('/change_password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');
  
}); //end of profile prefix





Route::prefix('setups')->group(function(){

    Route::get('/student/class/view', [StudentClassController::class, 'ViewStudent'])->name('student.class.view');

    Route::get('/student/class/add', [StudentClassController::class, 'StudentClassAdd'])->name('student.class.add');
    Route::post('/student/class/store', [StudentClassController::class, 'StudentClassStore'])->name('store.student.class');

    Route::get('/student/class/edit/{id}', [StudentClassController::class, 'StudentClassEdit'])->name('student.class.edit');
    Route::post('/student/class/update/{id}', [StudentClassController::class, 'StudentClassUpdate'])->name('student.class.update');
    Route::get('/student/class/delete/{id}', [StudentClassController::class, 'StudentClassDelete'])->name('student.class.delete');


    // student year routes
    Route::get('/student/year/view', [StudentYearController::class, 'ViewYearStudent'])->name('student.year.view');
  
    Route::get('/student/year/add', [StudentYearController::class, 'AddYearStudent'])->name('student.year.add');
    Route::post('/student/year/store', [StudentYearController::class, 'StoreYearStudent'])->name('store.student.year');

    Route::get('/student/year/edit/{id}', [StudentYearController::class, 'EditYearStudent'])->name('student.year.edit');
    Route::post('/student/year/update/{id}', [StudentYearController::class, 'UpdateYearStudent'])->name('student.year.update');

    Route::get('/student/year/delete/{id}', [StudentYearController::class, 'DeleteYearStudent'])->name('student.year.delete');


    // student Fee routes
    Route::get('/student/fee/view', [StudentFeeController::class, 'ViewFeeStudent'])->name('student.fee.view');

    Route::get('/student/fee/add', [StudentFeeController::class, 'AddFeeStudent'])->name('student.fee.add');
    Route::post('/student/fee/store', [StudentFeeController::class, 'StoreFeeStudent'])->name('store.student.fee');

    Route::get('/student/fee/edit/{id}', [StudentFeeController::class, 'EditFeeStudent'])->name('student.fee.edit');
    Route::post('/student/fee/update/{id}', [StudentFeeController::class, 'UpdateFeeStudent'])->name('student.fee.update');

    Route::get('/student/fee/delete/{id}', [StudentFeeController::class, 'DeleteFeeStudent'])->name('student.fee.delete');


    // category amount routes
    Route::get('/category/amount/view', [FeeAmountController::class, 'ViewCategoryAmount'])->name('category.amount.view');

    Route::get('/category/amount/add', [FeeAmountController::class, 'AddFeeAmount'])->name('add.fee.amount');
    Route::post('/category/amount/store', [FeeAmountController::class, 'StoreFeeAmount'])->name('store.fee.amount');

    Route::get('/category/amount/edit/{id}', [FeeAmountController::class, 'EditFeeAmount'])->name('fee.amount.edit');
    Route::post('/category/amount/update/{student_fee_id}', [FeeAmountController::class, 'UpdateFeeAmount'])->name('update.fee.amount');

    Route::get('/category/amount/details/{id}', [FeeAmountController::class, 'DetailsFeeAmount'])->name('fee.amount.details');


    // School Subject routes
     Route::get('school/subject/view', [SchoolSubjectController::class, 'ViewSchoolSubject'])->name('school.subject.view');

     Route::get('/school/subject/add', [SchoolSubjectController::class, 'AddSchoolSubject'])->name('school.subject.add');
     Route::post('/school/subject/store', [SchoolSubjectController::class, 'StoreSchoolSubject'])->name('school.subject.store');

     Route::get('/school/subject/edit/{id}', [SchoolSubjectController::class, 'EditSchoolSubject'])->name('school.subject.edit');
     Route::post('/school/subject/update/{id}', [SchoolSubjectController::class, 'UpdateSchoolSubject'])->name('school.subject.update');

     Route::get('/school/subject/delete/{id}', [SchoolSubjectController::class, 'DeleteSchoolSubject'])->name('school.subject.delete');


    // Assign Grade routes
     Route::get('assign/grade/view', [AssignGradeController::class, 'ViewAssignGrade'])->name('assign.grade.view');

     Route::get('assign/grade/add/{grade}', [AssignGradeController::class, 'AddAssignGrade'])->name('assign.grade.add');
     Route::post('assign/grade/store', [AssignGradeController::class, 'StoreAssignGrade'])->name('assign.grade.store');

     Route::get('assign/grade/details/{id}', [AssignGradeController::class, 'DetailsAssignGrade'])->name('assign.grade.details');

     Route::get('assign/grade/subject/edit/{class}/{grade}', [AssignGradeController::class, 'EditAssignGradeSubject'])->name('assign.grade.subject.edit');

     Route::post('assign/grade/subject/update/{class}/{grade}', [AssignGradeController::class, 'UpdateAssignGradeSubject'])->name('assign.grade.subject.update');


    // designation routes
     Route::get('designation/view', [DesignationController::class, 'ViewDesignation'])->name('designation.view');

     Route::get('designation/add', [DesignationController::class, 'AddDesignation'])->name('designation.add');
     Route::post('designation/store', [DesignationController::class, 'StoreDesignation'])->name('designation.store');     

     Route::get('designation/edit/{id}', [DesignationController::class, 'EditDesignation'])->name('designation.edit');
     Route::post('designation/update/{id}', [DesignationController::class, 'UpdateDesignation'])->name('designation.update');

     Route::get('designation/delete/{id}', [DesignationController::class, 'DeleteDesignation'])->name('designation.delete');


     // student grade routes
    Route::get('/student/grade/view', [StudentGradeController::class, 'ViewGradeStudent'])->name('student.grade.view');
  
    Route::get('/student/grade/add', [StudentGradeController::class, 'AddGradeStudent'])->name('student.grade.add');
    Route::post('/student/grade/store', [StudentGradeController::class, 'StoreGradeStudent'])->name('store.student.grade');
                                            // routebelow is not done
    Route::get('/student/year/edit/{id}', [StudentYearController::class, 'EditYearStudent'])->name('student.year.edit');
    Route::post('/student/year/update/{id}', [StudentYearController::class, 'UpdateYearStudent'])->name('student.year.update');

    Route::get('/student/year/delete/{id}', [StudentYearController::class, 'DeleteYearStudent'])->name('student.year.delete');

}); //end of setup prefix







Route::prefix('students')->group(function(){

    //student registration route
    Route::get('registration/view', [StudentRegistrationController::class, 'StudentRegistrationView'])->name('student.registration.view');
   
    Route::get('registration/add', [StudentRegistrationController::class, 'StudentRegistrationAdd'])->name('student.registration.add');
    Route::post('registration/store', [StudentRegistrationController::class, 'StudentRegistrationStore'])->name('student.registration.store');

    Route::get('/year/class/search', [StudentRegistrationController::class, 'StudentYearClassSearch'])->name('student.year.class.search');

    Route::get('registration/edit/{student_id}', [StudentRegistrationController::class, 'StudentRegistrationEdit'])
        ->name('student.registration.edit');
    Route::post('registration/update/{student_id}', [StudentRegistrationController::class, 'StudentRegistrationUpdate'])
        ->name('student.registration.update');

    Route::get('registration/details/{student_id}', [StudentRegistrationController::class, 'StudentRegistrationDetails'])
        ->name('student.registration.details');

        
        //student Fee amount route

    Route::get('registration/fee/view', [StudentFeeAmountController::class, 'StudentFeeAmountView'])->name('student.registration_fee.view');


    Route::get('registration/fee/search', [StudentFeeAmountController::class, 'RegistrationFeeSearch'])->name('registration_fee.year.fee.class.search');
    Route::get('registration/fee/payslip', [StudentFeeAmountController::class, 'RegistrationFeePayslip'])->name('registration.fee.payslip');

    Route::get('Monthly/fee/search', [StudentFeeAmountController::class, 'MonthlyFeeSearch'])->name('monthly_fee.year.fee.class.search');
    Route::get('Monthly/fee/payslip', [StudentFeeAmountController::class, 'MonthlyFeePayslip'])->name('monthly.fee.payslip');

    Route::get('Exam/fee/search', [StudentFeeAmountController::class, 'ExamFeeSearch'])->name('exam_fee.year.fee.class.search');
    Route::get('Exam/fee/payslip', [StudentFeeAmountController::class, 'ExamFeePayslip'])->name('exam.fee.payslip');


    Route::get('payment/search', [StudentFeeAmountController::class, 'LiveSearchAction'])->name('live_search.action');
    Route::get('Exam/Month/payslip', [StudentFeeAmountController::class, 'LiveSearch_Month_Exam_Payslip'])
        ->name('live_search.month_exam.payslip');

}); // end of students prefix






    //employee fee route
Route::prefix('employee')->group(function(){

    Route::get('employee/view', [EmployeeRegistrationController::class, 'EmployeeView'])->name('employee.registration.view');

    Route::get('employee/add', [EmployeeRegistrationController::class, 'EmployeeAdd'])->name('employee.registration.add');
    Route::post('employee/store', [EmployeeRegistrationController::class, 'EmployeeStore'])->name('employee.registration.store');
 
    Route::get('employee/edit/{id}', [EmployeeRegistrationController::class, 'EmployeeEditData'])->name('employee.registration.edit');
    Route::post('employee/update/{id}', [EmployeeRegistrationController::class, 'EmployeeUpdateData'])->name('employee.registration.update');

    Route::get('employee/pdf/{id}', [EmployeeRegistrationController::class, 'EmployeeRegistrationPdf'])->name('employee.registration.pdf');


     //employee salary all routes
    Route::get('employee/salary/view', [EmployeeSalaryController::class, 'EmployeeSalaryView'])->name('employee.salary.view');

    Route::get('employee/salary/increment/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryIncrement'])->name('employee.salary.increment');
    Route::post('employee/salary/update/increment/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryUpdateIncrement'])
        ->name('employee.salary.update.increment');

    Route::get('employee/salary/cancel_increment/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryCancelIncrement'])
        ->name('employee.salary.cancel.increment');

    Route::get('employee/salary/details/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryDetails'])->name('employee.salary.details');


    //employee attendance
    Route::get('employee/attendance/view', [EmployeeAttendanceController::class, 'EmployeeAttendanceView'])->name('employee.attendance.view');    

    Route::get('employee/attendance/details/{date}', [EmployeeAttendanceController::class, 'EmployeeAttendanceDetails'])->name('employee.attendance.details');

    Route::get('employee/attendance/add', [EmployeeAttendanceController::class, 'EmployeeAttendanceAdd'])->name('employee.attendance.add');    
    Route::post('employee/attendance/store', [EmployeeAttendanceController::class, 'EmployeeAttendanceStore'])->name('employee.attendance.store');

    Route::get('employee/attendance/edit/{date}', [EmployeeAttendanceController::class, 'EmployeeAttendanceEdit'])
        ->name('employee.attendance.edit');
    Route::post('employee/attendance/update', [EmployeeAttendanceController::class, 'EmployeeAttendanceUpdate'])
        ->name('employee.attendance.update');

    Route::get('employee/attendance/delete/{date}', [EmployeeAttendanceController::class, 'EmployeeAttendanceDelete'])->name('employee.attendance.delete');


    //employee Monthly Salary
    Route::get('employee/monthly/salary/view', [EmployeeMonthlySalaryController::class, 'EmployeeMonthlySalaryView'])
        ->name('employee.monthly.salary.view');    

    Route::get('employee/monthly/salary/date/search', [EmployeeMonthlySalaryController::class, 'EmployeeMonthlySalaryMonthSearch'])
        ->name('employee.monthly.salary.date.search');    


   //employee generate payroll
    Route::get('employee/generate/payroll/view', [EmployeeGeneratePayrollController::class, 'EmployeeGeneratePayrollView'])
        ->name('employee.generate.payroll.view');    

    Route::get('employee/salary/date/from-to/search', [EmployeeGeneratePayrollController::class, 'EmployeeSalaryDateFromToSearch'])
        ->name('employee.salary.date.from.to.search');    

    Route::post('employee/generate/payroll/store', [EmployeeGeneratePayrollController::class, 'EmployeeAttendanceGenerateStore'])
        ->name('employee.attendance.generate.store'); 

}); // end of employee prefix






Route::prefix('class')->group(function(){

        //class assign
    Route::get('class/assign/view', [ClassAssignController::class, 'ClassAssignView'])->name('class.assign.view'); 

    Route::get('class/assign/student/available', [ClassAssignController::class, 'ClassAssignStudentAvailable'])
         ->name('class.assign.student.available'); 

    Route::get('class/assign/add/{id}', [ClassAssignController::class, 'ClassAssignAdd'])->name('class.assign.add');
    Route::post('class/assign/store', [ClassAssignController::class, 'ClassAssignStore'])->name('class.assign.store');   

    Route::get('class/assign/list/{id}', [ClassAssignController::class, 'ClassAssignList'])->name('class.assign.list');
    Route::get('class/assign/list/remove/{student}/{employee}', [ClassAssignController::class, 'ClassAssignListRemove'])
         ->name('class.assign.list.remove');


    //class student grade
    Route::get('class/student/grade/search', [ClassStudentGradeController::class, 'ClassStudentGradeSearch'])->name('class.student.grade.search'); 
    Route::get('class/student/grade/view', [ClassStudentGradeController::class, 'ClassStudentGradeView'])->name('class.student.grade.view'); 

    Route::post('class/student/1st_grading/store', [ClassStudentGradeController::class, 'ClassStudentGradingStore'])
        ->name('class.student.grading.store');


}); // end of class prefix






Route::prefix('accounts')->group(function(){

   Route::get('account/student/fee/view', [AccountStudentFeeController::class, 'AccountStudentFeeView'])->name('account.student.fee.view'); 
   Route::get('account/student/fee/add', [AccountStudentFeeController::class, 'AccountStudentFeeAdd'])->name('account.student.fee.add');


}); // end of accounts prefix