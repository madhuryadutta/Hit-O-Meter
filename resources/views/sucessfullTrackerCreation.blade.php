@extends('layouts.main')
@push('title')
<title>Tracker Created Successfully</title>
@endpush
@section('main-section')
<div class="card mb-3">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tracker Info & Log</h4>
            <h6 class="card-subtitle mb-2 text-muted">Total Views: 0</h6>
            <h6 class="card-subtitle mb-2 text-muted">Friendly Name: {{$data1['friendly_name']}}</h6>
            <h6 class="card-subtitle mb-2 text-muted">Host Type: {{$data1['host_type']}}</h6>
            <h6 class="card-subtitle mb-2 text-muted">Security Key(Please Save this key for future reference): {{$data1['seurity_key']}}</h6>
            <p class="card-text">Creator: {{$data1['creator']}}</p>
            <p class="card-text">Creator Mail:{{$data1['creator_mail']}}</p>
            <p class="card-text">Remark : {{$data1['remark']}}</p>
            <a href="/track/{{$data1['tracker_no']}}" class="card-link" target="_blank">Tracker Link</a>
        </div>
    </div>
</div>
<div class="container">
@endsection