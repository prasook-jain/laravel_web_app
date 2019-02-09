<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $guarded = [];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public static function bootData(){

        if(self::all()->count())
            return;
        static $items = [
            [ 'item' => 'Tea', 'price' => 10 ],
            [ 'item' => 'Coffee', 'price' => 10 ],
            [ 'item' => 'Samosa', 'price' => 15 ],
            [ 'item' => 'Cake', 'price' => 15 ]
        ];

        foreach ($items as $item){
            Menu::create($item);
        }

    }
}
