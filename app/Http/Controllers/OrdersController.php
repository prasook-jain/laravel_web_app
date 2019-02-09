<?php

namespace App\Http\Controllers;

use App\Charts\Graph;
use App\Menu;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    //

    public function index(){

        if(Auth::guest()){
            return redirect('/');
        }

        $menus = Menu::all();
        return view('order', compact('menus'));
    }

    public function store(Order $order){

        $attributes = request()->validate([
            'menu_id' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric']
        ]);

        $attributes['user_id'] = Auth::id();
        $attributes['total_amount'] = $attributes['menu_id']*$attributes['quantity'];

        $order->create($attributes);

        return redirect('/home');

    }

    public function show(Order $order){

        if(Auth::guest()) {
            return redirect('/');
        }

        $salesEachDayLineGraph = $order->createLineGraph();
        $salesPerProductPieGraph = $order->createPieGraph();
        $countPerProductBarGraph = $order->createBarGraph();

        return view( 'report', compact('salesEachDayLineGraph', 'salesPerProductPieGraph', 'countPerProductBarGraph' ));
    }

}
