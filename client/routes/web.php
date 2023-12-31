<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prepare-to-login', function () {
    $state = Str::random(40);

    session([
        'state' => $state
    ]);

    $query = http_build_query([
        'client_id' => env('CLIENT_ID'),
        'redirect_url' => env('REDIRECT_URL'),
        'response_type' => 'code',
        'scope' => '',
        'state' => $state
    ]);

    return redirect(env('API_URL').'oauth/authorize?'.$query);

})->name('prepare.login');

Route::get('/callback', function (Request $request) {
     $response = Http::post(env('API_URL').'oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => env('CLIENT_ID'),
        'client_secret' => env('CLIENT_SECRET'),
        'redirect_url' => env('REDIRECT_URL'),
        'code' => $request->code
    ]);

    dd($response->json());
});

Route::get('/grant-password', function () {
    $response = Http::post(env('API_URL').'oauth/token', [
       'grant_type' => 'password',
       'client_id' => 4,
       'client_secret' => 'Hqs8unRvBBgIQvB9BKeOzw4UkIZY2fhRS2MY0FgV',
       'username' => 'luis.linczuk@rinobox.com.br',
       'password' => '12345678',
       'scope' => ''
   ]);

   dd($response->json());
});

Route::get('/grant-client', function () {
    $response = Http::post(env('API_URL').'oauth/token', [
       'grant_type' => 'client_credentials',
       'client_id' => 5,
       'client_secret' => 'SJ39Gv7MWC4oJwnLa3x6SeQMSZxmSzfzoTlmj4Zm',
       'scope' => ''
   ]);

   dd($response->json());
});
