<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\History;

class BorrowerController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $lenders = History::lenders($user)->get();
        return view('borrower.profile', ['user' => $user, 'lenders' => $lenders]);
    }
}
