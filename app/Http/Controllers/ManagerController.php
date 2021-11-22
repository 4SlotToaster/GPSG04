<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagerCreateRequest;
use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function create(ManagerCreateRequest $request)
    {
        $validated = $request->validated();

        Manager::query()->create($validated);
        return redirect(route('home'));
    }
}
