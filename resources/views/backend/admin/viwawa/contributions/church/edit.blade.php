@extends('backend.layout.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap" style="background-color: var(--matisse); color: white;">
                <h4 class="my-1 float-left">Hariri Mchango wa Familia ya: {{ $churchContribution->family_name }}</h4>

                @can('admin.church.contributions.index')
                    <div class="btn-group btn-group-md ml-auto" role="group">
                        <a href="{{ route('admin.church.contributions.index') }}" class="btn btn-outline-light"
                            title="Rudi kwenye orodha">
                            <i class="fas fa-fw fa-th-list" aria-hidden="true"></i>
                        </a>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        @if (isset($goalAmount))
                            <div class="alert alert-light text-dark k-lengo">
                                kiwango cha chini: <b> {{ number_format($goalAmount, 2) }} TZS</b>
                            </div>
                        @endif
                    </div>
                </div>

                <form action="{{ route('admin.church.contributions.update', $churchContribution->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- Include the form partial -->
                    @include('backend.admin.viwawa.contributions.church.form')

                    @can('admin.church.contributions.update')
                        <div class="mt-4">
                            <button type="submit" class="btn btn-block btn-primary">Sasisha Mchango</button>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endsection
