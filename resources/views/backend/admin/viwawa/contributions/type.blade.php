@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('content')
    <div class="container-fluid">
        <div class="card mx-auto">
            <div class="card-header">
                <h4 class="my-1 float-left">Aina za Michango</h4>
                @can('admin.contributions.type.store')
                    <div class="btn-group btn-group-md float-right" role="group">
                        <button class="btn btn-outline-light" title="Ongeza Aina ya Michango" data-toggle="modal" data-target="#addContributionTypeModal">
                            <i class="fas fa-fw fa-plus-circle" aria-hidden="true"></i>
                            Ongeza Aina Mpya
                        </button>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">Namba.</th>
                            <th>Jina</th>
                            <th>Malengo</th>
                            <th>Kiasi cha Malengo</th>
                            <th>Kitambulisho</th>
                            <th class="not-printable" width="10%">Vitendo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contributionTypes as $type)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->goal ?? 'Hakuna' }}</td>
                                <td>{{ number_format($type->goal_amount, 2) ?? '0.00' }}</td>
                                <td>{{ $type->identifier }}</td>
                                <td>
                                    @can('admin.contributions.type.update')
                                        <button class="btn btn-outline-secondary btn-md" title="Hariri Aina ya Michango"
                                            data-toggle="modal" data-target="#editContributionTypeModal{{ $type->id }}">
                                            Hariri
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @can('admin.contributions.type.store')
        <!-- Add Contribution Type Modal -->
        <div class="modal fade" id="addContributionTypeModal" tabindex="-1" role="dialog" aria-labelledby="addContributionTypeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addContributionTypeModalLabel">Ongeza Aina ya Michango</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.contributions.type.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Jina la Aina</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="goal">Malengo</label>
                                <textarea name="goal" id="goal" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="goal_amount">Kiasi cha Malengo (TZS)</label>
                                <input type="number" name="goal_amount" id="goal_amount" class="form-control" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="identifier">Kitambulisho</label>
                                <input type="text" name="identifier" id="identifier" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Ongeza Aina</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    @can('admin.contributions.type.update')
        @foreach ($contributionTypes as $type)
            <!-- Edit Contribution Type Modal -->
            <div class="modal fade" id="editContributionTypeModal{{ $type->id }}" tabindex="-1" role="dialog" aria-labelledby="editContributionTypeModalLabel{{ $type->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editContributionTypeModalLabel{{ $type->id }}">Hariri Aina ya Michango</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('admin.contributions.type.update', $type->id) }}">
                                @csrf
                                @method('PATCH')
                                
                                <div class="form-group">
                                    <label for="name">Jina la Aina</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $type->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="goal">Malengo</label>
                                    <textarea name="goal" id="goal" class="form-control">{{ $type->goal }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="goal_amount">Kiasi cha Malengo (TZS)</label>
                                    <input type="number" name="goal_amount" id="goal_amount" class="form-control" step="0.01" value="{{ $type->goal_amount }}">
                                </div>
                                <div class="form-group">
                                    <label for="identifier">Kitambulisho</label>
                                    <input type="text" name="identifier" id="identifier" class="form-control" value="{{ $type->identifier }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Hariri Aina</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endcan

@endsection

<!-- All js -->
@include('backend.components.index.alljs')
