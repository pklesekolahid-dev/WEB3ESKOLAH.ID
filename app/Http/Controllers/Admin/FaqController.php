<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        // Menampilkan data diurutkan berdasarkan kolom 'urutan'
        $faqs = Faq::orderBy('urutan', 'asc')->get();
        return view('pages.admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('pages.admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'urutan' => 'nullable|integer',
        ]);

        Faq::create($request->all());

        return redirect()->route('admin.faq.index')->with('success', 'Tanya Jawab (FAQ) berhasil ditambahkan!');
    }

    public function edit(Faq $faq)
    {
        return view('pages.admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'urutan' => 'nullable|integer',
        ]);

        $faq->update($request->all());

        return redirect()->route('admin.faq.index')->with('success', 'Tanya Jawab (FAQ) berhasil diperbarui!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faq.index')->with('success', 'Tanya Jawab (FAQ) berhasil dihapus!');
    }
}