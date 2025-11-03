@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Perfil del negocio</h5>
                    <p class="mb-1"><strong>Título:</strong> {{ optional($profile)->title ?? '—' }}</p>
                    <p class="mb-1"><strong>Descripción:</strong> {{ optional($profile)->description ?? '—' }}</p>
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Editar perfil</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Redes sociales</h5>
                    <p class="text-muted">Gestiona los botones que se muestran en la landing.</p>
                    <a href="{{ route('admin.social.index') }}" class="btn btn-success">Gestionar redes</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection