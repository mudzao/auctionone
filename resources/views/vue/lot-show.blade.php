@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Lot Info</div>
          <div class="card-body">
            <div class="row mb-4">
              <div class="col-md-6">
                <p>
                  Name: <span class="text-uppercase">{{ $lot->name }}</span>
                </p>
                <p>
                  Description: <span>{{ $lot->description }}</span>
                </p>
              </div>
              <div class="col-md-6">
                <p>Starting Price: RM {{ $lot->starting_price }}</p>
                <p>Step: RM {{ $lot->step }}</p>
              </div>
            </div>
            <a href="{{ route('lot.index') }}" class="btn btn-primary">Exit Bidding</a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Lot Info</div>
          <div class="card-body">
            <live-bid :lot='@json($lot)' :user="{{ auth()->user() }}"></live-bid>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
