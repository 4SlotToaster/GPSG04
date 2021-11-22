<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitorCreateRequest;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function create(VisitorCreateRequest $request)
    {
        $validated = $request->validated();

        Visitor::query()->create($validated);
        return redirect(route('home'));
    }
}
