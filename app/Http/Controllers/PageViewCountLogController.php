<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageViewCountLinkCreation;
use App\Models\PageViewCountLog;


class PageViewCountLogController extends Controller
{
    public function log(Request $request, $number, $optional = null)
    {
        // $headers_key = ['Host', 'connection', 'sec-ch-ua', 'sec-ch-ua-mobile', 'sec-ch-ua-platform', 'dnt', 'user-agent'];
        // $clientIpAddress = $request->ip();

        $Host = $request->header('Host');
        $connection = $request->header('connection');
        $sec_ch_ua = $request->header('sec-ch-ua');
        $platform = $request->header('sec-ch-ua-platform');
        $user_agent = $request->header('user-agent');
        // // use for a proxy server or load balancer
        $clientIpAddress = $request->getClientIp();

        $track_log = new PageViewCountLog;
        // $new_tracker->tracking_no = $request['u_name'];
        $track_log->fk_tracking_no = $number;
        $track_log->ip_address = $clientIpAddress;
        $track_log->geolocation = 'N/A';
        $track_log->user_agent = $user_agent;
        $track_log->host = $Host;
        $track_log->save();


        $tracker = PageViewCountLinkCreation::find($number);
        $old_count = $tracker->view_count;
        $tracker->view_count = $old_count + 1;
        $tracker->save();
        echo  $tracker->view_count;

        // return view('demowithdata')->with($data);
    }
}
