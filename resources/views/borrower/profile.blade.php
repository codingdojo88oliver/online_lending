@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <address class="">
                      Name: <strong>{{ $user->full_name }}</strong><br>
                      Amount Needed: <strong>{{ $user->borrower->money }}</strong><br>
                      Amount Raised: <strong>{{ $user->borrower->raised }}</strong>
                    </address>

                    <h4>List of people who lent you money</h4>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Amount Lent</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($lenders as $history)
                          <tr>
                            <td>{{ $history->lender->user->full_name }}</td>
                            <td>{{ $history->lender->user->email }}</td>
                            <td>{{ $history->amount_lent }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
