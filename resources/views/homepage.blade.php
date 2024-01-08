@extends('layouts.main')
@push('title')
    <title>Welcome</title>
@endpush
@section('main-section')


    <div class="container">
    <div class="container">
    <h1>Hello, world!</h1>
    </Div>
    <div class="container">
        <h1 class="text-center">
            Create A New Page View Tracker </h1>
            <form action="{{url('/new_tracker')}}" method="POST">
                @csrf
                
        <div class="form-group">
            <label for="">Friendly Name (if you leave it blank, we will generate a name for you )</label>
            <input type="text" name="friendly_name" id="" class="form-control" value="{{old('friendly_name')}}" placeholder="" aria-describedby="helpId">
            <span class="text-danger">
                @error('friendly_name')
                    {{$message}}
                @enderror
            </span>
            {{-- <small id="helpId" class="text-muted">Help text</small> --}}
        </div>
        <div class="form-group">
            <label for="">Remark (Optional)</label>
            <input type="text" name="remark" id="" class="form-control" value="{{old('remark')}}" placeholder="" aria-describedby="helpId">
            <span class="text-danger">
                @error('remark')
                    {{$message}}
                @enderror
            </span>
            {{-- <small id="helpId" class="text-muted">Help text</small> --}}
        </div>
        <div class="form-group">
            <label for="">Tracker Type ( Host Type)</label>
            <select name="host_type" id="" class="form-control" value="{{old('host_type')}}" placeholder="" aria-describedby="helpId" >
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
    <a href="{{route('tracker.list')}}">  <button class="btn btn-primary btn-lg float-right"
    > View Tracker List
</button></a>
    @endsection