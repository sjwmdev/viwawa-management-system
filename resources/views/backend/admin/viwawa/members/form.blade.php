<!-- All form css -->
@include('backend.components.form.allcss')

<fieldset>
    <legend>Taarifa Binafsi</legend>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="first_name" class="control-label">Jina la Kwanza&nbsp;<span style="color:red">*</span></label>
            <input type="text" name="first_name" class="form-control"
                value="{{ old('first_name', $member->user->first_name ?? '') }}" placeholder="Jina la Kwanza" required>
            @if ($errors->has('first_name'))
                <span class="text-danger text-left">{{ $errors->first('first_name') }}</span>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label for="middle_name" class="control-label">Jina la Kati</label>
            <input type="text" name="middle_name" class="form-control"
                value="{{ old('middle_name', $member->user->middle_name ?? '') }}" placeholder="Jina la Kati">
            @if ($errors->has('middle_name'))
                <span class="text-danger text-left">{{ $errors->first('middle_name') }}</span>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label for="last_name" class="control-label">Jina la Mwisho&nbsp;<span style="color:red">*</span></label>
            <input type="text" name="last_name" class="form-control"
                value="{{ old('last_name', $member->user->last_name ?? '') }}" placeholder="Jina la Mwisho" required>
            @if ($errors->has('last_name'))
                <span class="text-danger text-left">{{ $errors->first('last_name') }}</span>
            @endif
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="family_status" class="control-label">Hali ya Ndoa&nbsp;<span style="color:red">*</span></label>
            <select name="family_status" class="form-control" required>
                <option value="">Chagua Hali ya Ndoa</option>
                <option value="single"
                    {{ old('family_status', $member->family_status ?? '') === 'single' ? 'selected' : '' }}>
                    Hajaoa/Hajaolewa</option>
                <option value="married"
                    {{ old('family_status', $member->family_status ?? '') === 'married' ? 'selected' : '' }}>
                    Ameoa/Ameolewa
                </option>
                <option value="divorced"
                    {{ old('family_status', $member->family_status ?? '') === 'divorced' ? 'selected' : '' }}>Talaka
                </option>
                <option value="widowed"
                    {{ old('family_status', $member->family_status ?? '') === 'widowed' ? 'selected' : '' }}>
                    Mjane/Mgane</option>
            </select>
            @if ($errors->has('family_status'))
                <span class="text-danger text-left">{{ $errors->first('family_status') }}</span>
            @endif
        </div>
    </div>

    <!-- Occupation Field -->
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="occupation" class="control-label">Kazi</label>
            <select name="occupation" class="form-control select2" required>
                <option value="">Chagua Kazi</option>
                <option value="Mwanafunzi"
                    {{ old('occupation', $member->occupation ?? '') === 'Mwanafunzi' ? 'selected' : '' }}>Mwanafunzi
                </option>
                <option value="Mfanyabiashara"
                    {{ old('occupation', $member->occupation ?? '') === 'Mfanyabiashara' ? 'selected' : '' }}>
                    Mfanyabiashara</option>
                <option value="Mkulima"
                    {{ old('occupation', $member->occupation ?? '') === 'Mkulima' ? 'selected' : '' }}>Mkulima</option>
                <option value="Mfanyakazi"
                    {{ old('occupation', $member->occupation ?? '') === 'Mfanyakazi' ? 'selected' : '' }}>Mfanyakazi
                </option>
                <!-- Add more occupations as needed -->
            </select>
            @if ($errors->has('occupation'))
                <span class="text-danger text-left">{{ $errors->first('occupation') }}</span>
            @endif
        </div>
    </div>
</fieldset>

<fieldset>
    <legend class="mt-2">Taarifa Zingine</legend>
    <div class="form-row mt-1">
        <div class="form-group col-md-6">
            <label for="gender" class="control-label">Jinsia&nbsp;<span style="color:red">*</span></label>
            <select name="gender" class="form-control" required>
                <option value="">Chagua Jinsia</option>
                <option value="male" {{ old('gender', $member->gender ?? '') === 'male' ? 'selected' : '' }}>Kiume
                </option>
                <option value="female" {{ old('gender', $member->gender ?? '') === 'female' ? 'selected' : '' }}>
                    Kike</option>
            </select>
            @if ($errors->has('gender'))
                <span class="text-danger text-left">{{ $errors->first('gender') }}</span>
            @endif
        </div>

        <div class="form-group col-md-6">
            <label for="email" class="control-label">Barua Pepe</label>
            <input type="email" name="email" class="form-control"
                value="{{ old('email', $member->user->email ?? '') }}" placeholder="Barua Pepe">
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>

    <div class="form-row mt-2">
        <!-- Residence Field -->
        <div class="form-group col-md-6">
            <label for="residence" class="control-label">Makazi&nbsp;<span style="color:red">*</span></label>
            <select name="residence" class="form-control select2" required>
                <option value="">Chagua Makazi</option>
                <option value="Kigamboni"
                    {{ old('residence', $member->residence ?? '') === 'Kigamboni' ? 'selected' : '' }}>Kigamboni
                </option>
                <option value="Ilala" {{ old('residence', $member->residence ?? '') === 'Ilala' ? 'selected' : '' }}>
                    Ilala</option>
                <option value="Kinondoni"
                    {{ old('residence', $member->residence ?? '') === 'Kinondoni' ? 'selected' : '' }}>Kinondoni
                </option>
                <option value="Temeke" {{ old('residence', $member->residence ?? '') === 'Temeke' ? 'selected' : '' }}>
                    Temeke</option>
                <option value="Ubungo" {{ old('residence', $member->residence ?? '') === 'Ubungo' ? 'selected' : '' }}>
                    Ubungo</option>
                <!-- Add more wards as needed -->
            </select>
            @if ($errors->has('residence'))
                <span class="text-danger text-left">{{ $errors->first('residence') }}</span>
            @endif
        </div>

        <div class="form-group col-md-6">
            <label for="phone_number" class="control-label">Namba ya Simu</label>
            <div class="form-group d-flex align-items-center">
                <div class="input-group-prepend no-right-border">
                    <span class="input-group-text">+255</span>
                </div>
                @if (Route::currentRouteName() == 'admin.members.create')
                    <input type="text" name="phone_number" class="form-control phone-input"
                        value="{{ old('phone_number') }}" placeholder="Namba ya Simu" pattern="[0-9]{9}"
                        title="Enter 9 digit phone number">
                @else
                    <input type="text" name="phone_number" class="form-control phone-input"
                        value="{{ $member->user->getPhoneNumberWithoutCountryCode() ?? '' }}"
                        placeholder="Namba ya Simu" pattern="[0-9]{9}" title="Enter 9 digit phone number">
                @endif
            </div>
            @if ($errors->has('phone_number'))
                <span class="text-danger text-left">{{ $errors->first('phone_number') }}</span>
            @endif
        </div>
    </div>


    <!-- Conditionally include presence_status field -->
    @if (Route::currentRouteName() == 'admin.members.edit')
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="presence_status" class="control-label">Hali ya Uwanachama</label>
                <select name="presence_status" class="form-control" required>
                    <option value="">Chagua Hali ya Uwepo</option>
                    <option value="active"
                        {{ old('presence_status', $member->presence_status ?? '') === 'active' ? 'selected' : '' }}>Hai
                    </option>
                    <option value="inactive"
                        {{ old('presence_status', $member->presence_status ?? '') === 'inactive' ? 'selected' : '' }}>
                        Si Hai</option>
                </select>
                @if ($errors->has('presence_status'))
                    <span class="text-danger text-left">{{ $errors->first('presence_status') }}</span>
                @endif
            </div>
        </div>
    @endif

</fieldset>

@can('admin.members.store')
    <!-- Action Buttons -->
    <div class="form-group mt-4">
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block">{{ $buttonText ?? 'Hifadhi' }}</button>
            </div>
        </div>
    </div>
@endcan

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
        $(function() {
            // Initialize Select2 Elements
            $('.select2').select2();
        });
    </script>
@endsection
