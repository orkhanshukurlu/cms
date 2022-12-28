<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:positions-index'], ['only' => ['index']]);
        $this->middleware(['permission:positions-index',  'permission:positions-create'],  ['only' => ['create', 'store']]);
        $this->middleware(['permission:positions-index',  'permission:positions-edit'],    ['only' => ['edit', 'update']]);
        $this->middleware(['permission:positions-index',  'permission:positions-destroy'], ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('backend.positions.index');
    }

    public function create(): View
    {
        return view('backend.positions.create');
    }

    public function store(PositionRequest $request): RedirectResponse
    {
        try {
            Position::create($request->validated());
            return to_route('backend.positions.index')->withSuccess(__('messages.success.create'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.positions.index')->withError(__('messages.error.create'));
        }
    }

    public function edit(Position $position): View|RedirectResponse
    {
        try {
            return view('backend.positions.edit', compact('position'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function update(PositionRequest $request, Position $position): RedirectResponse
    {
        try {
            $position->update($request->validated());
            return to_route('backend.positions.index')->withSuccess(__('messages.success.update'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.positions.index')->withError(__('messages.error.update'));
        }
    }

    public function destroy(Position $position): Response
    {
        try {
            if ($position->members()->exists()) {
                return response(['warning' => true]);
            }

            $position->delete();
            return response(['success' => true]);
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return response(['error' => true]);
        }
    }
}
