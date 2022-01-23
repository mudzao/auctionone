@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('List of Lots') }}</div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Starting Price</th>
                                    <th>Current Bid</th>
                                    <th>Username</th>
                                    <th class="text-center">Bid</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lots as $key => $lot)
                                    <tr>
                                        <th>{{ ++$key }}</th>
                                        <td class="text-uppercase">{{ $lot->name }}</td>
                                        <td>RM {{ number_format($lot->starting_price, 2) }}</td>
                                        <td>RM {{ number_format($lot->HighestBid, 2) }}</td>
                                        <td>{{ $lot->user->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('lot.show', $lot) }}" class="btn btn-primary btn-sm">Enter Bidding</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <a href="{{ route('lot.create') }}" class="btn btn-primary">Create new lot</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
