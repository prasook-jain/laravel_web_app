<?php

namespace App;

use App\Charts\Graph;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use function PHPSTORM_META\map;

class Order extends Model
{
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(App::class, 'menu_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function totalSalesEachDay()
    {

        $data = $this->all()->where('user_id', Auth::id())->groupBy(function ($item){
                return $item->created_at->format('d-M-y');
            }
        )->map( function ($rowByDate){
            return $rowByDate->sum('total_amount');
        })->toArray();


        return $data;

    }

    protected function totalSalesProductWise()
    {

        return $this->queryForProductwiseData('total_amount');
    }

    protected function CountByProduct(){


        return $this->queryForProductwiseData('quantity');
    }

    protected function queryForProductwiseData($column){

        $callbackForMap = function($rowByData) use($column){
            return $rowByData->sum($column);
        };

        $data = $this->all()->where('user_id', Auth::id())->groupBy('menu_id')->map( $callbackForMap )->toArray();

        $result = [];
        $menu = new Menu();

        foreach ($data as $key => $value){
            $itemName = $menu->all()->get($key-1)['item'];
            $result[$itemName]=$value;
        }

        return $result;
    }


    public function createLineGraph(){

        $data = $this->totalSalesEachDay();
        $chart = new Graph();
        $chart->labels(array_keys($data));
        $chart->dataset('Total Sales Per Day', 'line', array_values($data))
            ->color('#FF1493')
            ->backgroundColor('#AED6F1');
        $chart->displayLegend(false);
//        $chart->title('Total Sales Per Day', 40 , '#333',true);

        return $chart;

    }

    public function createPieGraph(){

        $data = $this->totalSalesProductWise();
        $chart = new Graph();
        $chart->labels(array_keys($data));
        $chart->dataset(' ', 'pie', array_values($data))
            ->backgroundColor(['#2E4053','#E74C3C',"#52BE80","#3498DB"]);
        $chart->displayLegend(true);
//        $chart->title('Total Sales Per Day', 40 , '#333',true);

        return $chart;
    }

    public function createBarGraph(){

        $data = $this->CountByProduct();
        $chart = new Graph();
        $chart->labels(array_keys($data));
        $chart->dataset(' ', 'bar', array_values($data))
            ->color('#fff')
            ->backgroundColor(['#2E4053','#E74C3C',"#52BE80","#3498DB"]);
        $chart->displayLegend(false);
//        $chart->title('Total Sales Per Day', 40 , '#333',true);

        return $chart;

    }

    public static function bootOrders(){

        if(Order::all()->count()){
            return ;
        }

        $jsonData = '[{"id":1,"menu_id":2,"quantity":4,"user_id":1,"total_amount":8,"created_at":"2019-02-08 09:56:03","updated_at":"2019-02-08 09:56:03"},{"id":2,"menu_id":4,"quantity":6,"user_id":1,"total_amount":24,"created_at":"2019-02-08 09:58:36","updated_at":"2019-02-08 09:58:36"},{"id":3,"menu_id":2,"quantity":4,"user_id":2,"total_amount":8,"created_at":"2019-02-08 11:33:12","updated_at":"2019-02-08 11:33:12"},{"id":4,"menu_id":4,"quantity":67,"user_id":2,"total_amount":268,"created_at":"2019-02-08 11:33:18","updated_at":"2019-02-08 11:33:18"},{"id":5,"menu_id":1,"quantity":62,"user_id":2,"total_amount":62,"created_at":"2019-02-08 11:33:25","updated_at":"2019-02-08 11:33:25"},{"id":6,"menu_id":4,"quantity":78,"user_id":2,"total_amount":312,"created_at":"2019-02-08 11:33:31","updated_at":"2019-02-08 11:33:31"},{"id":7,"menu_id":2,"quantity":14,"user_id":2,"total_amount":28,"created_at":"2019-02-08 11:33:39","updated_at":"2019-02-08 11:33:39"},{"id":8,"menu_id":3,"quantity":45,"user_id":2,"total_amount":135,"created_at":"2019-02-08 11:33:45","updated_at":"2019-02-08 11:33:45"},{"id":9,"menu_id":3,"quantity":83,"user_id":3,"total_amount":249,"created_at":"2019-02-08 11:34:35","updated_at":"2019-02-08 11:34:35"},{"id":10,"menu_id":1,"quantity":43,"user_id":3,"total_amount":43,"created_at":"2019-02-08 11:34:42","updated_at":"2019-02-08 11:34:42"},{"id":11,"menu_id":1,"quantity":94,"user_id":3,"total_amount":94,"created_at":"2019-02-08 11:34:51","updated_at":"2019-02-08 11:34:51"},{"id":12,"menu_id":4,"quantity":38,"user_id":3,"total_amount":152,"created_at":"2019-02-08 11:34:57","updated_at":"2019-02-08 11:34:57"},{"id":13,"menu_id":1,"quantity":93,"user_id":3,"total_amount":93,"created_at":"2019-02-08 11:35:05","updated_at":"2019-02-08 11:35:05"},{"id":14,"menu_id":3,"quantity":46,"user_id":3,"total_amount":138,"created_at":"2019-02-08 11:35:13","updated_at":"2019-02-08 11:35:13"},{"id":15,"menu_id":2,"quantity":4,"user_id":1,"total_amount":8,"created_at":"2019-02-08 13:49:40","updated_at":"2019-02-08 13:49:40"},{"id":16,"menu_id":2,"quantity":8,"user_id":1,"total_amount":16,"created_at":"2019-02-08 15:08:05","updated_at":"2019-02-08 15:08:05"},{"id":17,"menu_id":4,"quantity":55,"user_id":2,"total_amount":220,"created_at":"2019-02-09 03:22:21","updated_at":"2019-02-09 03:22:21"},{"id":18,"menu_id":2,"quantity":43,"user_id":2,"total_amount":86,"created_at":"2019-02-09 03:22:30","updated_at":"2019-02-09 03:22:30"},{"id":19,"menu_id":4,"quantity":32,"user_id":2,"total_amount":128,"created_at":"2019-02-09 03:22:42","updated_at":"2019-02-09 03:22:42"},{"id":20,"menu_id":1,"quantity":67,"user_id":2,"total_amount":67,"created_at":"2019-02-09 03:22:50","updated_at":"2019-02-09 03:22:50"},{"id":21,"menu_id":3,"quantity":45,"user_id":1,"total_amount":135,"created_at":"2019-02-09 08:10:21","updated_at":"2019-02-09 08:10:21"},{"id":22,"menu_id":1,"quantity":67,"user_id":3,"total_amount":67,"created_at":"2019-02-09 10:03:28","updated_at":"2019-02-09 10:03:28"},{"id":23,"menu_id":4,"quantity":78,"user_id":3,"total_amount":312,"created_at":"2019-02-09 10:03:33","updated_at":"2019-02-09 10:03:33"},{"id":24,"menu_id":2,"quantity":75,"user_id":3,"total_amount":150,"created_at":"2019-02-09 10:03:40","updated_at":"2019-02-09 10:03:40"}]';
        $arrayOfData = json_decode($jsonData, true);

        foreach ($arrayOfData as $data){

            Order::create([
                'id' => $data['id'],
                'menu_id' => $data['menu_id'],
                'quantity' => $data['quantity'],
                'user_id' => $data['user_id'],
                'total_amount' => $data['total_amount'],
                'created_at' => strtotime($data['created_at']),
                'updated_at' => strtotime($data['updated_at'])
            ]);
        }

    }

}