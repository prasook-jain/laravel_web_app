<?php
/**
 * Created by PhpStorm.
 * User: PrasookDJ
 * Date: 2019-02-08
 * Time: 23:10
 */?>

@extends('layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

@section('content')

    <div class="container ">
        <div class="card">
            <div class="card-header">
                <div class="card-title"> Reports </div>
            </div>
            <div class="card-body text-justify">
                <div class="row m-2">
                    <div class="col-md-6 d-flex flex-column justify-content-around align-items-center">
                        <div class="row card-subtitle">
                            Total Sales vs. Day
                        </div>
                        <div class="row">
                            {!! $salesEachDayLineGraph->container() !!}
                        </div>
                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-around align-items-center">
                        <div class="row card-subtitle">
                            Total Sales vs. Product
                        </div>
                        <div class="row">
                            {!! $salesPerProductPieGraph->container() !!}
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-md-12 d-flex flex-column justify-content-around align-items-center">
                        <div class="row card-subtitle">
                            No of Sales Per Product
                        </div>
                        <div class="row">
                            {!! $countPerProductBarGraph->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! $salesEachDayLineGraph->script() !!}
    {!! $salesPerProductPieGraph->script() !!}
    {!! $countPerProductBarGraph->script() !!}

    @extends('layouts.error')

    @endsection
