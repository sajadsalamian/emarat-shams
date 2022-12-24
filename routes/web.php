<?php

use App\Http\Controllers\FinancialController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\PayslipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use \App\Http\Controllers\AuthController;

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'Login'])->name('auth.login');

Route::middleware('auth')->group(function () {

    Route::get('/', [Controller::class, 'Index'])->name('main');
    Route::post('/', [AuthController::class, 'Logout'])->name('auth.logout');
    // notification
    Route::prefix('/notification')->group(function () {
        Route::get('/', [NotificationController::class, 'GetAllNotification'])->name('Notification.all');
        Route::get('/add', [NotificationController::class, 'AddNotification'])->name('Notification.add');
        Route::post('/add', [NotificationController::class, 'StoreNotification'])->name('Notification.store');
        Route::get('/delete/{id}', [NotificationController::class, 'DeleteNotification'])->name('Notification.delete');
    });
    // financial
    Route::prefix('/financial')->group(function () {
        Route::get('/', [FinancialController::class, 'FinancialRoot'])->name('Financial.root');
        Route::get('/add', [FinancialController::class, 'AddFinancial'])->name('Financial.add');
        Route::post('/add', [FinancialController::class, 'StoreFinancial'])->name('Financial.store');
        Route::get('/delete/{id}', [FinancialController::class, 'DeleteFinancial'])->name('Financial.delete');
        // payslip
        Route::prefix('/payslip')->group(function () {
            Route::get('/', [PayslipController::class, 'GetAllPayslipByUser'])->name('Payslip.all');
            Route::get('/view/{id}', [PayslipController::class, 'GetPayslipByUser'])->name('Payslip.view');
            Route::get('/add', [PayslipController::class, 'AddPayslip'])->name('Payslip.add');
            Route::post('/add', [PayslipController::class, 'StorePayslip'])->name('Payslip.store');
            Route::get('/delete/{id}', [PayslipController::class, 'DeletePayslip'])->name('Payslip.delete');
            Route::post('/view/{id}', [PayslipController::class, 'StorePayslipDetailsDoc'])->name('PayslipDetails.doc');
            Route::get('/import', [PayslipController::class, 'ImportExcelPayslip'])->name("Payslip.import");
            Route::post('/import/file', [PayslipController::class, 'ShowExcelPayslip'])->name('Payslip.import.show');
            Route::post('/import/file/save', [PayslipController::class, 'SaveExcelPayslip'])->name('Payslip.import.save');
            Route::get('/single/add', [PayslipController::class, 'AddSinglePayslip'])->name('Payslip.single.add');
            Route::post('/single/add', [PayslipController::class, 'SaveSinglePayslip'])->name('Payslip.single.store');
        });
        // loan
        Route::prefix('/loan')->group(function () {
            Route::get('/', [FinancialController::class, 'LoanRoot'])->name('Loan.all');
            Route::get('/view/{id}', [FinancialController::class, 'GetLoanById'])->name('Loan.view');
            Route::post('/view/{id}', [FinancialController::class, 'SetLoanConfirm'])->name('Loan.confirm');
            Route::post('/view/save-doc/{id}', [FinancialController::class, 'SaveLoanDoc'])->name('Loan.saveDoc');
            //Route::get('/add', [FinancialController::class, 'SetLoanConfirm'])->name('Loan.add');
            // Route::post('/add', [FinancialController::class, 'StoreLoan'])->name('Loan.store');
            // Route::get('/delete/{id}', [FinancialController::class, 'DeleteLoan'])->name('Loan.delete');
            // Route::post('/view/{id}', [FinancialController::class, 'StoreLoanDetailsDoc'])->name('LoanDetails.doc');
        });
    });
    // timesheet
    Route::prefix('/timesheet')->group(function () {
        Route::get('/', [TimesheetController::class, 'GetAllTimesheet'])->name('Timesheet.all');
        Route::get('/add', [TimesheetController::class, 'AddTimesheet'])->name('Timesheet.add');
        Route::post('/add', [TimesheetController::class, 'StoreTimesheet'])->name('Timesheet.store');
        Route::get('/delete/{id}', [TimesheetController::class, 'DeleteTimesheet'])->name('Timesheet.delete');
    });
    // users
    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'GetAllUser'])->name('User.all');
        Route::get('/add', [UserController::class, 'AddUser'])->name('User.add');
        Route::post('/add', [UserController::class, 'StoreUser'])->name('User.store');
        Route::get('/edit/{id}', [UserController::class, 'EditUser'])->name('User.edit');
        Route::post('/edit/{id}', [UserController::class, 'UpdateUser'])->name('User.update');
        Route::delete('/delete/{id}', [UserController::class, 'DeleteUser'])->name('User.delete');
    });
    // project
    Route::prefix('/project')->group(function () {
        Route::get('/', [ProjectController::class, 'GetAllProject'])->name('Project.all');
        Route::get('/{id}/view', [ProjectController::class, 'GetProjectById'])->name('Project.id');
        Route::delete('/{id}/delete', [ProjectController::class, 'DeleteProject'])->name('Project.delete');
        Route::get('/{id}/license', [ProjectController::class, 'GetProjectLicense'])->name('Project.license');
        Route::get('/{id}/license/add', [ProjectController::class, 'AddProjectLicense'])->name('Project.license.add');
        Route::post('/{id}/license/add', [ProjectController::class, 'StoreProjectLicense'])->name('Project.license.store');
        Route::get('/add', [ProjectController::class, 'AddProject'])->name('Project.add');
        Route::post('/add', [ProjectController::class, 'StoreProject'])->name('Project.store');
        Route::get('/{p_id}/{id}/view', [ProjectController::class, 'GetProjectReportsById'])->name('ProjectReports.id');
        Route::get('/{p_id}/add/', [ProjectController::class, 'AddProjectReport'])->name('ProjectReports.add');
        Route::post('/{p_id}/add/', [ProjectController::class, 'StoreProjectReport'])->name('ProjectReports.store');
    });
});

