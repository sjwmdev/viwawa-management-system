<!-- All form css -->
@include('backend.components.form.allcss')

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="name" class="control-label">Jina&nbsp;<span style="color:red">*</span></label>
        <input type="text" name="name" class="form-control" aria-describedby="Name"
            value="{{ $role->name ?? old('name') }}" placeholder="Ingiza jina la jukumu" required>
    </div>
    <div class="form-group col-md-8 table-responsive p-0">
        <label for="permissions" class="control-label">Panga Ruhusa&nbsp;<span style="color:red">*</span></label>
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="5%"><input type="checkbox" name="all_permission"></th>
                        <th scope="col" width="60%">Jina</th>
                        <th scope="col" width="35%">Mlinzi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" name="permission[{{ $permission->name }}]"
                                    value="{{ $permission->name }}" class='permission'
                                    {{ isset($role) && $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                            </td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Vitufe vya Vitendo -->
<div class="form-group mt-2 d-flex justify-content-end">
    @if (Route::currentRouteName() == 'superadmin.roles.create')
        @can('superadmin.roles.store')
            <div class="col-md-2 ml-2">
                <button type="submit" class="btn btn-primary btn-block">Ongeza Rekodi</button>
            </div>
        @endcan
    @elseif(Route::currentRouteName() == 'superadmin.roles.edit')
        @can('superadmin.roles.update')
            <div class="col-md-2">
                <button type="submit" class="btn btn-info btn-block">Sasisha Rekodi</button>
            </div>
        @endcan
    @endif
    @can('superadmin.roles.index')
        <div class="col-md-2">
            <a href="{{ route('superadmin.roles.index') }}" class="btn btn-default btn-block">Ghairi</a>
        </div>
    @endcan
</div>

<!-- js -->
@section('js')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if ($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked', false);
                    });
                }

            });
        });
    </script>
@endsection
