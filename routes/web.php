<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function (Request $request) {
    $headers_key = ['Host', 'connection', 'sec-ch-ua', 'sec-ch-ua-mobile', 'sec-ch-ua-platform', 'dnt', 'user-agent'];
    foreach ($headers_key as $key) {
        echo '<pre>';
        $value = $request->header($key);
        echo $key . ' : ' . $value;
        echo '</pre>';
    }
    $clientIpAddress = $request->ip();
    // If you are using a proxy server or load balancer
    // $clientIpAddress = $request->getClientIp();
    print_r($clientIpAddress);
});

Route::get('view_count/{name}/{id?}', function ($name, $id = null) {
    echo $name;
    die;
    $data = compact('name', 'id');
    print_r($data);
    // return view('demowithdata')->with($data);
});
