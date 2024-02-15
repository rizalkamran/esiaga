@csrf

<div class="row align-items-start mb-3">
    <div class="col-md-6">
        <div>
            <label for="name" class="form-label">Username</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                aria-describedby="name"
                value="{{ old('name') }}@isset($user){{ $user->name }}@endisset">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div>
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                aria-describedby="email"
                value="{{ old('email') }}@isset($user){{ $user->email }}@endisset">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="row align-items-start mb-3">
    <div class="col-md-6">
        <div>
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input name="nama_lengkap" type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap"
                aria-describedby="nama_lengkap"
                value="{{ old('nama_lengkap') }}@isset($user){{ $user->nama_lengkap }}@endisset">
            @error('nama_lengkap')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div>
            <label for="nomor_ktp" class="form-label">NIK</label>
            <input name="nomor_ktp" type="text" class="form-control @error('nomor_ktp') is-invalid @enderror" id="nomor_ktp"
                aria-describedby="nomor_ktp"
                value="{{ old('nomor_ktp') }}@isset($user){{ $user->nomor_ktp }}@endisset">
            @error('nomor_ktp')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="mb-3">
    <h6>Pilih Role</h6>
    @foreach ($roles as $role)
        <div class="form-check">
            <input class="form-check-input" name="roles[]"
                type="checkbox" value="{{ $role->id }}"
                id="{{ $role->name }}"
                @isset($user) @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif @endisset>
            <label class="form-check-label" for="{{ $role->name }}">
                {{ $role->name }}
            </label>
        </div>
    @endforeach
</div>


@isset($create)
    <div class="row align-items-start mb-3">
        <div class="col-md-6">
            <div>
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    id="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    id="password_confirmation">
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    </div>
@endisset


<button type="submit" class="btn btn-primary">Submit</button>
