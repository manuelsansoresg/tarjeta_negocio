@php
    $profile = $profile ?? null;
    $primary = $profile->primary_color ?? '#c62828';
    $secondary = $profile->secondary_color ?? '#0d6efd';
    $accent = $profile->accent_color ?? '#28a745';
    // Fondo claro por defecto (rosa suave) para el diseño solicitado
    $bg = $profile->background_color ?? '#f7d7da';
    $logo = $profile->logo_path ?? asset('images/logo.png');
    $title = $profile->title ?? '¡Únete a Nuestra Comunidad Exclusiva!';
    $desc = $profile->description ?? 'Conéctate con nosotros y disfruta de varias partidas al día!';
@endphp
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Fuentes para título y subtítulo -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root{
            --primary: {{ $primary }};
            --secondary: {{ $secondary }};
            --accent: {{ $accent }};
            --bg: {{ $bg }};
        }
        /* Forzamos fondo rosado independientemente del valor guardado */
        body{background: #f7d7da !important; color:#2b1f1f;}
        .hero-logo{width:140px;height:140px;border-radius:50%;box-shadow:0 0 0 6px rgba(0,0,0,.05), 0 20px 40px rgba(0,0,0,.25);animation: float 4s ease-in-out infinite;}
        @keyframes float{0%{transform:translateY(0)}50%{transform:translateY(-8px)}100%{transform:translateY(0)}}
        /* Título: solo tipografía y tamaño, sin barra */
        .hero-title{
            font-family:'Playfair Display', serif; font-weight:800;
            font-size: clamp(2.4rem, 6vw, 3.4rem);
            letter-spacing:.2px; line-height:1.1;
            color:#2b1f1f; margin:.35rem 0 .5rem; display:block;
        }
        /* Subtítulo: tipografía y tamaño */
        .hero-sub{ font-family:'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif; color:#5a4a4a; opacity:.9; font-size: clamp(1.05rem, 2.8vw, 1.2rem); max-width:640px; margin:0 auto 1.5rem; }
        .social-btn{border-radius:16px;padding:1rem 1.2rem;font-weight:700;display:flex;align-items:center;justify-content:center;gap:.75rem;color:#fff;text-decoration:none;transition: transform .15s ease, box-shadow .15s ease; background: var(--btn-color, var(--primary));} 
        /* Borde ondulado arriba y abajo del botón */
        .social-btn{ position: relative; overflow: visible; }
        .social-btn::before, .social-btn::after{
            content:""; position:absolute; left:0; right:0; height:12px; background: var(--btn-color, var(--primary));
            /* Máscara con círculos repetidos para generar las ondas */
            -webkit-mask: radial-gradient(6px at 6px 6px, #000 6px, transparent 6px) 0 0/12px 12px repeat-x;
            mask: radial-gradient(6px at 6px 6px, #000 6px, transparent 6px) 0 0/12px 12px repeat-x;
        }
        .social-btn::before{ top:-6px; }
        .social-btn::after{ bottom:-6px; transform: scaleY(-1); }
        .social-btn > *{ position: relative; z-index: 1; }
        .social-btn:hover{transform: translateY(-2px); box-shadow:0 10px 20px rgba(0,0,0,.25)}
        .icon-circle{width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;border:2px solid rgba(255,255,255,.35)}
        .container-narrow{max-width:800px}
    </style>
</head>
<body>
<div class="container container-narrow py-5 text-center">
    <img src="{{ $logo }}" class="hero-logo mb-4" alt="logo">
    <h1 class="hero-title">{{ $title }}</h1>
    <p class="hero-sub mb-4">{{ $desc }}</p>

    @php
        $iconDefaults = [
            'whatsapp' => 'bi bi-whatsapp',
            'facebook' => 'bi bi-facebook',
            'instagram' => 'bi bi-instagram',
            'tiktok' => 'bi bi-tiktok',
            'youtube' => 'bi bi-youtube',
        ];
    @endphp
    <div class="d-flex flex-column gap-3 align-items-stretch">
        @forelse($links as $link)
            @php
                $platformKey = strtolower($link->platform);
                $resolvedIcon = $link->icon_class ?: ($iconDefaults[$platformKey] ?? 'bi bi-link-45deg');
            @endphp
            @php($btnColor = $link->button_color ?: $primary)
            <a href="{{ $link->url }}"  class="social-btn" style="--btn-color: {{ $btnColor }};">
                <span class="icon-circle"><i class="{{ $resolvedIcon }}"></i></span>
                <span>{{ ucfirst($link->platform) }}</span>
            </a>
        @empty
            <div class="alert alert-dark bg-opacity-50 text-dark">Aún no hay redes configuradas. Inicia sesión para gestionarlas.</div>
        @endforelse
    </div>

    {{-- Enlace de administración oculto por petición: solo accede quien conozca la URL --}}
</div>
</body>
</html>