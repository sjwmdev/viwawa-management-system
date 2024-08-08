@extends('backend.layout.master')

@section('content')
    <div class="error-page">
        <h2 class="headline text-danger">419</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Page Expired</h3>
            <p class="mt-4">
                The page you requested has expired.
                Please refresh and try again.
            </p>
        </div>
    </div>
@endsection
