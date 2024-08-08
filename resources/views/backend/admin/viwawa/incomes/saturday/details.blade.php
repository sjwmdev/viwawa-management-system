@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('meta')
    <meta name="report-title" content="Ripoti ya Mapato ya Jumamosi Mwezi">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="my-1 float-left">Mapato ya Jumamosi Mwezi,
                    {{ \Carbon\Carbon::create()->month($month)->format('F') }} {{ $year }}</h4>
                @can('admin.incomes.saturday')
                    <a href="{{ route('admin.incomes.saturday') }}" class="btn btn-outline-light float-right">Rudi kwenye
                        Orodha</a>
                @endcan
            </div>
            <div class="card-body">
                @if ($incomes->isEmpty())
                    <!-- No Income Records Message -->
                    <div class="alert alert-light text-danger alert-md" role="alert">
                        Hakuna michango iliyorekodiwa kwa mwezi huu.
                    </div>
                @else
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tarehe</th>
                                <th>Kiasi (TZS)</th>
                                <th>Maelezo</th>
                                <th class="not-printable">Vitendo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomes as $income)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($income->date)->format('d M Y') }}</td>
                                    <td>{{ number_format($income->amount, 2) }}</td>
                                    <td>{{ ucfirst($income->description) }}</td>
                                    <td>
                                        @can('admin.incomes.update')
                                            <button class="btn btn-outline-secondary edit-btn" data-toggle="modal"
                                                data-target="#editIncomeModal-{{ $income->id }}">
                                                Hariri
                                            </button>
                                        @endcan
                                    </td>
                                </tr>

                                @can('admin.incomes.update')
                                    <!-- Edit Income Modal -->
                                    <div class="modal fade" id="editIncomeModal-{{ $income->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editIncomeModalLabel-{{ $income->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editIncomeModalLabel-{{ $income->id }}">Hariri
                                                        Mapato</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{ route('admin.incomes.update', $income->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="edit-amount-{{ $income->id }}">Kiasi (TZS)</label>
                                                            <input type="number" name="amount"
                                                                id="edit-amount-{{ $income->id }}" class="form-control"
                                                                value="{{ $income->amount }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-date-{{ $income->id }}">Tarehe ya Mapato</label>
                                                            <input type="date" name="date"
                                                                id="edit-date-{{ $income->id }}" class="form-control"
                                                                value="{{ \Carbon\Carbon::parse($income->date)->format('Y-m-d') }}"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-description-{{ $income->id }}">Maelezo</label>
                                                            <textarea name="description" id="edit-description-{{ $income->id }}" class="form-control" rows="3">{{ $income->description }}</textarea>
                                                        </div>
                                                        <input type="hidden" name="type" value="sadaka ya jumamosi">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Funga</button>
                                                        <button type="submit" class="btn btn-primary">Hifadhi
                                                            Mabadiliko</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            @endforeach
                            <tr>
                                <td class="text-right"><strong>Jumla:</strong></td>
                                <td class="total-amount"><strong>{{ number_format($incomes->sum('amount'), 2) }}
                                        TZS</strong></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

@endsection

<!-- All js -->
@include('backend.components.index.alljs')

<!-- Custom css -->
@section('css')
    <style>
        .table th,
        .table td {
            vertical-align: middle;
        }

        .total-amount {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
        }

        .edit-btn {
            margin-left: 10px;
        }
    </style>
@endsection
