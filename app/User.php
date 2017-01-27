<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Lender;
use App\Borrower;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function lender()
    {
        return $this->hasOne(Lender::class);
    }

    public function borrower()
    {
        return $this->hasOne(Borrower::class);
    }

    public function getFullNameAttribute() {
        return ucwords($this->first_name) . ' ' . ucwords($this->last_name);
    }
}
