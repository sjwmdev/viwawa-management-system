@extends('backend.layout.master')

@section('meta')
    <meta name="report-title"
        content="Taarifa ya Mchango wa Ujenzi wa Kanisa familia ya {{ $churchContribution->family_name }}">
@endsection

<!-- All css -->
@include('backend.components.index.allcss')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: var(--matisse); color: white;">
                <h5 class="my-1">Mchango wa Ujenzi wa Kanisa familia ya: {{ $churchContribution->family_name }}</h5>

                <div class="btn-group btn-group-md ml-auto" role="group">
                    @can('admin.church.contributions.create')
                        <a href="{{ route($routeBaseUrl . '.create', ['fmid' => $churchContribution->id]) }}"
                            class="btn btn-outline-light">
                            <i class="fa fa-plus-circle"></i> Ongeza Mchango
                        </a>
                    @endcan
                    @can('admin.church.contributions.index')
                        <a href="{{ route('admin.church.contributions.index') }}" class="btn btn-outline-light"
                            title="Rudi kwenye orodha">
                            <i class="fas fa-fw fa-th-list" aria-hidden="true"></i>
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <!-- Display Family Details -->
                <div class="mb-4">
                    <table class="table table-hover">
                        <tr>
                            <th>Jina la Familia</th>
                            <td>{{ $churchContribution->family_name }}</td>
                        </tr>
                        <tr>
                            <th>Kiasi Kilichochangwa</th>
                            <td>{{ number_format($churchContribution->amount, 2) }} TZS</td>
                        </tr>
                        <tr>
                            <th>Maelezo</th>
                            <td>{{ $churchContribution->description ?? 'Hakuna Maelezo' }}</td>
                        </tr>
                        <tr>
                            <th>Tarehe ya Mchango</th>
                            <td>{{ \Carbon\Carbon::parse($churchContribution->contribution_date)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Mwezi</th>
                            <td>{{ \Carbon\Carbon::create()->month($churchContribution->month)->translatedFormat('F') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Mwaka</th>
                            <td>{{ $churchContribution->year }}</td>
                        </tr>
                        <tr>
                            <th>Hali ya Mchango</th>
                            <td>
                                <span
                                    class="badge {{ $churchContribution->status == 'paid' ? 'badge-success p-2' : ($churchContribution->status == 'ahadi' ? 'badge-info p-2' : 'badge-warning p-2') }}">
                                    {{ $churchContribution->status == 'paid' ? 'Imelipwa' : ($churchContribution->status == 'ahadi' ? 'Ahadi' : 'Haijalipwa') }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>

                <hr>

                <!-- Contributions Table -->
                <div class="table-responsive mt-4">
                    <!-- Filter by year -->
                    <div class="d-flex justify-content-end mb-3">
                        <form method="GET" action="{{ route($routeBaseUrl . '.show', $churchContribution->id) }}"
                            class="form-inline">
                            <label for="year" class="mr-2">Chagua Mwaka:</label>
                            <select name="year" id="year" class="form-control" onchange="this.form.submit()">
                                <option value="">Mwaka</option>
                                @foreach ($years as $availableYear)
                                    <option value="{{ $availableYear }}" {{ $year == $availableYear ? 'selected' : '' }}>
                                        {{ $availableYear }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mwezi</th>
                                <th>Kiasi Kilichochangwa (TZS)</th>
                                <th>Hali</th>
                                <th>Tarehe ya Mchango</th>
                                <th class="table-td-md not-printable">Vitendo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contributionsByMonth as $month => $contributions)
                                @foreach ($contributions as $contribution)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}</td>
                                        <td>{{ number_format($contribution->amount, 2) }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $contribution->status == 'paid' ? 'badge-success' : ($contribution->status == 'ahadi' ? 'badge-info' : 'badge-warning') }}">
                                                {{ $contribution->status == 'paid' ? 'Imelipwa' : ($contribution->status == 'ahadi' ? 'Ahadi' : 'Haijalipwa') }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($contribution->contribution_date)->format('d M Y') }}
                                        </td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route($routeBaseUrl . '.edit', $contribution->id) }}"
                                                class="btn btn-sm btn-outline-secondary" title="Hariri">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <!-- Delete Button with Modal Confirmation -->
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                data-toggle="modal" data-target="#deleteModal{{ $contribution->id }}"
                                                title="Futa">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <!-- Modal for confirmation before deletion -->
                                            <div class="modal fade" id="deleteModal{{ $contribution->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Thibitisha Kufuta
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">Je, una uhakika unataka kufuta
                                                            mchango huu?</div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Ghairi</button>
                                                            <form
                                                                action="{{ route($routeBaseUrl . '.destroy', $contribution->id) }}"
                                                                method="POST">
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
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Jumla ya Kiasi:</th>
                                <th>{{ number_format($totalAmount, 2) }} TZS</th>
                                <th colspan="3"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- All show js -->
@include('backend.components.show.alljs')
