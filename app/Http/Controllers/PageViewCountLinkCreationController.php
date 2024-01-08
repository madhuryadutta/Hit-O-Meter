<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageViewCountLinkCreation;

use Illuminate\Support\Facades\DB;

class PageViewCountLinkCreationController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function view()
    {
        $trackers = PageViewCountLinkCreation::all();
        $data = compact('trackers');
        return view('trackers')->with($data);
    }

    public function store(Request $request)
    {
        global $t, $date;
        function create_tracker()
        {
            global $t, $date;
            $t = time();
            $date = date('Ymd');
            $validation_host_type = $request['host_type'] ?? "html";
            $validation_remark = $request['remark'] ?? "This is a system generated remark";
            $validation_friendly_name = $request['friendly_name'] ?? 'Serendipity-Euphoria-Pluviophile-Idyllic-Aurora';
            $generate_security_code = md5($t);
            $new_tracker = new PageViewCountLinkCreation;
            $new_tracker->tracking_no = $date . $t;
            $new_tracker->friendly_name = $validation_friendly_name;
            $new_tracker->user_id = 1;
            $new_tracker->host = $validation_host_type;
            $new_tracker->view_count = 0;
            $new_tracker->remark = $validation_remark;
            $new_tracker->security_code = $generate_security_code;
            $new_tracker->save();
        }

        try {
            create_tracker();
        } catch (\Throwable $e) {
            // dd($e->getMessage());
            $users = DB::table('users')->get();
            if (count($users) < 1) {
                DB::table('users')->insert([
                    'id' => 1, 'name' => 'Test', 'email' => 'test@example.com', 'password' => '$2y$12$nTEasgNYfH9i7kjBdAPjU.O0HQ7xlwgccwiEoU5CF23NhaPpntqlu'
                ]);
            };
            create_tracker();
        } finally {
            return redirect('/');
        }
    }

    // public function destroy($id)
    // {
    //     //    echo $id;
    //     $tracker = Customer::where('customer_id', $id)->delete();
    //     return redirect('customer/view');
    // }

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
