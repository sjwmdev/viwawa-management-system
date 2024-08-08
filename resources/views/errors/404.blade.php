@extends('backend.layout.master')

@section('content')
    <div class="error-page">
        <h2 class="headline text-warning">404</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
            <p class="mt-4">
                We could not find the page you were looking for. 
                Meanwhile, you may <a href="{{ route('common.dashboard') }}">return to dashboard</a>.
            </p>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
@endsection
