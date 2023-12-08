<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageViewCountLinkCreation;

use Illuminate\Support\Facades\DB;

class PageViewCountLinkCreationController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();
        if (count($users) < 1) {
            DB::table('users')->insert([
                'id' => 1, 'name' => 'Test', 'email' => 'test@example.com', 'password' => 'password'
            ]);
        };
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
        $new_tracker = new PageViewCountLinkCreation;
        $new_tracker->tracking_no = $request['u_name'];
        $new_tracker->user_id = 1;
        $new_tracker->host = 'https://databytedigital.com';
        $new_tracker->view_count = 0;
        $new_tracker->remark = 'Work in progress';
        $new_tracker->save();
        return redirect('/');
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
