<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Description;
use App\Models\DescriptionTranslation;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

class DescriptionController extends Controller
{
    public function index()
    {
        $descriptions = Description::with('translations')->get();
        return view('admin.descriptions.index', compact('descriptions'));
    }

    public function create()
    {
        return view('admin.descriptions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:descriptions,slug',
            'title' => 'required|string|max:255',
            'link' => 'nullable|url',
            'content_id' => 'required|string',
        ]);

        $description = Description::create([
            'slug' => Str::slug($request->slug),
            'title' => $request->title,
            'link' => $request->link,
        ]);

        $content_id = $request->content_id;
        $translator = new GoogleTranslate();

        $description->translations()->create([
            'locale' => 'id',
            'content' => $content_id,
        ]);

        $translator->setSource('id')->setTarget('en');
        $description->translations()->create([
            'locale' => 'en',
            'content' => $translator->translate($content_id),
        ]);

        $translator->setTarget('de');
        $description->translations()->create([
            'locale' => 'de',
            'content' => $translator->translate($content_id),
        ]);

        return redirect()->route('admin.descriptions.index')->with('success', 'Deskripsi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $description = Description::with('translations')->findOrFail($id);
        return view('admin.descriptions.edit', compact('description'));
    }

    public function update(Request $request, Description $description)
    {
        $request->validate([
            'slug' => 'required|unique:descriptions,slug,' . $description->id,
            'title' => 'required|string|max:255',
            'link' => 'nullable|url',
            'content_id' => 'required|string',
        ]);

        $description->update([
            'slug' => Str::slug($request->slug),
            'title' => $request->title,
            'link' => $request->link,
        ]);

        $content_id = $request->content_id;
        $translator = new GoogleTranslate();

        $description->translations()->updateOrCreate(
            ['locale' => 'id'],
            ['content' => $content_id]
        );

        $translator->setSource('id')->setTarget('en');
        $translated_en = $translator->translate($content_id);
        $description->translations()->updateOrCreate(
            ['locale' => 'en'],
            ['content' => $translated_en]
        );

        $translator->setTarget('de');
        $translated_de = $translator->translate($content_id);
        $description->translations()->updateOrCreate(
            ['locale' => 'de'],
            ['content' => $translated_de]
        );

        return redirect()->route('admin.descriptions.index')->with('success', 'Deskripsi berhasil diperbarui.');
    }

    public function destroy(Description $description)
    {
        $description->translations()->delete();
        $description->delete();

        return redirect()->route('admin.descriptions.index')->with('success', 'Deskripsi berhasil dihapus.');
    }
}
