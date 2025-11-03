@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Revisa los datos:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header">Agregar red social</div>
                <div class="card-body">
                    <style>
                        .color-input { height: 42px; width: 100%; padding: 0; }
                    </style>
                    <form method="POST" action="{{ route('admin.social.store') }}">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label">Plataforma</label>
                            <select name="platform" class="form-select">
                                <option value="whatsapp">WhatsApp</option>
                                <option value="facebook">Facebook</option>
                                <option value="instagram">Instagram</option>
                                <option value="tiktok">TikTok</option>
                                <option value="youtube">YouTube</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">URL</label>
                            <input type="url" name="url" class="form-control" placeholder="https://...">
                        </div>
                        <!-- Icono eliminado: se asigna automáticamente según la plataforma -->
                        <div class="mb-2">
                            <label class="form-label">Color del botón</label>
                            <input type="color" name="button_color" class="color-input" value="#25d366">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Orden</label>
                            <input type="number" name="order" class="form-control" value="0">
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="enabled" id="enabled" checked>
                            <label class="form-check-label" for="enabled">Activo</label>
                        </div>
                        <button class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Redes configuradas</div>
                <div class="card-body">
                    @forelse($links as $link)
                        <form method="POST" action="{{ route('admin.social.update', $link) }}" class="border rounded p-3 mb-3">
                            @csrf
                            @php
                                $iconDefaults = [
                                    'whatsapp' => 'bi bi-whatsapp',
                                    'facebook' => 'bi bi-facebook',
                                    'instagram' => 'bi bi-instagram',
                                    'tiktok' => 'bi bi-tiktok',
                                    'youtube' => 'bi bi-youtube',
                                ];
                                $platformKey = strtolower($link->platform);
                                $resolvedIcon = $link->icon_class ?: ($iconDefaults[$platformKey] ?? 'bi bi-link-45deg');
                            @endphp
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="{{ $resolvedIcon }}"></i>
                                <strong class="text-capitalize">{{ $link->platform }}</strong>
                                <span class="badge bg-secondary ms-auto">#{{ $link->order }}</span>
                            </div>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="text" name="platform" value="{{ $link->platform }}" class="form-control">
                                </div>
                                <div class="col-6">
                                    <input type="url" name="url" value="{{ $link->url }}" class="form-control">
                                </div>
                                <div class="col-3">
                                    <input type="color" name="button_color" value="{{ $link->button_color }}" class="color-input">
                                </div>
                                <div class="col-3">
                                    <input type="number" name="order" value="{{ $link->order }}" class="form-control">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="enabled" {{ $link->enabled ? 'checked' : '' }}>
                                    <label class="form-check-label">Activo</label>
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary btn-sm">Actualizar</button>
                                </div>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('admin.social.destroy', $link) }}" class="mb-3">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">Eliminar</button>
                        </form>
                    @empty
                        <p class="text-muted">No hay redes configuradas.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection