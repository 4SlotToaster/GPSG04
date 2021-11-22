<form method="POST" action="{{ route('appointment.create') }}" enctype="application/x-www-form-urlencoded">
    @csrf

    <div class="form-group row">
        <strong for="manager_id" class="col-md-4 col-form-label text-md-right">{{ __('Managers') }}</strong>

        <div class="col-md-6">
            <select id="manager_id" class="selectpicker @error('manager_id') is-invalid @enderror shadow" data-live-search="true" name="manager_id" required>
                @foreach($managers as $manager)
                    <option value="{{$manager->id}}">{{"{$manager->first_name} {$manager->prefix}"}}</option>
                @endforeach
            </select>

            @error('manager_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <strong for="visitor_id" class="col-md-4 col-form-label text-md-right">{{ __('Visitors') }}</strong>

        <div class="col-md-6">
            <select id="visitor_id" class="selectpicker @error('visitor_id') is-invalid @enderror shadow" data-live-search="true" name="visitor_id" required>
                @foreach($visitors as $visitor)
                    <option value="{{$visitor->id}}">{{"{$visitor->first_name} {$visitor->prefix}"}}</option>
                @endforeach
            </select>

            @error('visitor_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <strong for="starts_at" class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</strong>

        <div class="col-md-6">
            <input id="starts_at" class="form-control @error('starts_at') is-invalid @enderror shadow" type="datetime-local" name="starts_at" required>

            @error('starts_at')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <strong for="ends_at" class="col-md-4 col-form-label text-md-right">{{ __('End Time') }}</strong>

        <div class="col-md-6">
            <input id="ends_at" class="form-control @error('ends_at') is-invalid @enderror shadow" type="time" name="ends_at" required>

            @error('ends_at')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary btn-block shadow">
                {{ __('Create') }}
            </button>
        </div>
    </div>
</form>

<script>
    let date = document.getElementById('starts_at').addEventListener("input", function () {
        document.getElementById('ends_at').value = this.value.split('T')[1];
    })
</script>
