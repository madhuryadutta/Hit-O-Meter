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
            <label for="">Name</label>
            <input type="text" name="u_name" id="" class="form-control" value="{{old('u_name')}}" placeholder="" aria-describedby="helpId">
            <span class="text-danger">
                @error('u_name')
                    {{$message}}
                @enderror
            </span>
            {{-- <small id="helpId" class="text-muted">Help text</small> --}}
        </div>
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="u_name1" id="" class="form-control" value="{{old('u_name')}}" placeholder="" aria-describedby="helpId">
            <span class="text-danger">
                @error('u_name')
                    {{$message}}
                @enderror
            </span>
            {{-- <small id="helpId" class="text-muted">Help text</small> --}}
        </div>
    
        <button class="btn btn-primary"> Create</button>
    </div>
</form>
<div class="container">
    <a href="{{route('tracker.list')}}">  <button class="btn btn-primary btn-lg float-right"
    > View Tracker List
</button></a>

    @endsection