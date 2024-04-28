<?php

namespace App\Http\Controllers;

use App\Models\PageViewCountLinkCreation;
use App\Models\PageViewCountLog;
use App\Traits\BadgeTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

// Controler #103
class PageViewCountLogController extends Controller
{
    use BadgeTrait;

    public function log(Request $request, $number, $optional = null)
    {
        $count = DB::table('page_view_count_link_creations')->where('tracking_no', $number)->where('soft_del', 0)->selectRaw('count(*) as tracker_exist')->pluck('tracker_exist');
        if ($count[0] == 1) {
            // $headers_key = ['Host', 'connection', 'sec-ch-ua', 'sec-ch-ua-mobile', 'sec-ch-ua-platform', 'dnt', 'user-agent'];
            // $clientIpAddress = $request->ip();

            // $Host = $request->header('Host');
            $referer = $request->header('Referer');

            if ($optional == 'mailer') {
                $referer = 'Mail Track - '.$request->header('Referer');
            }

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

            $db_type = Config::get('database.default');
            if ($db_type == 'pgsql') {
                $max_id = DB::select('select id from page_view_count_logs ORDER BY id DESC LIMIT 1');
                // $max_id= DB::select('select max(id) from page_view_count_logs ');
                $track_log->id = $max_id[0]->id + 1;
            }

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

            $svg = $this->generateBadge($updatedCount);
            // echo $svg;
        } else {
            $svg = $this->notExistBadge($number);
            // echo $svg;

        }
        if ($optional == 'mailer') {

            $filename = 'pixel.png';
            $path = public_path('content/'.$filename);

            if (! file_exists($path)) {
                abort(404);
            }

            $file = file_get_contents($path);
            $type = mime_content_type($path);

            return response($file)->header('Content-Type', $type);
        }
        //not sure wheather to store th images or not will check later

        else {
            $file_name = $number.'.svg';
            Storage::disk('public')->put($file_name, $svg);
            // return $svg;
            $pathToFile = 'storage/'.$file_name;
            try {
                return response()->file($pathToFile);
            } catch (Exception $e) {
                Artisan::call('storage:link');
                Log::emergency('There was an Stoarge:Link error which was handle by a exception handling in Controller #103');
            } finally {
                // $type = mime_content_type($pathToFile);
                // $file = file_get_contents($pathToFile);
                // return response($file)->header('Content-Type', $type);
                return response()->file($pathToFile);
            }
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
}
