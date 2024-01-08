@extends('layouts.main')
@push('title')
    <title>Welcome</title>
@endpush
@section('main-section')

@php
echo '<pre>';
var_dump($data1);
echo '</pre>';

@endphp

@endsection