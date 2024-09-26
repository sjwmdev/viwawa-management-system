@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('meta')
    <meta name="report-title" content="Michango ya Ujenzi wa Kanisa">
@endsection

@section('content')
<div class="container-fluid mt-2">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap" style="background-color: var(--matisse); color: white;">
            <h4 class="my-1">Michango ya Ujenzi wa Kanisa - {{ $year }}</h4>

            <div class="btn-group btn-group-md ml-auto" role="group">
                @can('admin.church.contributions.index')
                    <!-- Year Dropdown -->
                    <form method="GET" action="{{ route('admin.church.contributions.index') }}" class="form-inline mr-2">
                        <select name="year" class="form-control" onchange="this.form.submit()">
                            <option value="">Mwaka</option>
                            @foreach($years as $y)
                                <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </form>
                @endcan
                @can('admin.church.contributions.create')
                    <!-- Ongeza Mchango Button -->
                    <a href="{{ route('admin.church.contributions.create') }}" class="btn btn-light">
                        <i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Ongeza Mchango
                    </a>
                @endcan
                <a href="{{ route('frontend.church.contributions.index') }}" class="btn btn-light" title="Tazama michango">
                    <i class="fas fa-fw fa-home" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <!-- Month Filter -->
        <div class="card-body">
            @can('admin.church.contributions.index')
                <div class="d-flex flex-wrap justify-content-end mb-4">
                    <div class="btn-group btn-group-sm d-flex flex-wrap">
                        @foreach($months as $index => $monthName)
                            <a href="{{ route('admin.church.contributions.index', ['year' => $year, 'month' => str_pad($index + 1, 2, '0', STR_PAD_LEFT)]) }}"
                            class="btn btn-sm flex-fill {{ request('month') == str_pad($index + 1, 2, '0', STR_PAD_LEFT) ? 'btn-primary' : 'btn-outline-secondary' }}">
                            {{ $monthName }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endcan

            <!-- Contributions Table -->
            <div class="table-responsive">
                <table class="table table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Jina la Familia</th>
                            <th>Kiasi (TZS)</th>
                            <th>{{$month != null ? 'Tarehe'  : 'Mwezi'}}</th>
                            <th class="table-td-md not-printable">Hali</th>
                            <th class="table-td-md not-printable text-center">Vitendo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contributions as $contribution)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contribution->family_name }}</td>
                            <td>{{ number_format($contribution->amount, 2) }}</td>
                            @if($month != null)
                                <td>{{ \Carbon\Carbon::parse($contribution->contribution_date)->format('d M Y') }}</td>
                            @else
                                <td>{{ \Carbon\Carbon::create()->month($contribution->month)->format('M') }}</td>
                            @endif
                            <td>
                                <span class="badge {{ $contribution->status == 'paid' ? 'badge-success p-2' : 'badge-warning p-2' }}">
                                    {{ $contribution->status == 'paid' ? 'Imelipwa' : 'Haijalipwa' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <!-- Show, Edit, Delete Actions -->
                                <a href="{{ route('admin.church.contributions.show', $contribution->id) }}" class="btn btn-sm btn-outline-secondary" title="Tazama">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.church.contributions.edit', $contribution->id) }}" class="btn btn-sm btn-outline-secondary" title="Hariri">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <!-- Delete Button with Modal Confirmation -->
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#deleteModal{{ $contribution->id }}" title="Futa">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Modal for confirmation before deletion -->
                                <div class="modal fade" id="deleteModal{{ $contribution->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Thibitisha Kufuta</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">Je, una uhakika unataka kufuta mchango huu?</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ghairi</button>
                                                <form action="{{ route('admin.church.contributions.destroy', $contribution->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Futa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Modal -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" style="text-align:right">Jumla ya Kiasi (TZS):</th>
                            <th>{{ number_format($totalAmount, 2) }}</th>
                            <th colspan="3"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- All js -->
@include('backend.components.index.alljs')

<!-- Custom js -->
@section('js')
    <script>
        $(document).ready(function() {
            $('#year').change(function() {
                document.getElementById('year-form').submit();
            });
        });
    </script>
@endsection
