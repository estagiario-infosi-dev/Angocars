<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'password', 'role', 'password_confirmation'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function isFinancial()
    {
        return $this->role === 'financial';
    }
    public function isEmployee()
    {
        return $this->role === 'employee';
    }
}
