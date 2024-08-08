@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('content')
    <div class="container-fluid">
        <div class="card mx-auto">
            <div class="card-header">
                <h4 class="my-1 float-left">Aina za Mapato</h4>
                @can('admin.incomes.type.store')
                    <div class="btn-group btn-group-md float-right" role="group">
                        <button type="button" class="btn btn-outline-light" title="Ongeza Aina Mpya" data-toggle="modal" data-target="#addIncomeTypeModal">
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
                            <th>Maelezo</th>
                            <th>Kitambulisho</th>
                            <th class="not-printable" width="10%">Vitendo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incomeTypes as $type)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->description }}</td>
                                <td>{{ $type->identifier }}</td>
                                <td>
                                    <button class="btn btn-outline-secondary btn-md" title="Hariri Aina" data-toggle="modal" data-target="#editIncomeTypeModal{{ $type->id }}">
                                        Hariri
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @can('admin.incomes.type.store')
        <!-- Add Income Type Modal -->
        <div class="modal fade" id="addIncomeTypeModal" tabindex="-1" role="dialog" aria-labelledby="addIncomeTypeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addIncomeTypeModalLabel">Ongeza Aina Mpya ya Mapato</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.incomes.type.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Jina la Aina</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Maelezo</label>
                                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
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

    @can('admin.incomes.type.update')
        <!-- Edit Income Type Modal -->
        @foreach ($incomeTypes as $type)
            <div class="modal fade" id="editIncomeTypeModal{{ $type->id }}" tabindex="-1" role="dialog" aria-labelledby="editIncomeTypeModalLabel{{ $type->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editIncomeTypeModalLabel{{ $type->id }}">Hariri Aina ya Mapato</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('admin.incomes.type.update', $type->id) }}">
                                @csrf
                                @method('PATCH')

                                <div class="form-group">
                                    <label for="name">Jina la Aina</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $type->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Maelezo</label>
                                    <textarea name="description" id="description" class="form-control" rows="3">{{ $type->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="identifier">Kitambulisho</label>
                                    <input type="text" name="identifier" id="identifier" class="form-control" value="{{ $type->identifier }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Hifadhi Mabadiliko</button>
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
