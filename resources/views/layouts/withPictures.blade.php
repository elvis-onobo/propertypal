@extends('layouts.app')

@section('withPictures')
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
@endsection