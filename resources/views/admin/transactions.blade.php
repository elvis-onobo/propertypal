@extends('layouts.app')
<style type="text/css">
    .card-img-top{
        height: auto;
        width: 700px;
    }
    .card-img-small{
        height: auto;
        width: 150px;
    }
    .m-top{
        margin-top: 20px;
    }
</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
<!--                 <div class="panel-heading">Most Recent Transactions</div> -->
                <div class="panel-body">

                <table class="table table-bordered">
                   <caption class="text-center">Most Recent Transactions</caption>
                   <thead>
                      <tr>
                         <th>User Name</th>
                         <th>Transaction Amount</th>
                         <th>User E-mail</th>
                         <th>Date</th>
                      </tr>
                   </thead>
                   <tbody>
                    @if(count($review) > 0)
                      @foreach($review as $reviews)
                      <tr>
                         <td>{{ $reviews->name }}</td>
                         <td>{{ $reviews->transaction_amount }}</td>
                         <td>{{ $reviews->email }}</td>
                         <td>{{ $reviews->created_at }}</td>
                   </tbody>
                      @endforeach
                    @endif
                </table>
                {{$paginate->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
