@extends('backend.layout.master')

@section('content')
    <div class="error-page">
        <h2 class="headline text-info">418</h2>

        <div class="error-content">
            <h3><i class="fas fa-coffee text-info"></i> I'm a Teapot</h3>
            <p class="mt-4">
                This server refuses to brew coffee because it is, permanently, a teapot.
            </p>
        </div>
    </div>
@endsection
