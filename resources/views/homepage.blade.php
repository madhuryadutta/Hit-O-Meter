@extends('layouts.main')
@push('title')
<title>Hit-O-Meter</title>

@endpush
@section('main-section')


<div class="container">
    <div class="container">
        {{-- <h1>Hello, world!</h1> --}}
    </Div>
    <div class="px-4 pt-5 my-5 text-center border-bottom">
        <h1 class="display-4 fw-bold text-body-emphasis">Hit-O-Meter</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">
                {{-- Quickly design and customize responsive mobile-first sites with Bootstrap,
                the world’s most popular front-end open source toolkit, featuring Sass variables and mixins,
                responsive grid system, extensive prebuilt components, and powerful JavaScript plugins. --}}
                Hit-O-Meter is a Tools for Counting Profile/Page/Visitor View Count build using PHP (Laravel)
            </p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                <a href="#create_new_tracker" style="color:white;text-decoration: none;">
                    <button type="button" class="btn btn-primary btn-lg px-4 me-sm-3">
                        Create</button>
                </a>
                <a href="/login" style="color:white;text-decoration: none;">
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4">
                        Sign up
                    </button>
                </a>
            </div>
        </div>
        <!-- <div class="overflow-hidden" style="max-height: 30vh;">
            <div class="container px-5">
                <img src="bootstrap-docs.png" class="img-fluid border rounded-3 shadow-lg mb-4"
                    alt="Example image" width="700" height="500" loading="lazy">
            </div>
        </div> -->
    </div>
    <div class="container" id="create_new_tracker">
        <!-- <h1 class="text-center">
            Create A New Page View Tracker </h1> -->
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
        {{-- <a href="{{route('tracker.list')}}"> <button class="btn btn-primary btn-lg float-right"> View Tracker List
            </button></a> --}}
        @endsection