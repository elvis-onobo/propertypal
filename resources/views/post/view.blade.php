@extends('layouts.app')

<div>
@section('title')
    @if(count($upload) > 0)
    @foreach($upload->all() as $uploads)
        {{ $uploads->type }} For {{ $uploads->category }} at {{ $uploads->location }}
    @endforeach
    @endif
@endsection
</div>


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                @if(count($upload) > 0)
                    @foreach($upload as $uploads)
                    <div>
                        <span class="title-strong-view"> {{ ucwords($uploads->type) }} For {{ $uploads->category }} @ {{ $uploads->location }} </span>
                        <span class="pid">PID {{ $uploads->pid }} </span>
                    </div>
                    <div>
                        <span class="price-view"><del><strong>N</strong></del> {{ $uploads->price + ($uploads->price/100)*5}} </span>
                        <span class="glyphicon glyphicon-map-marker"></span>  {{ $uploads->state }} State
                    </div>
                    <div>
                        <p>
                            @if(count($water) > 0)
                                @foreach($water as $waters)
                                <span class="glyphicon glyphicon-tint"></span> {{ $waters->evaluation }}% Water |
                                @endforeach
                            @endif

                            @if(count($light) > 0)
                                @foreach($light as $lights)
                                <span class="glyphicon glyphicon-lamp"></span> {{ $lights->evaluation }}% Light |
                                @endforeach
                            @endif

                            @if(count($security) > 0)
                                @foreach($security as $securities)
                                <span class="glyphicon glyphicon-lock"></span> {{ $securities->evaluation }}% Security |
                                @endforeach
                            @endif

                            @if(count($road) > 0)
                                @foreach($road as $roads)
                                <span class="glyphicon glyphicon-road"></span> {{ $roads->evaluation }}% Road
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="card-img-top-view">
                        <img src="{{ $uploads->picture }}" alt="{{ $uploads->slugline }}">
                    </div>


                    @if(count($moreimages) > 0)
                        <div class="row">
                        @foreach($moreimages as $moreimage)
                            <span class="col-md-3 col-sm-12 col-xs-12 m-top">
                                <img src="{{ $moreimage->image }}" class="img-responsive img-thumbnail myImg" alt="{{ $uploads->slugline }}" id="myImg" title="click to zoom">
                            </span>
                        @endforeach
                        <!-- The Modal -->
                            <div id="myModal" class="modal col-md-3 col-sm-12 col-xs-12 m-top">
                              <span class="close">&times;</span>
                              <img class="modal-content img01" id="img01">
                              <div id="caption" class="caption"></div>
                            </div>
                        </div>

                    @else
                    @endif


                        @if(Auth::guard('admin')->check())
                            <p><span class="glyphicon glyphicon-phone-alt"></span> AGENT PHONE NUMBER: {{ $uploads->phone }}</p>
                        @endif
                        <p><span class="glyphicon glyphicon-earphone m-top"></span> Call us on <h1>0814-713-8730</h1> to
                            @if($uploads->category == 'Rent')
                                rent
                            @elseif($uploads->category == 'Sale')
                                buy
                            @elseif($uploads->category == 'Project')
                                construct, join or buy
                            @else
                            @endif
                         this property</p>

                        <p><span class="glyphicon glyphicon-plus-sign"></span> {!! nl2br(e($uploads->additional_info)) !!}</p>
                        <p><span class="glyphicon glyphicon-barcode"></span> {{ $uploads->pid }} </p>
                        @if($uploads->availability < 2)
                            <p><span class="glyphicon glyphicon-folder-open"></span> This property is currently available </p>
                        @else
                            <p><span class="glyphicon glyphicon-folder-close"></span> This property is currently unavailable </p>
                        @endif

                </div>
            </div>

            <div class="panel panel-body">
                <p>Disclaimer!</p>
                <p>The information displayed about this property comprises a property advertisement.</p>

                <p>To avoid fraud, Propertypal attempts to govern interaction with <strong>{{ $uploads->name }}</strong>
                    ; However, Propertypal does not take responsibility for the consequence of any
                    interaction with <strong>{{ $uploads->name }}</strong>.
                </p>

                <p>Propertypal may interfere or mediate in a transaction only if Propertypal was/is part of the transaction
                    through an authorised staff of Propertypal.
                    In this case, Propertypal may respresent its client to the extent deemed necessary.
                    We therefore advise that you ensure to carry out transactions in the presence of a Propertypal staff.
                </p>

                <p>This property listing does not constitute property particulars.
                    The information is provided and maintained by <strong>{{ $uploads->name }}</strong>.
                </p>
            </div>

            <div class="panel panel-body">
                <p>Similar Properties</p>
                @if(count($similar) > 0)
                    @foreach($similar as $similars)
                    <div class="col-md-6">
                        <div class="card h-100 thumbnail text-center">
                            <a href='{{ url("/view/$similars->id/$similars->rentorsale/$similars->category/$similars->state/$similars->slugline/") }}'>
                                <div class="card-img-top-similar">
                                    <img src="{{ $similars->picture }}" alt="{{$similars->slugline}}" />
                                </div>
                            </a>
                            <div class="card-body">
                                <span class="card-title">{{ ucwords($similars->type) }}</span><br />
                                <span class="card-title price"><del>N</del>{{ $uploads->price + ($uploads->price/100)*5}}</span>  <span > PID:{{ $similars->pid }} </span><br />
                                <span class="card-title">{{ $similars->location }}</span><br />
                                <span class="card-title color-btn"><a href='{{ url("/view/$similars->id/$similars->rentorsale/$similars->category/$similars->state/$similars->slugline/") }}' id="link"> View Property</a></span>
                            </div>
                            <!-- <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div> -->
                            </ul>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p>Found no similar properties</p>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
<!--                 <div class="panel-heading">Posted By</div> -->

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

                <p><span class="glyphicon glyphicon-user"></span> {{ $uploads->name }}</p>
                <cite class="card-title"><span class="glyphicon glyphicon-time"></span>  {{date('M j, Y H:i', strtotime($uploads->created_at))}} </cite><br />
                <cite class="card-title"><span class="glyphicon glyphicon-stats"></span> We have done {{ $reviews }} successful transactions with {{ $uploads->name }}</cite>
        </div>
        </div>

            @endforeach
        @endif

            <div class="panel panel-body">
                <p>Ads</p>

            </div>
            <a href="{{ url('/') }}" class="btn btn-success"><span class="glyphicon glyphicon-backward"></span> Back to Homepage</a>
        </div>
    </div>
</div>

@endsection
