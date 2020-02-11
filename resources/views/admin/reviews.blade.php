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
                <div class="panel-heading">Reviews</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

        <div class="col-md-10 col-md-offset-1">
                <form method="POST" action='{{ url("/reviewAgent") }}'>
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" name="reviewEmail" class="form-control" placeholder="Enter the agent's email">
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
@endsection
