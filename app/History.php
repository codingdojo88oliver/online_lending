<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lender;
use App\Borrower;

class History extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'borrower_id', 'lender_id', 'amount',
  ];

  public function lender() {
      return $this->belongsTo(Lender::class);
  }

  public function borrower() {
      return $this->belongsTo(Borrower::class);
  }

  public function scopeLenders($query, $user = null)
  {
      if($user == null) {

      } else {
          return $query->where('borrower_id', $user->borrower->id)
              ->with('lender')
              ->groupBy('lender_id')
              ->selectRaw('*, sum(amount) as amount_lent');
      }
  }

  public function scopeBorrowers($query, $user)
  {
      return $query->where('lender_id', $user->lender->id)
          ->with(['borrower'])
          ->groupBy('borrower_id')
          ->selectRaw('*, sum(amount) as amount_lent');
  }
}
