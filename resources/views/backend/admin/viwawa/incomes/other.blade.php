@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('meta')
    <meta name="report-title" content="Ripoti ya Mapato Mengine">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="cardz" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header">
                <h3 class="my-1 float-left">Mapato Mengine</h3>
                @can('admin.incomes.store')
                    <div class="btn-group btn-group-md float-right" role="group">
                        <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#addOtherIncomeModal">
                            <i class="fas fa-plus-circle"></i> Ongeza Mapato
                        </button>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                @if ($incomes->isEmpty())
                    <!-- No Income Records Message -->
                    <div class="alert alert-light text-danger alert-md" role="alert">
                        Hakuna mapato yaliyorekodiwa.
                    </div>
                @else
                    @php
                        $groupedIncomes = $incomes->groupBy('year');
                    @endphp

                    @foreach ($groupedIncomes as $year => $yearIncomes)
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h4>Mwaka {{ $year }}</h4>
                            </div>
                            <div class="card-body">
                                @foreach ($yearIncomes as $income)
                                    @php
                                        $month = str_pad($income->month, 2, '0', STR_PAD_LEFT);
                                        $groupKey = "{$income->year}-{$month}";
                                    @endphp
                                    <h5 class="mt-3">{{ \Carbon\Carbon::create()->month($income->month)->format('F') }}
                                    </h5>
                                    <hr class="m-0 p-0">
                                    <table id="datatable" class="table table-condensed table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tarehe</th>
                                                <th>Kiasi (TZS)</th>
                                                <th>Maelezo</th>
                                                <th class="not-printable">Vitendo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($details[$groupKey]))
                                                @foreach ($details[$groupKey] as $detail)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($detail->date)->format('d M Y') }}</td>
                                                        <td>{{ number_format($detail->amount, 2) }} TZS</td>
                                                        <td>{{ $detail->description }}</td>
                                                        <td>
                                                            <button class="btn btn-outline-dark btn-md edit-btn"
                                                                data-toggle="modal"
                                                                data-target="#editIncomeModal{{ $detail->id }}">Hariri</button>
                                                        </td>
                                                    </tr>

                                                    @can('admin.incomes.update')
                                                        <!-- Edit Income Modal -->
                                                        <div class="modal fade" id="editIncomeModal{{ $detail->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="editIncomeModalLabel{{ $detail->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editIncomeModalLabel{{ $detail->id }}">Hariri
                                                                            Mapato</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form id="editIncomeForm{{ $detail->id }}"
                                                                        action="{{ route('admin.incomes.update', ['income' => $detail->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PATCH')

                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="amount{{ $detail->id }}">Kiasi
                                                                                            (TZS)
                                                                                        </label>
                                                                                        <input type="number" name="amount"
                                                                                            id="amount{{ $detail->id }}"
                                                                                            class="form-control"
                                                                                            value="{{ $detail->amount }}"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="date{{ $detail->id }}">Tarehe
                                                                                            ya Mapato</label>
                                                                                        <input type="date" name="date"
                                                                                            id="date{{ $detail->id }}"
                                                                                            class="form-control"
                                                                                            value="{{ \Carbon\Carbon::parse($detail->date)->format('Y-m-d') ?? '' }}"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="description{{ $detail->id }}">Maelezo
                                                                                    (Hiari)</label>
                                                                                <textarea name="description" id="description{{ $detail->id }}" class="form-control">{{ $detail->description }}</textarea>
                                                                            </div>
                                                                            <input type="hidden" name="income_type_id"
                                                                                value="{{ $detail->income_type_id }}">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Funga</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Hifadhi
                                                                                Mabadiliko</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endcan
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" class="text-center">Hakuna mapato kwa mwezi huu.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-right"><strong>Jumla ya Mwezi:</strong></td>
                                                <td colspan="3">
                                                    <strong>{{ number_format($details[$groupKey]->sum('amount'), 2) }}
                                                        TZS</strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    @can('admin.incomes.store')
        <!-- Add Other Income Modal -->
        <div class="modal fade" id="addOtherIncomeModal" tabindex="-1" role="dialog"
            aria-labelledby="addOtherIncomeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addOtherIncomeModalLabel">Ongeza Mapato Mengine</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.incomes.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount">Kiasi (TZS)</label>
                                        <input type="number" name="amount" id="amount" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Tarehe ya Mapato</label>
                                        <input type="date" name="date" id="date" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Maelezo (Hiari)</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                            <input type="hidden" name="income_type_id" value="{{ $incomeTypeId }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Funga</button>
                            <button type="submit" class="btn btn-primary">Hifadhi Mapato</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection
