<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $profile = BusinessProfile::first();
        $links = $profile ? $profile->socialLinks : collect();
        return view('admin.social.index', compact('profile','links'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'platform' => ['required','string','max:50'],
            'url' => ['required'],
            'icon_class' => ['nullable','string','max:100'],
            'button_color' => ['nullable','string','max:20'],
            'order' => ['nullable','integer'],
        ]);

        // Defaults por plataforma (icono y color)
        $defaults = [
            'whatsapp' => ['icon' => 'bi bi-whatsapp', 'color' => '#25d366'],
            'facebook' => ['icon' => 'bi bi-facebook', 'color' => '#1877F2'],
            'instagram' => ['icon' => 'bi bi-instagram', 'color' => '#E1306C'],
            'tiktok' => ['icon' => 'bi bi-tiktok', 'color' => '#000000'],
            'youtube' => ['icon' => 'bi bi-youtube', 'color' => '#FF0000'],
        ];
        $platformKey = strtolower($data['platform']);
        if (empty($data['icon_class']) && isset($defaults[$platformKey])) {
            $data['icon_class'] = $defaults[$platformKey]['icon'];
        }
        if (empty($data['button_color']) && isset($defaults[$platformKey])) {
            $data['button_color'] = $defaults[$platformKey]['color'];
        }

        $profile = BusinessProfile::firstOrCreate([]);
        $data['business_profile_id'] = $profile->id;
        // Si viene el checkbox, queda activo; por defecto activo
        $data['enabled'] = $request->has('enabled');
        // Orden por defecto 0 si no se envía
        $data['order'] = $data['order'] ?? 0;
        SocialLink::create($data);
        return redirect()->route('admin.social.index')->with('status','Red creada');
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $data = $request->validate([
            'platform' => ['required','string','max:50'],
            'url' => ['required'],
            'icon_class' => ['nullable','string','max:100'],
            'button_color' => ['nullable','string','max:20'],
            'order' => ['nullable','integer'],
        ]);
        // Aplicar defaults si faltan
        $defaults = [
            'whatsapp' => ['icon' => 'bi bi-whatsapp', 'color' => '#25d366'],
            'facebook' => ['icon' => 'bi bi-facebook', 'color' => '#1877F2'],
            'instagram' => ['icon' => 'bi bi-instagram', 'color' => '#E1306C'],
            'tiktok' => ['icon' => 'bi bi-tiktok', 'color' => '#000000'],
            'youtube' => ['icon' => 'bi bi-youtube', 'color' => '#FF0000'],
        ];
        $platformKey = strtolower($data['platform']);
        if (empty($data['icon_class']) && isset($defaults[$platformKey])) {
            $data['icon_class'] = $defaults[$platformKey]['icon'];
        }
        if (empty($data['button_color']) && isset($defaults[$platformKey])) {
            $data['button_color'] = $defaults[$platformKey]['color'];
        }
        // Si viene el checkbox, queda activo; por defecto activo
        $data['enabled'] = $request->has('enabled');
        $data['order'] = $data['order'] ?? $socialLink->order ?? 0;
        $socialLink->update($data);
        return redirect()->route('admin.social.index')->with('status','Red actualizada');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return redirect()->route('admin.social.index')->with('status','Red eliminada');
    }
}