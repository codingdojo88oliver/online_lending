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
                      Account Balance: <strong>{{ $balance }}</strong>
                    </address>

                    <h4>List of people who are in need of help</h4>
                    {!! session('status') !!}
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Money Needed For</th>
                          <th>Description</th>
                          <th>Amount Needed</th>
                          <th>Amount Raised</th>
                          <th class="{{ ($balance <= 0 ? 'hidden' : '') }}">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($all_borrowers as $borrower)
                          <tr>
                            <td>{{ $borrower->user->full_name }}</td>
                            <td>{{ ucwords($borrower->purpose) }}</td>
                            <td>{{ ucfirst($borrower->description) }}</td>
                            <td>{{ $borrower->money }}</td>
                            <td>{{ $borrower->raised }}</td>
                            <td class="{{ ($balance <= 0 ? 'hidden' : '') }}">
                              <form class="form-horizontal" role="form" method="POST" action="{{ url('/histories') }}">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="borrower_id" value="{{ $borrower->id }}">

                                  <div class="col-md-6">
                                      <input id="amount" type="number" class="form-control" min="0" name="amount" required>

                                      @if ($errors->has('amount'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('amount') }}</strong>
                                          </span>
                                      @endif
                                  </div>

                                  <div class="col-md-6">
                                      <button type="submit" class="btn btn-primary">
                                          Lend
                                      </button>
                                  </div>
                              </form>
                            </td>
                            <td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                    <h4>List of people you lent money to</h4>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Money Needed For</th>
                          <th>Description</th>
                          <th>Amount Needed</th>
                          <th>Amount Raised</th>
                          <th>Amount Lent</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($user_borrowers as $history)
                          <tr>
                            <td>{{ $history->borrower->user->full_name }}</td>
                            <td>{{ ucwords($history->borrower->purpose) }}</td>
                            <td>{{ ucfirst($history->borrower->description) }}</td>
                            <td>{{ $history->borrower->money }}</td>
                            <td>{{ $history->borrower->raised }}</td>
                            <td>{{ $history->amount_lent }}</td>
                            <td>
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
