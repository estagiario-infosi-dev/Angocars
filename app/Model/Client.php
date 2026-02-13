<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    //
    use SoftDeletes;
    protected $fillable = [
        'name', 
        'email',
        'password', 
        'phone', 
        /* 'address', 
        'bi', 
        'bi_upload', 
        'driver_license', 
        'driver_license_upload' */
    ];
    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }
    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
