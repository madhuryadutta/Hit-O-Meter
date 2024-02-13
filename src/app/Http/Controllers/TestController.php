<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

// Controler #000 . It will be removed in future

class TestController extends Controller
{
    public function logtest(Request $request)
    {
        $uri = $request->path();
        $urlWithQueryString = $request->fullUrl();
        $host = $request->host();
        $httpHost = $request->httpHost();
        $schemeAndHttpHost = $request->schemeAndHttpHost();
        $method = $request->method();
        $value = $request->header('X-Header-Name');
        $value = $request->header('X-Header-Name', 'default');
        $ipAddress = $request->ip();
        $ipAddresses = $request->ips();
        // $value = $request->cookie('name');
        echo 'uri is = ' . $uri;
        echo '<br>';
        echo 'urlWithQueryString is = ' . $urlWithQueryString;
        echo '<br>';
        echo 'Host is = ' . $host;
        echo '<br>';
        echo 'HTTPHost is = ' . $httpHost;
        echo '<br>';
        echo 'schemeAndHttpHost is = ' . $schemeAndHttpHost;
        echo '<br>';
        echo 'Method is = ' . $method;
        echo '<br>';
        echo 'Value is = ' . $value;
        echo '<br>';
        echo 'Single Ip address is = ' . $ipAddress;
        echo '<br>';
        echo 'Array of IP adrees are =';
        var_dump($ipAddresses);
    }

    public function logtest2(Request $request)
    {

        $input = $request->all();
        echo '<pre>';
        var_dump($input);
        echo '</pre>';
    }

    public function logtest3(Request $request)
    {

        $headers = [];

        foreach ($_SERVER as $name => $value) {

            if (substr($name, 0, 5) == 'HTTP_') {

                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        echo '<pre>';
        var_dump($headers);
        echo '</pre>';
    }

    public function logtest4(Request $request)
    {

        // if user from the share internet
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            echo 'IP address = ' . $_SERVER['HTTP_CLIENT_IP'];
        }
        //if user is from the proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            echo 'IP address = ' . $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //if user is from the remote address
        else {
            echo 'IP address = ' . $_SERVER['REMOTE_ADDR'];
        }
    }

    public function clear_cache()
    {
        if (App::environment('local')) {
            $exitCode = Artisan::call('cache:clear');
            $exitCode = Artisan::call('view:clear');

            $exitCode = Artisan::call('route:clear');

            return '<h1>Cache Cache cleared</h1>';
        } else {
            return view('homepage');
        }
    }

    public function cache_all()
    {
        $exitCode = Artisan::call('optimize');
        $exitCode = Artisan::call('route:cache');
        $exitCode = Artisan::call('config:cache');
        $exitCode = Artisan::call('view:cache');
        $exitCode = Artisan::call('event:cache');

        // echo '<h1>Application Cached Sucessfully </h1>';
        return view('homepage');
    }
}
