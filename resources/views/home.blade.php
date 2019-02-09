@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row-md-12"> Welcome {{ Auth::user()->name }}, </div>
                    <div class="row row-12 justify-content-around">
                        <div class="col-md-3" >
                            <a href="/orders" >
                                <button class="button" >Add Order</button>
                            </a>
                        </div>
                        <div class="col-md-3" >
                            <a href="/view_report" >
                                <button class="button" >View Report</button>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
