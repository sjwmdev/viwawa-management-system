<!-- All form css -->
@include('backend.components.form.allcss')

<div class="form-row">
    <div class="form-group col-md-12">
        @if (Route::currentRouteName() == 'superadmin.permissions.create')
            <label for="name" class="control-label">Jina la Njia&nbsp;<span style="color:red">*</span></label>
            <div class="select2-dark">
                <select name="name[]" class="select2" id="name" multiple="multiple" data-placeholder="Jina"
                    data-dropdown-css-class="select2-dark" style="width: 100%;"
                    {{ count($routeNames) == 0 ? 'disabled' : '' }}>
                    @foreach ($routeNames as $routeName)
                        <option value="{{ $routeName }}">{{ $routeName }}</option>
                    @endforeach
                </select>
            </div>
        @else
            <label for="name" class="control-label">Jina&nbsp;<span style="color:red">*</span></label>
            <input type="text" name="name" class="form-control" aria-describedby="Name"
                value="{{ $permission->name ?? old('name') }}" required>
        @endif
        @if ($errors->has('name'))
            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
        @endif
    </div>
</div>

<!-- Vitufe vya Vitendo -->
<div class="form-group mt-4 d-flex justify-content-between">
    @if (Route::currentRouteName() == 'superadmin.permissions.create')
        @can('superadmin.permissions.store')
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-block" {{ count($routeNames) == 0 ? 'disabled' : '' }}>Ongeza
                    Rekodi</button>
            </div>
        @endcan
    @elseif(Route::currentRouteName() == 'superadmin.permissions.edit')
        @can('superadmin.permissions.update')
            <div class="col-md-2">
                <button type="submit" class="btn btn-info btn-block">Sasisha Rekodi</button>
            </div>
        @endcan
    @endif
    @can('superadmin.permissions.index')
        <div class="col-md-2">
            <a href="{{ route('superadmin.permissions.index') }}" class="btn btn-default btn-block">Ghairi</a>
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
@endsection
