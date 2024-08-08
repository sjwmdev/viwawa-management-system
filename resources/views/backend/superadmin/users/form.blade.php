<!-- All form css -->
@include('backend.components.form.allcss')

@php
    $user = $user ?? new \App\Models\User;
@endphp

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="first_name" class="control-label">Jina la Kwanza&nbsp;<span style="color:red">*</span></label>
        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name ?? '') }}"
            placeholder="Jina la Kwanza" required>
        @if ($errors->has('first_name'))
            <span class="text-danger text-left">{{ $errors->first('first_name') }}</span>
        @endif
    </div>
    <div class="form-group col-md-4">
        <label for="middle_name" class="control-label">Jina la Kati (Hiari)</label>
        <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $user->middle_name ?? '') }}"
            placeholder="Jina la Kati">
        @if ($errors->has('middle_name'))
            <span class="text-danger text-left">{{ $errors->first('middle_name') }}</span>
        @endif
    </div>
    <div class="form-group col-md-4">
        <label for="last_name" class="control-label">Jina la Mwisho&nbsp;<span style="color:red">*</span></label>
        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name ?? '') }}"
            placeholder="Jina la Mwisho" required>
        @if ($errors->has('last_name'))
            <span class="text-danger text-left">{{ $errors->first('last_name') }}</span>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <label for="email" class="control-label">Barua Pepe (Hiari)</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" placeholder="Barua Pepe">
        @if ($errors->has('email'))
            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <label for="phone_number" class="control-label">Namba ya Simu (Hiari)</label>
        <div class="form-group d-flex align-items-center">
            <div class="input-group-prepend no-right-border">
                <span class="input-group-text">+255</span>
            </div>
            <input type="text" name="phone_number" class="form-control phone-input" value="{{ old('phone_number', $user->getPhoneNumberWithoutCountryCode() ?? '') }}"
                placeholder="Namba ya Simu" pattern="[0-9]{9}" title="Enter 9 digit phone number">
        </div>
        @if ($errors->has('phone_number'))
            <span class="text-danger text-left">{{ $errors->first('phone_number') }}</span>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <label class="control-label">Jukumu&nbsp;<span style="color:red">*</span> </label>
        <select name="role" id="role" class="form-control select2" required>
            <option value="">Chagua Jukumu</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ (old('role') ?? ($user->roles->first()->id ?? '')) == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('role'))
            <span class="text-danger text-left">{{ $errors->first('role') }}</span>
        @endif
    </div>
</div>

<!-- Action Buttons -->
<div class="form-group mt-4">
    <div class="row">
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary btn-block">{{ $buttonText ?? 'Ongeza Mtumiaji' }}</button>
        </div>
        @can('superadmin.users.index')
            <div class="col-md-2">
                <a href="{{ route('superadmin.users.index') }}" class="btn btn-default btn-block">Ghairi</a>
            </div>
        @endcan
    </div>
</div>

<!-- Custom css -->
@section('css')
    <style>
        .input-group-prepend.no-right-border .input-group-text {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-right: 0;
        }

        .phone-input {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            margin-left: -1px;
            /* Prevent double border */
        }
    </style>
@endsection

<!-- js -->
@section('js')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 Elements
            $('.select2').select2();
        });
    </script>
@endsection
