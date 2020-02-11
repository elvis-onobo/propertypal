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
                <div class="panel-heading">Admin Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

        <div class="col-md-10 col-md-offset-1">
                <form method="POST" action='{{ url("/search") }}'>
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Enter location,price,type or PID">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                            Search
                        </button>
                    </span>
                </div>
                </form>
        </div>
    </div>
</div>

@if($adminRank == 1)
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3">
                <div class="panel panel-body text-center"><h2>Users</h2>
                        <hr />
                    <h2>{{$user}}</h2>
                 </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-body text-center"><h2>Uploads</h2>
                        <hr />
                    <h2>{{$upload}}</h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-body text-center"><h2>Admins</h2>
                        <hr />
                    <h2>{{$countAdmins}}</h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-body text-center"><h2>Adverts</h2>
                        <hr />
                    <h2>{{$countAdverts}}</h2>
                </div>
            </div>
        </div>
    </div>
@endif

</div>
@endsection