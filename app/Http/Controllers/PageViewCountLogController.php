<?php

namespace App\Http\Controllers;

use App\Models\PageViewCountLinkCreation;
use App\Models\PageViewCountLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

// Controler #103
class PageViewCountLogController extends Controller
{
    public function log(Request $request, $number, $optional = null)
    {
        $count = DB::table('page_view_count_link_creations')->where('tracking_no', $number)->where('soft_del', 0)->selectRaw('count(*) as tracker_exist')->pluck('tracker_exist');
        if ($count[0] == 1) {
            // $headers_key = ['Host', 'connection', 'sec-ch-ua', 'sec-ch-ua-mobile', 'sec-ch-ua-platform', 'dnt', 'user-agent'];
            // $clientIpAddress = $request->ip();

            // $Host = $request->header('Host');
            $referer = $request->header('Referer');
            $connection = $request->header('connection');
            $sec_ch_ua = $request->header('sec-ch-ua');
            $platform = $request->header('sec-ch-ua-platform');
            $user_agent = $request->header('user-agent');

            // // use for a proxy server or load balancer. Doesn't work with docker and nginx reverse proxy setup (returns internal ip)
            // $clientIpAddress = $request->getClientIp();

            $clientIpAddress = $request->header('X-Forwarded-For');
            // $clientIpAddress = $_SERVER['X-Forwarded-For'];

            $track_log = new PageViewCountLog;
            // $new_tracker->tracking_no = $request['u_name'];
            $track_log->fk_tracking_no = $number;
            $track_log->ip_address = $clientIpAddress ?? $request->getClientIp();
            // $track_log->geolocation = 'N/A';
            $track_log->geolocation = $request->header('Cf-Ipcountry') ?? 'N/A';
            //$track_log->geolocation = $_SERVER['Cf-Ipcountry'] ?? 'N/A';
            $track_log->user_agent = $user_agent;
            // $track_log->host = $Host;
            $track_log->referer = $referer;
            $track_log->save();

            $tracker = PageViewCountLinkCreation::find($number);
            $old_count = $tracker->view_count;
            $tracker->view_count = $old_count + 1;
            $tracker->save();
            // echo  $tracker->view_count;
            $updatedCount = $tracker->view_count;
            // echo $updatedCount;
            $data = compact('updatedCount');

            // $pathToFile = 'favicon.ico';
            // return response()->file($pathToFile);

            $svg = '<svg xmlns="http://www.w3.org/2000/svg">
        <g>
          <rect x="0" y="0" width="300" height="100" fill="green"></rect>
          <text x="10" y="50" font-family="Verdana" font-size="35" fill="blue">Profile View:' . $updatedCount . '</text>
        </g>
      </svg>';
        } else {
            $svg = '<svg xmlns="http://www.w3.org/2000/svg">
        <g>
          <rect x="0" y="0" width="650" height="100" fill="red"></rect>
          <text x="10" y="50" font-family="Verdana" font-size="35" fill="blue">Invalid ID:' . $number . '</text>
        </g>
      </svg>';
        }
        $file_name = $number . '.svg';
        Storage::disk('public')->put($file_name, $svg);
        // return $svg;
        $pathToFile = 'storage/' . $file_name;
        try {
            return response()->file($pathToFile);
        } catch (Exception $e) {
            Artisan::call("storage:link");
            Log::emergency('There was an Stoarge:Link error which was handle by a exception handling in Controller #103');
        } finally {
            return response()->file($pathToFile);
        }


        // redirect($pathToFile);

        // return view('counter')->with($data);
    }

    public function logView($number, $optional = null)
    {
        $trackers_log = DB::table('page_view_count_logs')
            ->where('fk_tracking_no', '=', $number)
            ->where('soft_del', '=', 0)
            ->orderBy('id', 'DESC')
            ->get();
        // echo "<pre>";
        // print_r($log_view_data);
        $tracker_info = DB::table('page_view_count_link_creations')
            ->where('tracking_no', '=', $number)
            ->where('soft_del', '=', 0)
            ->get();
        // echo "<pre>";
        // print_r($tracker_info);

        $data = compact('trackers_log', 'tracker_info');

        return view('trackers_log')->with($data);
    }

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
}
