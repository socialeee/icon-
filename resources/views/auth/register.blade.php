@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-5 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">ICON+</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                        id="name" placeholder="Masukkan nama">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}"
                                        id="nip" placeholder="Masukkan NIP">
                                    @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password"
                                        id="password" placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password_confirmation"
                                        id="password_confirmation" placeholder="Password Confirmation">
                                </div>
                                <div class="text-center">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="inlineRadio1" value="sales">
                                        <label class="form-check-label" for="inlineRadio1">Sales</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="inlineRadio2" value="activator">
                                        <label class="form-check-label" for="inlineRadio2">Activator</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="inlineRadio2" value="maintainer">
                                        <label class="form-check-label" for="inlineRadio2">Maintainer</label>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Daftar
                                </button>
                                <hr>
                                <div class="text-center">
                                    <a href="/login"> sudah punya akun? Login disini</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
