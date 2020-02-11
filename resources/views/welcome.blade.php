@extends('layouts.app')



@section('content')
<div class="container banner">
<p class="text-center banner-text m-top">Find Properties With Ease</p>
    <div class="col-md-8 col-md-offset-2 m-top">
        <form method="POST" action='{{ url("/search") }}'>
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" name="search" class="form-control remove-radius" placeholder="Enter location,price,type,PID" id="remove-radius">
                <span class="input-group-btn">
                    <button type="submit" class="btn search" id="remove-radius">
                            <span class="glyphicon glyphicon-search"></span>
                        Search
                    </button>
                </span>
            </div>
        </form>
    </div>
    <div class="row col-md-offset-4">
        <div class="col-md-8 m-top">
            <div class="col-md-5 col-sm-6 col-xs-6">
                    <ul class="list-unstyled">
                      <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" id="link">Select Category
                          <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @if(count($categories) > 0)
                                @foreach($categories->all() as $category)
                                    <a href='{{ url("/category/$category->id") }}' class="list-group-item" value="{{ $category->id }}">{{ $category->category }}</a>
                                @endforeach
                            @endif
                        </ul>
                      </li>
                    </ul>
            </div>


            <div class="col-md-5 col-sm-6 col-xs-6">
                <ul class="list-unstyled">
                  <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" id="link">Select State
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        @if(count($states) > 0)
                            @foreach($states->all() as $state)
                                <a href='{{ url("/state/$state->id") }}' class="list-item" value="{{ $state->id }}">{{ $state->state }} </a>
                            @endforeach
                        @endif
                    </ul>
                  </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="container m-top">
        <div class="col-md-12">
            <div class="panel  m-top">
                <div class="heading"><p class="text-center">Featured Properties</p></div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    @foreach($upload as $uploads)
                    <div class="col-lg-3 col-md-4 mb-4 text-center panel-body">
                        <div class="card h-100 thumbnail">
                            <a href='{{ url("/view/$uploads->id/$uploads->rentorsale/$uploads->category/$uploads->state/$uploads->slugline/") }}'>
                                <div class="card-img-top">
                                    <img  src="{{ $uploads->picture }}" alt="{{ $uploads->slugline }}">
                                </div>
                            </a>
                            <div class="card-body">
                            <span class="card-title">{{ ucwords($uploads->type) }}</span><br />
                            <span class="card-title price"><del>N</del>{{ $uploads->price + ($uploads->price/100)*5}}</span>  <span > PID:{{ $uploads->pid }} </span><br />
                            <span class="card-title">{{ $uploads->location }}</span><br />
                            <span class="card-title color-btn"><a href='{{ url("/view/$uploads->id/$uploads->rentorsale/$uploads->category/$uploads->state/$uploads->slugline/") }}' id="link"> View Property</a></span>
                            </div>
                            <div class="card-footer">
<!--                             <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small> -->
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center">
                    {{$upload->links()}}
                </div>
            </div>
        </div>



        <div class="row">
            <div class=" col-md-12">
                <div class="col-sm-6">
                    <div class="panel  m-top">
                        <div class="heading"><p class="text-center">Request A Property</p></div>
                        <div class="panel-body">

            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
                @endforeach
            @endif

            @if(session('response'))
                <div class="alert alert-success">{{ session('response') }}</div>
            @endif

                    <form class="form-horizontal" method="POST" action="{{ url('makeRequest') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="e.g Ola Eze Musa">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="phone_number" value="{{ old('name') }}" required autofocus placeholder="e.g 08011122233">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('name') }}" required autofocus placeholder="e.g abc@xyz.com" maxlength="30">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Type Of Property</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="type" value="{{ old('type') }}" required autofocus placeholder="e.g 3 bedroom bungalow">

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

                        <div class="form-group{{ $errors->has('budget') ? ' has-error' : '' }}">
                            <label for="budget" class="col-md-4 control-label">Budget</label>

                            <div class="col-md-6">
                                <input id="budget" type="text" class="form-control" name="budget" value="{{ old('budget') }}" required placeholder="e.g 100,000 - 200,000">

                                @if ($errors->has('budget'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('budget') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="request" class="col-md-4 control-label">Additional Requirement</label>

                            <div class="col-md-6">
                                <textarea id="request" type="text" class="form-control" name="request" required rows="2" placeholder="More description of the property you want">
                                </textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Request
                                </button>
                            </div>
                        </div>
                    </form>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel  m-top">
                            <div class="heading"><p class="text-center">Blog Posts</p></div>
                            <div class="panel-body">
                            @foreach($blog as $blogs)
                                <p><a href='{{ url("/read/$blogs->id/$blogs->slugline/") }}' class="title-strong-view">>>{{ ucwords($blogs->title) }}</a></p>
                            @endforeach
                            </div>
                        </div>

                        <div class="panel  m-top">
                            <div class="heading"><p class="text-center">About Us</p></div>
                            <div class="panel-body">
                                <p>Propertypal is a leading real estate and property platform built to
                                    facilitate ease and transparency in property transactions in Nigeria while engaging in property development and management.
                                </p>
                                <blockquote>We are particularly concerned about our customers' comfort, security and speed of transactions and these influence every decision we make.
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
