@extends('layouts.app')

@section('content')
<div class="container">
    <h1>404 - Page Not Found</h1>
    <p>Sorry, the page you are looking for could not be found.</p>
    <a href="{{ url('/') }}">Return to Home</a>
</div>
@endsection
