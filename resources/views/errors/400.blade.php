@extends('backend.layout.master')

@section('content')
    <div class="error-page">
        <h2 class="headline text-danger">400</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Bad Request</h3>
            <p class="mt-4">
                Your request was invalid.
                Please try again or contact the administrator.
            </p>
        </div>
    </div>
@endsection
