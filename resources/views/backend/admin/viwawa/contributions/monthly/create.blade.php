@extends('backend.layout.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header" style="background-color: var(--matisse); color: white;">
                <h4 class="my-1 float-left">Ongeza Mchango wa Mwezi</h4>
                
                @can('admin.monthly.contributions.index')
                    <div class="btn-group btn-group-md float-right" role="group">
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
