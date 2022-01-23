@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Create Lot') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('lot.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="starting_price"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Starting Price') }}</label>

                                <div class="col-md-6">
                                    <input id="starting_price" type="number"
                                        class="form-control @error('starting_price') is-invalid @enderror"
                                        name="starting_price" value="{{ old('starting_price') }}" required
                                        autocomplete="email">

                                    @error('starting_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="starting_price"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Step') }}</label>

                                <div class="col-md-6">
                                    <input id="step" type="number"
                                        class="form-control @error('step') is-invalid @enderror"
                                        name="step" value="{{ old('step') }}" required
                                        autocomplete="email">

                                    @error('step')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create New Lot') }}
                                    </button> 
                                    <a href="{{ route('lot.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('More Info') }}</div>
                    <div class="card-body">
                        <p>More info how to create new lot is here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
