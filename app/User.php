<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function order(){
        return $this->hasMany(Order::class);
    }

    public static function bootUsers(){

        if( User::all()->count() ){
            return ;
        }

        $users = [
            [
                'name' => 'Ram',
                'email' => 'ram@italent.com',
                'password' => 'HelloWorld'
            ], [
                'name' => 'Shyam',
                'email' => 'shyam@italent.com',
                'password' => 'HelloWorld'
            ], [
                'name' => 'Ghanshyam',
                'email' => 'ghanshyam@italent.com',
                'password' => 'HelloWorld'
            ]
        ];

        foreach ( $users as $user){
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }




}
