@extends('layouts.app')
<style type="text/css">

</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="heading"><p class="text-center">Topics</p></div>
                @if(count($blog) > 0)
                    @foreach($blog as $blogs)
                    <h1 class="text-center"><a href='{{ url("/read/$blogs->id/$blogs->slugline/") }}' class="title-strong-view">{{ ucwords($blogs->title) }}</a></h1>
                    @endforeach
                @else
                    <h1>No blog posts yet</h1>
                @endif
                </div>
                    <span class="text-center">{{$paginate->links()}}</span>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-md-offset-2">
        <a href="/" class="btn btn-success"><span class="glyphicon glyphicon-backward"></span> Back to Homepage</a>
    </div>
</div>
@endsection
