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
                                <a href='{{ url("/state/$state->id") }}' class="" value="{{ $state->id }}">{{ $state->state }}</a>
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

                    @if(count($upload) > 0)
                    @foreach($upload as $uploads)
                    <div class="col-lg-3 col-md-4 mb-4 text-center panel-body">
                        <div class="card h-100 thumbnail">
                            <a href='{{ url("/view/$uploads->id/$uploads->rentorsale/$uploads->category/$uploads->state/$uploads->slugline/") }}'>
                                <div class="card-img-top">
                                    <img  src="{{ $uploads->picture }}" alt="">
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
                    @else
                        <p>Be the first to upload properties for this state</p>
                    @endif
                </div>
                <div class="text-center">
                    {{$upload->links()}}
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="  m-top">
                <!-- <div class="heading"><p class="text-center">Properties Without Pictures</p></div> -->
                <div class="">

                @if(count($noPictures) > 0)
                    @foreach($noPictures as $uploads)
                    <div class="mb-4 text-center panel">
                        <div class="card h-100">

                            <div class="card-body panel-body">
<!-- start content -->
                        <span class="title-strong-view"> {{ ucwords($uploads->type) }} For {{ $uploads->category }} at {{ $uploads->location }} </span>
                        <span class="pid">PID {{ $uploads->pid }} </span>,
                        <span class="price-view"><del><strong>N</strong></del> {{ $uploads->price + ($uploads->price/100)*5}} </span>
                        <span class="fa fa-map-marker"></span>  {{ $uploads->state }} State
                        <span class="fa fa-phone"></span> Call us on <strong>0814-713-8730</strong> to
                            @if($uploads->category == 'Rent')
                                rent
                            @elseif($uploads->category == 'Sale')
                                buy
                            @elseif($uploads->category == 'Project')
                                construct, join or buy
                            @else
                            @endif
                         this property
                        @if(Auth::guard('admin')->check())
                            <p><span class="glyphicon glyphicon-phone-alt"></span> AGENT PHONE NUMBER: {{ $uploads->phone }}</p>
                        @endif
                        <p><span class="fa fa-plus"></span> {!! nl2br(e($uploads->additional_info)) !!}
                        <span class="fa fa-calendar"></span><cite style="" class="">Posted on: {{date('M j, Y H:i', strtotime($uploads->updated_at))}}</cite>
<!-- end content -->
                            </div>
                            <div class="card-footer">
<!--                             <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small> -->
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p>Be the first to post for this state</p>
                @endif
                </div>
                <div class="text-center">
                    {{$noPictures->links()}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class=" col-md-12">
                <div class="col-sm-6">
                    <div class="panel  m-top">
                        <div class="heading"><p class="text-center">Blog Posts</p></div>
                        <div class="panel-body">
                        @foreach($blog as $blogs)
                            <p><a href='{{ url("/read/$blogs->id/$blogs->slugline/") }}'  class="title-strong-view">>>{{ ucwords($blogs->title) }}</a></p>
                        @endforeach
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel  m-top">
                            <div class="heading"><p class="text-center">About Us</p></div>
                            <div class="panel-body">
                                <p>Unyiproperties.ng is a leading real estate and property platform built to facilitate ease and transparency in property transactions. We seek to protect both agents and clients from fraud and loss of any kind even though we do not take responsibility for these.</p>
                                <p>Worth over $10 billion, the real estate industry is a viable investment and we are constantly collaborating with honest individuals and organisations to provide the best property search, rental, sale and project management services in the Nigerian real estate industry</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
