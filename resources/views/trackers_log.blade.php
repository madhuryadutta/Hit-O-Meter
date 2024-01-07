@extends('layouts.main')
@push('title')
    <title>Tracker Log</title>
@endpush
@section('main-section')


<div class="card mb-3">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tracker Info & Log</h4>
      <h6 class="card-subtitle mb-2 text-muted">Total Views: {{$tracker_info[0]->view_count}}</h6>
      <h6 class="card-subtitle mb-2 text-muted">Host Type: {{$tracker_info[0]->host}}</h6>
      <p class="card-text">Created on : {{$tracker_info[0]->created_at}}</p>
      <p class="card-text">Last Updated on : {{$tracker_info[0]->updated_at}}</p>
      <p class="card-text">Remark : {{$tracker_info[0]->remark}}</p>
      <a href="/track/{{$tracker_info[0]->tracking_no}}" class="card-link" target="_blank">Tracker Link</a>
    </div>
  </div>
  </div>
<div class="container">   
  <table class="table table-hover">
          <thead>
              <tr class="table-success">
                  <th>S.L</th>
                  <th>Tracker ID</th>
                  <th>IP Address</th>
                  <th>Geo Location</th>
                  <th>User Agent</th>
                  <th>Referer</th>
                  <th>Created On</th>
              </tr>
          </thead>
          <tbody>
            @php
            $count=1;
            @endphp
              @foreach ($trackers_log as $tracker)
              <tr class="table-dark">
                  <th scope="row">{{$count}}</td>
                  <th scope="row">{{$tracker->fk_tracking_no}}</td>
                  <td>{{$tracker->ip_address}}</td>
                  <td>{{$tracker->geolocation}}</td>
                  <td>{{$tracker->user_agent}}</td>
                  <td>{{$tracker->referer}}</td>
                  <td>{{$tracker->created_at}}</td>
                  {{-- optional format using user define function in helper.php file  --}}
              {{-- <td>
                      <a href="{{route('tracker.delete',['id' =>$tracker->tracking_no])}}">
                      <button class="btn btn-danger">Delete</button>
                  </a>
                  <a href="{{route('tracker.logs',['number' =>$tracker->tracking_no])}}">
                      <button class="btn btn-primary">Logs</button>
                  </a>  
              </td> --}}
              </tr>
              @php
              $count ++ ;
              @endphp
              @endforeach
          </tbody>
      </table>
  </div>

  @endsection