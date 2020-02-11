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
                <div class="panel-heading">Upload a Property</div>
                <p class="text-center">{{ $user->name }}</p>
                <p class="text-center">{{ $user->email }}</p>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('updateReview', array($user->id)) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('transaction_amount') ? ' has-error' : '' }}">
                            <label for="number" class="col-md-4 control-label">Transaction Amount</label>

                            <div class="col-md-6">
                                <input id="transaction_amount" type="number" class="form-control" name="transaction_amount" value="{{ old('transaction_amount') }}" required autofocus placeholder="e.g 5000">

                                @if ($errors->has('transaction_amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('transaction_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Review
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
