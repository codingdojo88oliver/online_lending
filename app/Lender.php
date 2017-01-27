<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\History;

class Lender extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'money',
  ];

  public function user() {
      return $this->belongsTo(User::class);
  }

  public function histories() {
      return $this->hasMany(History::class);
  }
}
