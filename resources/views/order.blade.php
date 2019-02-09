<?php
/**
 * Created by PhpStorm.
 * User: PrasookDJ
 * Date: 2019-02-08
 * Time: 10:47
 */?>

@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Purchase Item</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="/orders" class="from-horizontal">
                            @csrf
                            <div class="form-group">
                                <label for="Item">Item:</label>
                                <select name="menu_id" id="drop_down" class="form-control" required>
                                    <option value="">--select item--</option>
                                    @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}" price="{{ $menu->price }}">{{ $menu->item }} : ({{ $menu->price }})</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Quantity">Quantity:</label>
                                <input class="form-control" id="quantity" type="number" name="quantity" id="quantity" placeholder="0" required>
                            </div>

                            <div class="form-group">
                                <label for="Total Amount">Total Amount</label>
                                <div class="form-control" id="total_amount">

                                </div>

                                <script type="text/javascript">

                                    $('#quantity').on( 'keyup', function () {
                                            let total_amount = 0
                                            let price = $('#drop_down').find('option:selected').attr('price')
                                            let quantity = $(this).val()

                                            if( parseInt(price) > 0 && parseInt(quantity) > 0)
                                                total_amount =  price * quantity
                                            else
                                                total_amount = 0
                                            $('#total_amount').text(total_amount);
                                        }
                                    )

                                    $('#drop_down').on('change', function () {
                                            let total_amount = 0
                                            let price = $(this).find('option:selected').attr('price')
                                            let quantity = $('#quantity').val()

                                            if( parseInt(price) > 0 && parseInt(quantity) > 0)
                                                total_amount =  price * quantity
                                            else
                                                total_amount = 0
                                            $('#total_amount').text(total_amount);
                                        }
                                    )

                                </script>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    @extends('layouts.error');

                </div>
            </div>
        </div>
    </div>
    @endsection
