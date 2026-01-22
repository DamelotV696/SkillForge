<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function index()
    {
        return Skill::all();
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'image' => 'nullable|file|image|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'place_execution' => 'required|string',
            'exchange_type_id' => 'required|exists:exchange_types,id',
            'price' => 'nullable|numeric|min:0',
        ]);
        $validated['user_id'] = Auth::id();


        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('skills', 'public');
            $validated['image'] = $path;
        }

        $skill = Skill::create($validated);

        return response()->json([
            'message' => 'Skill created successfully',
            'skill' => $skill
        ], 201);

    }
}
