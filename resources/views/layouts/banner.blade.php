@extends('/')

@section('banner')
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
                                    <a href="/category/{{ $category->id }}" class="list-group-item" value="{{ $category->id }}">{{ $category->category }}</a>
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
                                <a href="/state/{{ $state->id }}" class="list-item" value="{{ $state->id }}">{{ $state->state }} </a>
                            @endforeach
                        @endif
                    </ul>
                  </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection