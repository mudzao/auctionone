@extends('layouts.app')

@section('js_after')
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <example-component></example-component>
@endsection
