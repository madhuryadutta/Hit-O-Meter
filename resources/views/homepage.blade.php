@extends('layouts.main')
@push('title')
<title>Hit-O-Meter</title>

@endpush
@section('main-section')


<div class="container">
    <div class="container">
        {{-- <h1>Hello, world!</h1> --}}
    </Div>
    <div class="container">
        <h1 class="text-center">
            Create A New Page View Tracker </h1>
        <form action="{{url('/new_tracker')}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="friendly_name">Friendly Name</label>
                <input type="text" name="friendly_name" id="friendly_name" class="form-control" value="{{old('friendly_name')}}" placeholder="Please enter the friendly name" aria-describedby="helpId">
                <span class="text-danger">
                    @error('friendly_name')
                    {{$message}}
                    @enderror
                </span>
                <small id="helpId" class="text-muted">If you leave it blank, we will generate a name for you </small>
            </div>
            <div class="form-group">
                <label for="remark">Remark (Optional)</label>
                <input type="text" name="remark" id="remark" class="form-control" value="{{old('remark')}}" placeholder="This is a optional field" aria-describedby="helpId">
                <span class="text-danger">
                    @error('remark')
                    {{$message}}
                    @enderror
                </span>
                {{-- <small id="helpId" class="text-muted">Help text</small> --}}
            </div>
            <div class="form-group">
                <label for="host_type">Tracker Type ( Host Type)</label>
                <select name="host_type" id="host_type" class="form-control" value="{{old('host_type')}}" placeholder="Please Select the Host type" aria-describedby="helpId">
                    <option value=""> --Select--</option>
                    <option value="github">Github</option>
                    <option value="html">Html</option>
                </select>
                <span class="text-danger">
                    @error('host_type')
                    {{$message}}
                    @enderror
                </span>
                {{-- <small id="helpId" class="text-muted">Help text</small> --}}
            </div>
            <br>
            <button class="btn btn-primary"> Create</button>
    </div>
    </form>
    <br>
    <br>
    <br>
    <div class="container">
        <a href="{{route('tracker.list')}}"> <button class="btn btn-primary btn-lg float-right"> View Tracker List
            </button></a>
        @endsection