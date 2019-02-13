<?php

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

use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('email-test', function(){

    $details['email'] = 'pronet.azad@gmail.com';

    $emailJob = (new App\Jobs\SendEmailJob($details))->delay(\Carbon\Carbon::now()->addSeconds(1));

    dispatch($emailJob)->onQueue('pross');

    dd('done');

    Artisan::call('queue:work', [
        '--queue' => 'pross'
    ]);
});
