@extends('layouts.main')
@push('title')
<title>Error 404</title>
@endpush
@section('main-section')

    
<div class="wrapper" style="padding: 3% 6%;
margin: 0 auto 5em;">
    <div role="main" class="main">
        <div class="row-fluid">
            <div class="span3">
                <div class="span1 ellipsis">
                    <h1>Error 404</h1>
                </div>
                <div class="span2 ellipsis">
                    <h2 class="pull-right">Houston, We Have A Problem.</h2>
                </div>
            </div>
            <h2>Page Not Found</h2>
            <hr style="display: block;
            height: 1px;
            border: 0;
            border-top: 1px solid #ccc;
            margin: 1em 0;
            padding: 0;">

            <h3>What does this mean?</h3>

            <p>
                We looked everywhere for this page.Are you sure the website URL is correct?
            </p>
            <p> The page you were looking for appears to have been moved, deleted or does not exist.
                This occurrence has been logged, and a highly trained team of monkeys has been
                dispatched to deal with your problem. We're really sorry about this, and will
                work hard to get this resolved as soon as possible.
            </p>
            <!-- <p>
                This error can be identified by <i>9248aec1-3bc4-4f37-a224-291678fe58d2</i>.
                You might want to take a note of this code.
            </p> -->
            <p>
                Perhaps you would like to go to our <a href="./">home page</a>?
            </p>
        </div>
    </div>
</div>

@endsection
