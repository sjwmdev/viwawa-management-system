 <div class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Jina la Kwanza" required>
                    <label for="first_name">Jina la Kwanza</label>
                    @error('first_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" placeholder="Jina la Kati">
                    <label for="middle_name">Jina la Kati</label>
                    @error('middle_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Jina la Mwisho" required>
                    <label for="last_name">Jina la Mwisho</label>
                    @error('last_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Barua Pepe" required>
                    <label for="email">Barua Pepe</label>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="Namba ya Simu" required>
                    <label for="phone_number">Namba ya Simu</label>
                    @error('phone_number')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Nenosiri" required>
                    <label for="password">Nenosiri</label>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Thibitisha Nenosiri" required>
                    <label for="password_confirmation">Thibitisha Nenosiri</label>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-login btn-block">Jisajili</button>
</form>
