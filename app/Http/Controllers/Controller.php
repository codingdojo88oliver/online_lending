<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getBalance($user)
    {
        $lent_amount = 0;

        foreach($user->lender->histories as $history) {
            $lent_amount += $history->amount;
        }

        return $user->lender->money - $lent_amount;
    }
}
