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
                <div class="panel-heading">Set Property's Current Availability</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('setAvailability' ,array($upload->id)) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="form-group">
                            <label for="availability" class="col-md-4 control-label">Availability</label>

                            <div class="col-md-6">
                                <select id="availability" type="text" class="form-control" name="availability" required>
                                    @if(count($availabilities) > 0)
                                        @foreach($availabilities->all() as $availability)
                                            <option value="{{ $availability->id }}">{{ $availability->availability }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
