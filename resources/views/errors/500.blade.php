@extends('backend.layout.master')

@section('content')
    <div class="error-page">
        <h2 class="headline text-danger">500</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Internal Server Error</h3>
            <p class="mt-4">
                An unexpected error occurred on the server.
                Please try again later or contact the administrator.
            </p>`
        </div>
    </div>
@endsection
