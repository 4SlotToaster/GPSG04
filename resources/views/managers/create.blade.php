<form method="POST" action="{{ route('manager.create') }}" enctype="application/x-www-form-urlencoded">
    @csrf

    <div class="form-group row">
        <strong for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</strong>

        <div class="col-md-6">
            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror shadow" name="first_name" value="{{ old('first_name') }}" required>

            @error('first_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <strong for="prefix" class="col-md-4 col-form-label text-md-right">{{ __('Prefix') }}</strong>

        <div class="col-md-6">
            <input id="prefix" type="text" class="form-control @error('prefix') is-invalid @enderror shadow" name="prefix" value="{{ old('prefix') }}" required>

            @error('prefix')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <strong for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</strong>

        <div class="col-md-6">
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror shadow" name="last_name" value="{{ old('last_name') }}" required>

            @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <strong for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</strong>

        <div class="col-md-6">
            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror shadow" name="email" value="{{ old('email') }}" required>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary btn-block shadow">
                {{ __('Add') }}
            </button>
        </div>
    </div>
</form>
