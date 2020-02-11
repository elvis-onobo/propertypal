@extends('layouts.app')

@section('noPictures')
        <div class="col-md-12">
            <div class="  m-top">
                <div class="heading"><p class="text-center">Properties Without Pictures</p></div>
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
                    <p>Be the first to post in this section</p>
                @endif
                </div>
                <div class="text-center">
                    {{$noPictures->links()}}
                </div>
            </div>
        </div>
@endsection