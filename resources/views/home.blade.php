@extends('layouts.app')

<style type="text/css">
    .card-img-top{
        height: 150px;
        width: 200px;
    }
</style>


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
                @endforeach
            @endif

            @if(session('response'))
                <div class="alert alert-success">{{ session('response') }}</div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Your Current Uploads</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                @if(count($upload) > 0)
                    @foreach($upload as $uploads)
                    <div class="col-lg-3 col-md-4 mb-4 text-center panel-body">
                        <div class="card h-100 thumbnail">
                            <div class="card-img-top">
                                <img class="card-img-top img-thumbanail" src="{{ $uploads->picture }}" alt="">
                            </div>
                            <div class="card-body">
                                <span class="card-title">{{ $uploads->type }}</span><br />
                                <span class="card-title">{{ $uploads->location }}</span><br />
                                <span class="card-title price"><del>N</del>{{ $uploads->price }}</span>
                                <span class="card-title">PID: {{ $uploads->pid }}</span>
                            <div>
                                <a href='{{ url("/edit/$uploads->id") }}' class="btn btn-success fa fa-edit" title="edit this property information"></a>
                                <a href='{{ url("/addpics/$uploads->id") }}' class="btn btn-warning fa fa-camera" title="add more pictures to show your customers"></a>
                                <a href='{{ url("/availability/$uploads->id") }}' class="btn btn-info fa fa-briefcase" title="set whether this property is available or not"></a>
                                <a href='{{ url("/delete/$uploads->id") }}' class="btn btn-danger fa fa-trash" title="delete this property"></a>
                            </div>
                        </div>
<!--                             <div class="card-footer">
                             <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div> -->
                        </div>
                    </div>
                    @endforeach
                @else
                    <p>You have no uploads yet</p>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
