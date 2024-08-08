<div class="mt-4 mb-4">
    <div class="form-floating" id="phone-field">
        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder=" " required>
        <label for="phone_number">Namba ya Simu</label>
        @error('phone_number')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    
    <div class="form-floating position-relative">
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder=" " required>
        <label for="password">Nenosiri</label>
        <div class="input-group-text" id="togglePassword">
            <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
        </div>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group mb-3 mt-4">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="remember" value="1" checked>
        <label class="custom-control-label" for="remember">Nikumbuke</label>
    </div>
</div>

<button type="submit" class="btn btn-login btn-block">Ingia</button>
