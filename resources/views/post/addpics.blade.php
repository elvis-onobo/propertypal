@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
                @endforeach
            @endif

            @if(session('response'))
                <div class="alert alert-success">{{ session('response') }}</div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Add More Pictures of this Property</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('addMorePics', array($upload->id)) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">

                            <label for="password-confirm" class="col-md-4 control-label">Add Picture</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="file" class="form-control" name="image" accept="image/*" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
