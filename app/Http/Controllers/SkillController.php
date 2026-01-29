<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Inertia\Inertia;
use Inertia\Response;

class SkillController extends Controller
{
    public function show(Skill $skill): Response
    {
        return Inertia::render('Skill/ShowSkill', [
            'skill' => $skill->load(['level', 'category', 'user'])
        ]);
    }
}
