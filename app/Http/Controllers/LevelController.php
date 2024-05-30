<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $levels = Level::all();
        return view('admin.levels.index', compact('levels'));
    }

    public function create()
    {
        return view('admin.levels.create');
    }

    public function store(Request $request)
    {
        $data =$request->validate([
            'level' => 'required|unique:levels',
            'description' => 'required',
            
        ]);
        //dd($data);
        Level::create($data);

        return redirect()->route('levels.index')->with('success', 'Level added successfully');
    }

    public function show(Level $level)
    {
        return view('admin.levels.show', compact('level'));
    }

    public function edit(Level $level)
    {
        return view('admin.levels.edit', compact('level'));
    }

    public function update(Request $request, Level $level)
    {
        $data = $request->validate([
            'level' => 'required|unique:levels,level,'.$level->id,
            'description' => 'required',
            
        ]);

        $level->update($data);

        return redirect()->route('levels.index')->with('success', 'Level updated successfully');
    }

    public function destroy(Level $level)
    {
        $level->delete();

        return redirect()->route('levels.index')->with('success', 'Level deleted successfully');
    }
}
