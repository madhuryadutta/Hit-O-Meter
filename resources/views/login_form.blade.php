@extends('layouts.main')
@push('title')
<title>Hit-O-Meter</title>

@endpush
@section('main-section')
<body>
    <div class="container">
        <div class="row">

            <div class="col-sm">
                <div class="container">
                    <h1 class="text-center">
                        Login </h1>
                    <form action="{{('/login_request')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{old('u_name')}}" placeholder="" aria-describedby="helpId">
                            <span class="text-danger">
                                @error('email')
                                {{$message}}
                                @enderror
                            </span>
                            {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="" aria-describedby="helpId">
                            <span class="text-danger">
                                @error('password')
                                {{$message}}
                                @enderror
                            </span>
                            {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                        </div>
                        <button class="btn btn-primary"> Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-sm">
                <div class="container">
                    <h1 class="text-center">
                        Register </h1>
                    <form action="{{('/register_request')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{old('u_name')}}" placeholder="" aria-describedby="helpId">
                            <span class="text-danger">
                                @error('email')
                                {{$message}}
                                @enderror
                            </span>
                            {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="" aria-describedby="helpId">
                            <span class="text-danger">
                                @error('password')
                                {{$message}}
                                @enderror
                            </span>
                            {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                        </div>
                        <button class="btn btn-primary"> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection