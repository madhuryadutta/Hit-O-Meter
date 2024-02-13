@extends('layouts.main')
@push('title')
<title>Site Maintenance</title>
@endpush
@section('main-section')
<div class="container" style=" text-align: center;padding: 150px; font: 20px Helvetica, sans-serif;">
    <article style=" display: block;text-align: left;width: 650px; margin: 0 auto;">
        <h1 style="font-size: 50px;">Maintenance in progress!</h1>
        <div class="container">
            <p> Meanwhile, please reach out to us @ <a href = "mailto: {{ config('custom.company.email') }}" > <span style="color: red;">{{ config('custom.company.email') }}</span> </a>, we&apos;ll be
                back online shortly!</p>
            <p>&mdash; Team {{ config('custom.company.name') }}</p>
        </div>
    </article>
</div>

@endsection