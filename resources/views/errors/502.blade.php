@extends('backend.layout.master')

@section('content')
    <div class="error-page">
        <h2 class="headline text-danger">502</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Bad Gateway</h3>
            <p class="mt-4">
                The server received an invalid response from another server while trying to fulfill your request.
                Please try again later or contact the administrator.
            </p>
        </div>
    </div>
@endsection
