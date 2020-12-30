<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('terminals')->name('terminals/')->group(static function() {
            Route::get('/',                                             'TerminalsController@index')->name('index');
            Route::get('/create',                                       'TerminalsController@create')->name('create');
            Route::post('/',                                            'TerminalsController@store')->name('store');
            Route::get('/{terminal}/edit',                              'TerminalsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'TerminalsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{terminal}',                                  'TerminalsController@update')->name('update');
            Route::delete('/{terminal}',                                'TerminalsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('conductors')->name('conductors/')->group(static function() {
            Route::get('/',                                             'ConductorsController@index')->name('index');
            Route::get('/create',                                       'ConductorsController@create')->name('create');
            Route::post('/',                                            'ConductorsController@store')->name('store');
            Route::get('/{conductor}/edit',                             'ConductorsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ConductorsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{conductor}',                                 'ConductorsController@update')->name('update');
            Route::delete('/{conductor}',                               'ConductorsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('transportation-logs')->name('transportation-logs/')->group(static function() {
            Route::get('/',                                             'TransportationLogsController@index')->name('index');
            Route::get('/create',                                       'TransportationLogsController@create')->name('create');
            Route::post('/',                                            'TransportationLogsController@store')->name('store');
            Route::get('/{transportationLog}/edit',                     'TransportationLogsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'TransportationLogsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{transportationLog}',                         'TransportationLogsController@update')->name('update');
            Route::delete('/{transportationLog}',                       'TransportationLogsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('residents')->name('residents/')->group(static function() {
            Route::get('/',                                             'ResidentsController@index')->name('index');
            Route::get('/create',                                       'ResidentsController@create')->name('create');
            Route::post('/',                                            'ResidentsController@store')->name('store');
            Route::get('/{resident}/edit',                              'ResidentsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ResidentsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{resident}',                                  'ResidentsController@update')->name('update');
            Route::delete('/{resident}',                                'ResidentsController@destroy')->name('destroy');
            Route::get('/{resident}/qrcode',                            'ResidentsController@qrCode')->name('qrcode');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('drivers')->name('drivers/')->group(static function() {
            Route::get('/',                                             'DriversController@index')->name('index');
            Route::get('/create',                                       'DriversController@create')->name('create');
            Route::post('/',                                            'DriversController@store')->name('store');
            Route::get('/{driver}/edit',                                'DriversController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'DriversController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{driver}',                                    'DriversController@update')->name('update');
            Route::delete('/{driver}',                                  'DriversController@destroy')->name('destroy');
        });
    });
});