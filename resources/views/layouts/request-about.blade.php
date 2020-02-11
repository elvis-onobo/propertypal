@extends('layouts.app')

@section('request')
        <div class="row">
            <div class=" col-md-12">
                <div class="col-sm-6">
                    <div class="panel  m-top">
                        <div class="heading"><p class="text-center">Blog Posts</p></div>
                        <div class="panel-body">
                        @foreach($blog as $blogs)
                            <p><a href='{{ url("/read/$blogs->id/$blogs->slugline/") }}' class="title-strong-view">>>{{ ucwords($blogs->title) }}</a></p>
                        @endforeach
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
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