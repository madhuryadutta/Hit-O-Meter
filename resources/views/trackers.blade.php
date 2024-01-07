@extends('layouts.main')
@push('title')
    <title>Tracker List</title>
@endpush
@section('main-section')

<div class="container">
    <a href="{{route('tracker.create')}}">  <button class="btn btn-primary btn-lg float-right"
      type="submit"> Add
</button></a>
  <table class="table table-hover">
          <thead>
              <tr class="table-success">
                  <th>Tracker ID</th>
                  <th>Host Type</th>
                  <th>Friendly Name</th>
                  <th>Total Visitors</th>
                  <th>Remark</th>
                  <th>Created On</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($trackers as $tracker)
              <tr class="table-dark">
                  <th scope="row">{{$tracker->tracking_no}}</td>
                  <td>{{$tracker->host}}</td>
                  <td>{{$tracker->friendly_name}}</td>
                  <td>{{$tracker->view_count}}</td>
                  <td>{{$tracker->remark}}</td>
                  <td>{{$tracker->updated_at}}</td>
                  {{-- <td>{{$tracker->customer_dob}}</td> --}}
                  {{-- optional format using user define function in helper.php file  --}}
              <td>
                  {{-- <a href="{{url('customer/delete')}}/{{$tracker->customer_id}}"> </a> --}}
                      {{-- <a href="{{route('tracker.delete',['id' =>$tracker->tracking_no])}}">
                      <button class="btn btn-danger">Delete</button>
                  </a> --}}
                  {{-- <a href="{{route('tracker.edit',['id' =>$tracker->tracking_no])}}">
                      <button class="btn btn-primary">Update</button>
                  </a> --}}
                  <a href="{{route('tracker.logs',['number' =>$tracker->tracking_no])}}">
                      <button class="btn btn-primary">Logs</button>
                  </a>
                  <a href="/track/{{$tracker->tracking_no}}" target="_blank"><button type="button" class="btn btn-outline-info">Tracker Link</button> </a>
                 
              </td>
              </tr>
              @endforeach
          </tbody>
      </table>
  </div>

  @endsection