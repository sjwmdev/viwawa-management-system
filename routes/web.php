<?php

use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::group(['namespace' => 'App\Http\Controllers\Frontend', 'as' => 'frontend.'], function () {

    // Michango ya Ujenzi wa Kanisa (Church Contributions)
    Route::get('michango-ya-ujenzi-kanisa', 'ChurchContributionController@index')->name('church.contributions.index');

    // Michango ya Kila Mwezi ya Viwawa (Viwawa Monthly Contributions)
    Route::get('michango-ya-kila-mwezi', 'Viwawa\MonthlyContributionController@index')->name('viwawa.contributions.monthly.index');
});

// Global Guest Routes
Route::namespace('App\Http\Controllers\Backend\Auth')
    ->middleware('guest')
    ->group(function () {
        // Login Routes
        Route::get('/', 'LoginController@showLoginForm')->name('login.showLoginForm');
        Route::post('/login', 'LoginController@login')->name('login.authenticate');

        // Register Routes
        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register')->name('register.store');
    });

// Common Shared Routes
Route::group(['namespace' => 'App\Http\Controllers\Backend\Common', 'middleware' => ['auth', 'enforce.password.change'], 'as' => 'common.'], function () {
    // Logout route
    Route::get('/logout', 'LogoutController@perform')->name('logout');

    // Dashboard and Profile routes
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('profile', 'ProfileController@edit')->name('profile.edit');
    Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
    Route::patch('profile', 'ProfileController@changePassword')->name('profile.change-password');

    // Notifications routes
    Route::get('/notifications', 'NotificationController@index')->name('notifications.index');
    Route::prefix('notifications')
        ->name('notifications.')
        ->group(function () {
            Route::get('/get-unread', 'NotificationController@getUnreadNotifications')->name('get-unread');
            Route::post('/mark-as-read/{notification}', 'NotificationController@markAsRead')->name('mark-as-read');
            Route::post('/remove-notification/{notification}', 'NotificationController@removeNotification')->name('remove');
            Route::post('/clear-all', 'NotificationController@clearAll')->name('clearAll');
        });

    // System logs routes
    Route::get('/logs', 'LogController@index')->name('logs.index');
    Route::delete('/logs/destroy-all', 'LogController@destroyAll')->name('logs.destroy.all');
});

// Super Admin Routes
Route::group(['namespace' => 'App\Http\Controllers\Backend\SuperAdmin', 'prefix' => 'super', 'as' => 'superadmin.', 'middleware' => ['auth', 'role:superadmin']], function () {
    // Resourceful routes for roles, permissions, users
    Route::resources([
        'roles' => 'RoleController',
        'permissions' => 'PermissionController',
        'users' => 'UserController',
    ]);

    // System logs
    Route::get('/system/logs', 'LogViewerController@index')->name('system.logs.index');
    Route::post('/system/logs/filter', 'LogViewerController@filter')->name('system.logs.filter');
    Route::get('/delete', 'LogViewerController@deleteLogs')->name('system.logs.delete');
});

// Admin Routes
Route::group(['namespace' => 'App\Http\Controllers\Backend\Admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin', 'enforce.password.change']], function () {
    // Members Management routes
    Route::resource('members', 'MemberController');

    // Incomes routes
    Route::get('incomes/saturday', 'IncomeController@saturday')->name('incomes.saturday');
    Route::get('incomes/saturday/details/{year}/{month}', 'IncomeController@saturdayDetails')->name('incomes.saturday.details');
    Route::get('incomes/other', 'IncomeController@other')->name('incomes.other');
    Route::post('incomes/store', 'IncomeController@store')->name('incomes.store');
    Route::patch('incomes/update/{income}', 'IncomeController@update')->name('incomes.update');
    Route::resource('incomes/types', 'IncomeTypeController')->names('incomes.type')->only('index', 'store', 'update');

    // Expenditures routes
    Route::resource('expenditures', 'ExpenditureController')->only(['index', 'store']);

    // Mfuko Balance routes
    Route::get('mfuko-balance', 'MfukoBalanceController@index')->name('mfuko-balance.index');
    Route::post('mfuko-balance/calculate', 'MfukoBalanceController@calculateBalance')->name('mfuko-balance.calculate');

    // Attendance routes
    Route::resource('attendance', 'AttendanceController')->only('index', 'create', 'store', 'update');

    // Members Contributions routes
    Route::group(['namespace' => 'Contributions'], function () {
        // Store route for all contributions
        Route::resource('contributions', 'ContributionController')->only('store', 'update');

        Route::resource('contributions/types', 'ContributionTypeController')->names('contributions.type')->only('index', 'store', 'update');

        // Members Monthly Contributions routes
        Route::group(['prefix' => 'monthly', 'as' => 'monthly.'], function () {
            Route::resource('contributions', 'MonthlyContributionController')->names('contributions')->only('index', 'create', 'edit');

            Route::get('contributions/details', 'MonthlyContributionController@details')->name('contributions.details');
        });
        Route::get('monthlz/contributions/report', 'MonthlyContributionController@report')->name('monthlz.contributions.report');

        // Wanajumuiya Ujenzi Contributions routes
        Route::group(['prefix' => 'ujenzi', 'as' => 'church.'], function () {
            Route::resource('kanisa', 'ChurchContributionController')->names('contributions');
        });
    });

});
