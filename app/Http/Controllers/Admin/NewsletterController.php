<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::orderBy('created_at', 'desc')->get();
        return view('admin.newsletters.index', compact('newsletters'));
    }

    public function edit($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('admin.newsletters.edit', compact('newsletter'));
    }

    public function update(Request $request, $id)
    {
        $newsletter = Newsletter::findOrFail($id);

        $request->validate([
            'nom'   => 'required|string|max:255',
            'email' => 'required|email|unique:newsletters,email,' . $id,
        ]);

        $newsletter->update($request->only('nom', 'email'));

        return redirect()->route('admin.newsletters.index')
            ->with('success', 'Inscrit modifié avec succès.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'   => 'required|string|max:255',
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create($request->only('nom', 'email'));

        return response()->json(['message' => 'Inscription réussie !'], 201);
    }

    public function confirmDelete($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('admin.newsletters.delete', compact('newsletter'));
    }

    public function delete($id)
    {
        Newsletter::findOrFail($id)->delete();
        return redirect()->route('admin.newsletters.index')
            ->with('success', 'Inscrit supprimé avec succès.');
    }
    
}