@extends('backend.layout.master')

@section('content')
    <div class="error-page">
        <h2 class="headline text-danger">503</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Service Unavailable</h3>
            <p class="mt-4">
                The server is currently unavailable. Please try again later.
            </p>
        </div>
    </div>
@endsection
