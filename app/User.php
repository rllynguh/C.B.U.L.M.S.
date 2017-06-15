<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table="tblUser";
    use Notifiable;
    protected $primaryKey="intUserCode";
    protected $dates = ['dtmDeletedAt'];
    public $timestamps = false;
    public static $storeRegister = [
    // 'strFirstName' => 'unique_with:users, strMidName, strLastName',
    'strMidName' => 'max:25',
    'strLastName' => 'required|max:25',
    'strCellNum' => 'required|max:15',
    'strPassword' => 'required|confirmed|max:61',
    //'strPicture' => 'image'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'strFirstName', 'strEmail', 'strPassword', 'strMidName',
    'strLastName', 'strCellNum', 'boolIsActive', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'strPassword', 'remember_token', 'boolIsActive'
    ];
}
