@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Advert</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('advertise') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('picture') ? 'picture has-error' : '' }}">
                            <label for="picture" class="col-md-4 control-label">Graphic Picture</label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control" name="picture" value="{{ old('picture') }}" accept="image/*" required autofocus>

                                @if ($errors->has('picture'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('picture') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="link" class="col-md-4 control-label">Link</label>

                            <div class="col-md-6">
                                <input id="link" type="link" class="form-control" name="link" value="{{ old('link') }}" required>

                                @if ($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="state" class="col-md-4 control-label">State</label>

                            <div class="col-md-6">
                                <select id="state" type="text" class="form-control" name="state" required>
                                    @if(count($states) > 0)
                                        @foreach($states->all() as $state)
                                            <option value="{{$state->id}}">{{ $state->state }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Type</label>

                            <div class="col-md-6">
                                <input id="type" type="type" class="form-control" name="type" required>

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="duration" class="col-md-4 control-label">Duration in Days</label>

                            <div class="col-md-6">
                                <input id="duration" type="duration" class="form-control" name="duration" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Advertise
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
