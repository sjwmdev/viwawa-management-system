@extends('backend.layout.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap" style="background-color: var(--matisse); color: white;">
                <h4 class="my-1">Ongeza Mchango wa Mwezi</h4>

                @can('admin.monthly.contributions.index')
                    <div class="btn-group btn-group-md ml-auto" role="group">
                        <a href="{{ route('admin.monthly.contributions.index') }}" class="btn btn-outline-light"
                            title="Rudi kwenye orodha">
                            <i class="fas fa-w fa-th-list" aria-hidden="true"></i>
                        </a>
                    </div>
                @endcan

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        @if (isset($goalAmount))
                            <div class="alert alert-light text-dark k-lengo">
                                Kiasi cha Lengo: {{ number_format($goalAmount, 2) }}
                            </div>
                        @endif
                    </div>
                </div>

                <form action="{{ route('admin.contributions.store') }}" method="POST">
                    @csrf

                    @include('backend.admin.viwawa.contributions.monthly.form')

                    @can('admin.contributions.store')
                        <div class="mt-4">
                            <button type="submit" class="btn btn-block btn-primary">Hifadhi Mchango</button>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endsection
