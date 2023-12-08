@extends('layouts.main')
@push('title')
    <title>About US</title>
@endpush
@section('main-section')
<div class="container">
    <a href="{{route('tracker.create')}}">  <button class="btn btn-primary btn-lg float-right"
      type="submit"> Add
</button></a>
      <table class="table">
          <thead>
              <tr>
                  <th>customer_id</th>
                  <th>customer_name</th>
                  <th>customer_email</th>
                  <th>customer_email</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($trackers as $customer)
              <tr>
                  <th scope="row">{{$customer->tracking_no}}</td>
                  <td>{{$customer->host}}</td>
                  <td>{{$customer->view_count}}</td>
                  <td>{{$customer->updated_at}}</td>
                  {{-- <td>{{$customer->customer_dob}}</td> --}}
                  {{-- optional format using user define function in helper.php file  --}}
              <td>
                  {{-- <a href="{{url('customer/delete')}}/{{$customer->customer_id}}"> </a> --}}
                      <a href="{{route('tracker.delete',['id' =>$customer->tracking_no])}}">
                      <button class="btn btn-danger">Delete</button>
                  </a>
                  <a href="{{route('tracker.edit',['id' =>$customer->tracking_no])}}">
                      <button class="btn btn-primary">Update</button>
                  </a>
                 
              </td>
              </tr>
              @endforeach
          </tbody>
      </table>
  </div>
  @endsection