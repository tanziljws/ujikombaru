<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgendaController extends Controller
{
    public function publicIndex()
    {
        $agendas = Agenda::orderBy('tanggal')->orderBy('id')->get();
        return view('agenda', compact('agendas'));
    }

    public function adminIndex()
    {
        $agendas = Agenda::orderBy('tanggal')->orderBy('id')->get();
        return view('agenda', compact('agendas'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        
        $agenda = Agenda::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil ditambahkan',
            'data' => $agenda
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        
        $agenda->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil diperbarui',
            'data' => $agenda
        ]);
    }
    
    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dihapus'
        ]);
    }
}


