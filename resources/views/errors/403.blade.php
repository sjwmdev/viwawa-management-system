@extends('backend.layout.master')

@section('content')
    <div class="error-page">
        <h2 class="headline text-danger">403</h2>

        <div class="error-content">
            <h3><i class="fas fa-ban text-danger"></i> Forbidden Access</h3>
            <p class="mt-4">
                You do not have the right permissions to access this page.
                If you believe this is an error, please contact the administrator.
            </p>
        </div>
    </div>
@endsection
