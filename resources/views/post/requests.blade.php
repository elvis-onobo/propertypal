@extends('layouts.app')



@section('content')
        <div class="col-md-12">
            <div class="  m-top">
                <div class="heading"><p class="text-center">Customer Requests</p></div>
                <div class="">

                @if(count($requests) > 0)
                    @foreach($requests as $request)
                    <div class="mb-4 text-center panel">
                        <div class="card h-100">

                            <div class="card-body panel-body">
                            <p>Hi, my name is {{ $request->name }}, I need {{ $request->type }} (<strong>{{ $request->request }}</strong>) around {{ $request->location }}. My budget is {{ $request->budget }}</p>

                        @if(Auth::guard('admin')->check())
                            <p><span class="glyphicon glyphicon-phone-alt"></span> CUSTOMER PHONE NUMBER: {{ $request->phone_number }} and EMAIL: {{ $request->email }}</p>
                        @endif
                        <span class="fa fa-calendar"></span><cite style="" class="">Posted on: {{date('M j, Y H:i', strtotime($request->created_at))}}</cite>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p>Be the first to post in this section</p>
                @endif
                </div>
                <div class="text-center">
                    {{$requests->links()}}
                </div>
            </div>
        </div>

@endsection