<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::with('translations')->get();
        return view('admin.profiles.index', compact('profiles'));
    }

    public function create()
    {
        return view('admin.profiles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio_id' => 'required|string',
        ]);

        $slug = Str::slug($request->name);

        if (Profile::where('slug', $slug)->exists()) {
            return back()->withErrors(['name' => 'Nama ini menghasilkan slug yang sudah dipakai.'])->withInput();
        }

        $profile = Profile::create([
            'slug' => $slug,
            'name' => $request->name,
        ]);

        $bioId = $request->bio_id;
        $translator = new GoogleTranslate();

        $profile->translations()->create([
            'locale' => 'id',
            'bio' => $bioId,
        ]);

        $translator->setSource('id')->setTarget('en');
        $profile->translations()->create([
            'locale' => 'en',
            'bio' => $translator->translate($bioId),
        ]);

        $translator->setTarget('de');
        $profile->translations()->create([
            'locale' => 'de',
            'bio' => $translator->translate($bioId),
        ]);

        return redirect()->route('admin.profiles.index')->with('success', 'Profile berhasil ditambahkan.');
    }

    public function edit(Profile $profile)
    {
        // Ambil bio versi Indonesia
        $bio_id = $profile->translation('id')->bio ?? '';
        return view('admin.profiles.edit', compact('profile', 'bio_id'));
    }

    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio_id' => 'required|string',
        ]);

        $slug = Str::slug($request->name);

        if (Profile::where('slug', $slug)->where('id', '!=', $profile->id)->exists()) {
            return back()->withErrors(['name' => 'Nama ini menghasilkan slug yang sudah dipakai.'])->withInput();
        }

        $profile->update([
            'slug' => $slug,
            'name' => $request->name,
        ]);

        $bioId = $request->bio_id;
        $translator = new GoogleTranslate();

        $profile->translations()->updateOrCreate(
            ['locale' => 'id'],
            ['bio' => $bioId]
        );

        $translator->setSource('id')->setTarget('en');
        $profile->translations()->updateOrCreate(
            ['locale' => 'en'],
            ['bio' => $translator->translate($bioId)]
        );

        $translator->setTarget('de');
        $profile->translations()->updateOrCreate(
            ['locale' => 'de'],
            ['bio' => $translator->translate($bioId)]
        );

        return redirect()->route('admin.profiles.index')->with('success', 'Profile berhasil diperbarui.');
    }

    public function destroy(Profile $profile)
    {
        $profile->translations()->delete();
        $profile->delete();

        return redirect()->route('admin.profiles.index')->with('success', 'Profile berhasil dihapus.');
    }
}
