@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Lot Info') }}</div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p>Name: <span class="text-uppercase">{{ $lot->name }}</span></p>
                                <p>Description: <span>{{ $lot->description }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p>Starting Price: RM {{ $lot->starting_price }}</p>
                                <p>Step: RM {{ $lot->step }}</p>
                                <p>Highest Bid: RM {{ $lot->HighestBid }}</p>
                            </div>
                        </div>
                        <a href="{{ route('lot.index') }}" class="btn btn-primary">Exit Bidding</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Live Bidding') }}</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lot->bids as $key => $bid)
                                    <tr>
                                        <th>{{ ++$key }}</th>
                                        <td>{{ $bid->user->name }}</td>
                                        <td>RM {{ number_format($bid->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form method="POST" action="{{ route('bid.new',$lot) }}">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror"
                                        name="price" value="{{ $lot->HighestBid + $lot->step }}" required autofocus placeholder="Specify amount">

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Place a Bid') }}
                                    </button> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
