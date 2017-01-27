<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\History;
use App\Borrower;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateHistoryRequest;

class HistoryController extends Controller
{
    public function store(CreateHistoryRequest $request)
    {
        $user = Auth::user();
        $balance = parent::getBalance($user);

        if($balance >= $request->amount && $request->amount > 0) {
            History::create([
                'lender_id' => $user->lender->id,
                'borrower_id' => $request->borrower_id,
                'amount'  => $request->amount,
            ]);

            $borrower = Borrower::find($request->borrower_id);
            $borrower->raised += $request->amount;
            $borrower->save();
        } else {
            $request->session()->flash('status', 'Insufficient Funds!');
        }

        return back();
    }
}
