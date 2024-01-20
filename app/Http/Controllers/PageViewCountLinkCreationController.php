<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PageViewCountLinkCreation;

use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class PageViewCountLinkCreationController extends Controller
{
    public function index()
    {
        return view('homepage');
    }

    public function view()
    {
        $user_obj = Auth::user();
        $current_user_id = Auth::id();
        // $trackers = DB::table('page_view_count_link_creations')->where('user_id', $current_user_id);
        $trackers = DB::select('select * from page_view_count_link_creations where user_id=? and soft_del=?', [$current_user_id, 0]);
        // $trackers = $trackers->get();
        return view('trackers', ['trackers' => $trackers]);
    }

    public function store(Request $request)
    {
        global $t, $date, $validation_host_type, $validation_friendly_name, $validation_remark, $generate_security_code, $current_user_id, $user_details, $generate_tracker_id;

        $auth_status = auth()->check();
        if ($auth_status == 1) {
            $user_obj = Auth::user();
            $user_details = array("name" => $user_obj->name, "email" => $user_obj->email);
            $current_user_id = Auth::id();
        } else {
            $current_user_id = 1;
            $user_details = array("name" => "Annonymous", "email" => "Annonymous@who-m-i.com");
        }

        function create_tracker(Request $request)
        {
            global $t, $date, $validation_host_type, $validation_friendly_name, $validation_remark, $generate_security_code, $current_user_id, $generate_tracker_id;
            $t = time();
            $date = date('Ymd');
            $generate_tracker_id = $date . $t;
            $validation_host_type = $request['host_type'] ?? "html";
            $validation_remark = $request['remark'] ?? "This is a system generated remark";
            $validation_friendly_name = $request['friendly_name'] ?? 'Serendipity-Euphoria-Pluviophile-Idyllic-Aurora';
            $generate_security_code = md5($t);
            $new_tracker = new PageViewCountLinkCreation;
            $new_tracker->tracking_no = $generate_tracker_id;
            $new_tracker->friendly_name = $validation_friendly_name;
            $new_tracker->user_id = $current_user_id;
            $new_tracker->host = $validation_host_type;
            $new_tracker->view_count = 0;
            $new_tracker->remark = $validation_remark;
            $new_tracker->security_code = $generate_security_code;
            $new_tracker->save();
        }

        try {
            create_tracker($request);
        } catch (\Throwable $e) {
            // dd($e->getMessage());
            $users = DB::table('users')->get();
            if (count($users) < 1) {
                DB::table('users')->insert([
                    'id' => 1, 'name' => 'Test', 'email' => 'test@example.com', 'password' => '$2y$12$nTEasgNYfH9i7kjBdAPjU.O0HQ7xlwgccwiEoU5CF23NhaPpntqlu'
                ]);
            };
            create_tracker($request);
        } finally {
            $data1 = array('tracker_no' => $generate_tracker_id, 'host_type' => $validation_host_type, "seurity_key" => $generate_security_code, 'friendly_name' => $validation_friendly_name, 'remark' => $validation_remark, 'creator' => $user_details['name'], 'creator_mail' => $user_details['email']);
            $data = compact('data1');
            return view('sucessfullTrackerCreation')->with($data);
        }
    }

    public function destroy($id)
    {
        //    echo $id;
        // $tracker = PageViewCountLinkCreation::where('tracking_no', $id)->delete();
        $current_user_id = Auth::id();
        $affected = DB::update(
            'update page_view_count_link_creations set soft_del = 1 where tracking_no = ? and user_id=?',
            [$id, $current_user_id]
        );
        return redirect('/dashboard');
    }

    // public function edit($id)
    // {
    //     $tracker = PageViewCountLinkCreation::find($id);
    //     $data = compact('customer');
    //     return view('update_customer')->with($data);
    // }

    // public function update($id, Request $request)
    // {
    //     $tracker = PageViewCountLinkCreation::find($id);
    //     $tracker->customer_name = $request['customer_name'];
    //     $tracker->save();
    //     return redirect('/');
    // }
}
