@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('meta')
    <meta name="report-title" content="Ripoti ya Balance ya Mfuko">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header">
                <h4 class="my-1 float-left">Balance ya Mfuko</h4>
                @can('admin.mfuko-balance.calculate')
                    <button id="calculateBalanceBtn" class="btn btn-light float-right calculate-btn">Pakua Salio</button>
                @endcan
            </div>
            <div class="card-body">
                @if ($balance)
                    <div class="row mb-4">
                        <div class="col-md-12 text-center">
                            <h2 class="display-4 font-weight-bold text-success">
                                {{ number_format($balance->total_balance, 2) }} TZS</h2>
                            <p class="text-muted">Tarehe ya Maingizo: {{ $balance->date->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                  <h4>Mapato na Matumizi</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th style="font-size: 1.25rem;">Kundi</th>
                                                <th style="font-size: 1.25rem;">Kiasi (TZS)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="td-fsize">Jumpla ya Mapato</td>
                                                <td class="text-success" class="td-fsize">+
                                                    {{ number_format($balance->income_balance, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-fsize">Jumla ya Michango ya Mwezi</td>
                                                <td class="text-success" class="td-fsize">+
                                                    {{ number_format($balance->contribution_balance, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-fsize">Jumla ya Matumizi</td>
                                                <td class="text-danger" class="td-fsize">-
                                                    {{ number_format($balance->expenditure_balance, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                <!-- No Mfuko Balance Records Message -->
                <div class="alert alert-light text-danger alert-md" role="alert">
                    Hakuna rekodi ya salio iliyopo.
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.getElementById('calculateBalanceBtn').addEventListener('click', function() {
            if (confirm('Je, una uhakika unataka kupakia salio?')) {
                fetch('{{ route('admin.mfuko-balance.calculate') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            sessionStorage.setItem('toastrMessage', data.message);
                            sessionStorage.setItem('toastrType', 'success');
                        } else {
                            sessionStorage.setItem('toastrMessage', data.message);
                            sessionStorage.setItem('toastrType', 'error');
                        }
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        sessionStorage.setItem('toastrMessage', 'Hitilafu ilitokea wakati wa kuhesabu salio.');
                        sessionStorage.setItem('toastrType', 'error');
                        location.reload();
                    });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var message = sessionStorage.getItem('toastrMessage');
            var type = sessionStorage.getItem('toastrType');

            if (message && type) {
                toastr[type](message);
                sessionStorage.removeItem('toastrMessage');
                sessionStorage.removeItem('toastrType');
            }
        });
    </script>
@endsection

<!-- Custom css -->
@section('css')
    <style>
        .td-fsize {
            font-size: 1.1rem;
        }
    </style>
@endsection

<!-- All js -->
@include('backend.components.index.alljs')
