@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">Editar perfil del negocio</div>
                <div class="card-body">
                    <style>
                        .color-input { height: 42px; width: 100%; padding: 0; }
                        .color-row label { display:block; margin-bottom: .25rem; }
                    </style>
                    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" name="title" value="{{ old('title', $profile->title) }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $profile->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @if($profile->logo_path)
                                <img src="{{ $profile->logo_path }}" class="mt-2" style="height:60px;border-radius:8px">
                            @endif
                        </div>
                        <div class="row g-3 color-row">
                            <div class="col-md-6">
                                <label class="form-label">Color primario</label>
                                <input type="color" name="primary_color" value="{{ old('primary_color', $profile->primary_color ?? '#c62828') }}" class="color-input">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Color secundario</label>
                                <input type="color" name="secondary_color" value="{{ old('secondary_color', $profile->secondary_color ?? '#0d6efd') }}" class="color-input">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Color acento</label>
                                <input type="color" name="accent_color" value="{{ old('accent_color', $profile->accent_color ?? '#28a745') }}" class="color-input">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Color de fondo</label>
                                <input type="color" name="background_color" value="{{ old('background_color', $profile->background_color ?? '#f7d7da') }}" class="color-input">
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection