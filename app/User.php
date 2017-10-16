<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $dates = ['dtmDeletedAt'];
    public $timestamps = false;
    // public static $storeRegister = [
    // // 'strFirstName' => 'unique_with:users, strMidName, strLastName',
    // 'strMidName' => 'max:25',
    // 'strLastName' => 'required|max:25',
    // 'strCellNum' => 'required|max:15',
    // 'strPassword' => 'required|confirmed|max:61',
    // //'strPicture' => 'image'
    // ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password', 'middle_name',
        'last_name', 'cell_num', 'is_active','last_log_at' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'is_active'
    ];
}
