@extends('layouts.app')

@section('content')
@php
    $profile = \App\Models\BusinessProfile::first();
    $primary = $profile->primary_color ?? '#c62828';
    $secondary = $profile->secondary_color ?? '#0d6efd';
    $bg = $profile->background_color ?? '#0b0e16';
    $logo = $profile->logo_path ?? asset('images/logo.png');
@endphp
<style>
    body{background: {{ $bg }};}
    .login-card{border:none; box-shadow:0 30px 60px rgba(0,0,0,.35); border-radius:16px; overflow:hidden}
    .login-hero{background: linear-gradient(135deg, {{ $secondary }}, {{ $primary }}); color:#fff; position:relative}
    .login-hero:after{content:''; position:absolute; inset:0; background: radial-gradient(ellipse at 30% 20%, rgba(255,255,255,.15), transparent 60%);}    
    .login-logo{width:72px;height:72px;border-radius:50%;box-shadow:0 0 0 4px rgba(255,255,255,.25); object-fit:cover}
    .login-title{font-weight:700; letter-spacing:.3px}
    .login-btn{border:none; background: linear-gradient(45deg, {{ $secondary }}, {{ $primary }}); font-weight:700}
    .form-control{background:#0f1320; border-color:#1f2435; color:#e9edf7}
    .form-control::placeholder{color:#8b93a8}
    .form-control:focus{box-shadow:0 0 0 .2rem rgba(13,110,253,.25); border-color: {{ $secondary }};}
    .friendly{opacity:.9}
</style>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card login-card">
                <div class="card-body p-0">
                    <div class="login-hero p-4 d-flex align-items-center gap-3">
                        <img src="{{ $logo }}" class="login-logo" alt="logo">
                        <div>
                            <div class="login-title">Bienvenido(a)</div>
                            <div class="friendly">Accede para gestionar tu tarjeta de negocio</div>
                        </div>
                    </div>
                    <div class="p-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="tucorreo@ejemplo.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Recordarme</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary login-btn">Ingresar</button>
                            </div>
                            @if (Route::has('password.request'))
                                <div class="text-center mt-3">
                                    <a class="link-light" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
