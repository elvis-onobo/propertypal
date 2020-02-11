@extends('layouts.app')

<div>
@section('title')
    @if(count($blog) > 0)
    @foreach($blog->all() as $blogs)
        {{ $blogs->title }}
    @endforeach
    @endif
@endsection
</div>
<style type="text/css">

</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                @if(count($blog) > 0)
                    @foreach($blog as $blogs)
                    <div>
                        <span class="title-strong-view"> {{ ucwords($blogs->title) }}</span>
                    </div>
                    <div>
                        <span class="price-view">By {{ $blogs->name }}</span>
                        <span> {{date('M j, Y H:i', strtotime($blogs->created_at))}}</span>
                    </div>
                    <div class="m-top">
                        {!! nl2br(e($blogs->body)) !!}
                    </div>
                    @endforeach
                @endif
                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
<!--                 <div class="panel-heading">Posted By</div> -->

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <p>Other Posts</p>
            @if(count($otherposts) > 0)
                @foreach($otherposts as $otherpost)
                <p><a href='{{ url("/read/$otherpost->id/$otherpost->slugline/") }}' class="title-strong-view">{{ $otherpost->title }}</a></p>
                @endforeach
            @endif
        </div>
        </div>


        <a href="{{ url('/') }}" class="btn btn-success"><span class="glyphicon glyphicon-backward"></span> Back to Homepage</a>
        </div>
    </div>
</div>
@endsection
