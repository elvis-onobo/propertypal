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

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('uploadpost') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input id="name" type="number" class="form-control" name="phone" value="{{ old('name') }}" required autofocus placeholder="e.g 08011122233">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Type of Property</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="type" value="{{ old('name') }}" required autofocus placeholder="e.g bungalow, land etc" maxlength="30">

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Location</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" required placeholder="e.g Phase II, Lekki">

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">State</label>

                            <div class="col-md-6">
                                <select id="password-confirm" type="text" class="form-control" name="state" required>
                                    @if(count($states) > 0)
                                        @foreach($states->all() as $state)
                                            <option value="{{$state->id}}">{{ $state->state }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="number" class="col-md-4 control-label">Price</label>

                            <div class="col-md-6">
                                <input id="password" type="number" class="form-control" name="price" required placeholder="e.g 300,000">

                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                <select id="password-confirm" type="text" class="form-control" name="rentorsale" required>
                                    @if(count($categories))
                                        @foreach($categories->all() as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Water</label>

                            <div class="col-md-6">
                                <select id="password-confirm" type="text" class="form-control" name="water" required>
                                    @if(!empty($evaluation))
                                        @foreach($evaluation->all() as $evaluation)
                                            <option value="{{ $evaluation->id }}">{{ $evaluation->evaluation }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Light</label>

                            <div class="col-md-6">
                                <select id="password-confirm" type="text" class="form-control" name="light" required>
                                    @if(!empty($evaluation))
                                        @foreach($evaluation->all() as $evaluation)
                                            <option value="{{ $evaluation->id }}">{{ $evaluation->evaluation }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Security</label>

                            <div class="col-md-6">
                                <select id="password-confirm" type="text" class="form-control" name="security" required>
                                    @if(!empty($evaluation))
                                        @foreach($evaluation->all() as $evaluation)
                                            <option value="{{ $evaluation->id }}">{{ $evaluation->evaluation }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Road</label>

                            <div class="col-md-6">
                                <select id="password-confirm" type="text" class="form-control" name="road" required>
                                    @if(!empty($evaluation))
                                        @foreach($evaluation->all() as $evaluation)
                                            <option value="{{ $evaluation->id }}">{{ $evaluation->evaluation }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Additional Info</label>

                            <div class="col-md-6">
                                <textarea id="password-confirm" type="text" class="form-control" name="additional_info" required rows="3" placeholder="Give more information about the property">
                                </textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Picture</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="file" class="form-control" name="picture" accept="image/*" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Upload
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
