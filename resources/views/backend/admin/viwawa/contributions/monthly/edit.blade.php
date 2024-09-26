@extends('backend.layout.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap" style="background-color: var(--matisse); color: white;">
                <h4 class="my-1">Hariri Mchango wa: {{ $contribution->member->user->full_name}}</h4>

                @can('admin.monthly.contributions.index')
                    <div class="btn-group btn-group-md ml-auto" role="group">
                        <a href="{{ route('admin.monthly.contributions.index') }}" class="btn btn-outline-light" title="Michango yote">
                         Rudi Kwenye Orodha
                        </a>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        @if (isset($goalAmount))
                            <div class="alert alert-light text-danger k-lengo">
                                Kiasi cha Lengo: {{ number_format($goalAmount, 2) }}
                            </div>
                        @endif
                    </div>
                </div>

                <form action="{{ route('admin.contributions.update', $contribution->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    @include('backend.admin.viwawa.contributions.monthly.form')

                    @can('admin.contributions.update')
                        <div class="mt-4">
                            <button type="submit" class="btn btn-block btn-primary">Sasisha Mchango</button>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endsection
