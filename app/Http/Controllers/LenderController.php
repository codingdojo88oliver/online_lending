<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lender;
use App\User;
use App\Borrower;
use App\History;

class LenderController extends Controller
{
  public function show($id)
  {
      $user = User::findOrFail($id);
      $balance = parent::getBalance($user);
      $all_borrowers = Borrower::all();
      $user_borrowers = History::borrowers($user)->get();

      return view('lender.profile', [
          'user' => $user,
          'all_borrowers' => $all_borrowers,
          'user_borrowers' => $user_borrowers,
          'balance' => $balance,
      ]);
  }
}
