@extends('backend.layout.master')

@section('content')
    <div class="error-page">
        <h2 class="headline text-danger">405</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Method Not Allowed</h3>
            <p class="mt-4">
                The requested method is not allowed for this resource.
                Please try a different method or contact the administrator.
            </p>
        </div>
    </div>
@endsection
