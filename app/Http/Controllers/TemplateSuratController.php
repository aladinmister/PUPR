<?php
namespace App\Http\Controllers;

use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateSuratController extends Controller
{
    public function index()
    {
        $templates = TemplateSurat::all();
        return view('template.index', compact('templates'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:2048'
        ]);

        $uploadedFile = $request->file('file');
        $originalName = $uploadedFile->getClientOriginalName();
        $path = $uploadedFile->storeAs('templates', $originalName, 'public');

        TemplateSurat::create([
            'file_path' => $path,
            'original_name' => $originalName,
            'is_active' => false,
        ]);

        return back()->with('success', 'Template berhasil diupload.');
    }

    public function activate($id)
    {
        $template = TemplateSurat::findOrFail($id);

        if ($template->is_active) {
            $template->update(['is_active' => false]);
            return back()->with('success', 'Template dinonaktifkan.');
        }

        TemplateSurat::query()->update(['is_active' => false]);
        $template->update(['is_active' => true]);

        return back()->with('success', 'Template berhasil diaktifkan.');
    }

    public function delete($id)
    {
        $template = TemplateSurat::findOrFail($id);

        // Hapus file dari storage
        if (Storage::disk('public')->exists($template->file_path)) {
            Storage::disk('public')->delete($template->file_path);
        }

        $template->delete();

        return back()->with('success', 'Template berhasil dihapus.');
    }

    public function show($id)
    {
        $template = TemplateSurat::findOrFail($id);
        $url = Storage::url($template->file_path);
        return view('template.show', compact('template', 'url'));
    }
}
