<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BusinessProfileController extends Controller
{
    public function edit()
    {
        $profile = BusinessProfile::first() ?? new BusinessProfile();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => ['nullable','string','max:255'],
            'description' => ['nullable','string'],
            'primary_color' => ['required','string','max:20'],
            'secondary_color' => ['required','string','max:20'],
            'accent_color' => ['required','string','max:20'],
            'background_color' => ['required','string','max:20'],
            // Restringe a formatos de imagen seguros y tamaño máximo 2MB
            'logo' => ['nullable','file','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        $profile = BusinessProfile::first();
        if (!$profile) { $profile = new BusinessProfile(); }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            // Validación adicional: asegura que realmente sea una imagen
            $tmpPath = $file->getPathname();
            $imageInfo = @getimagesize($tmpPath);
            if ($imageInfo === false) {
                return back()->withErrors(['logo' => 'El archivo subido no es una imagen válida.'])->withInput();
            }

            $extension = strtolower($file->getClientOriginalExtension());
            $safeExtensions = ['jpg','jpeg','png','webp'];
            if (!in_array($extension, $safeExtensions, true)) {
                return back()->withErrors(['logo' => 'Extensión no permitida. Usa JPG, JPEG, PNG o WEBP.'])->withInput();
            }

            $filename = 'logo_' . Str::uuid()->toString() . '.' . $extension;
            $destination = public_path('images');
            // Mueve el archivo directamente a public/images
            $file->move($destination, $filename);
            // Guarda una URL accesible pública
            $profile->logo_path = asset('images/' . $filename);
        }

        $profile->title = $data['title'] ?? $profile->title;
        $profile->description = $data['description'] ?? $profile->description;
        $profile->primary_color = $data['primary_color'];
        $profile->secondary_color = $data['secondary_color'];
        $profile->accent_color = $data['accent_color'];
        $profile->background_color = $data['background_color'];
        $profile->save();

        return redirect()->route('admin.dashboard')->with('status','Perfil actualizado');
    }
}