<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:settings-index'], ['only' => ['index']]);
        $this->middleware(['permission:settings-index',  'permission:settings-create'],  ['only' => ['create', 'store']]);
        $this->middleware(['permission:settings-index',  'permission:settings-show'],    ['only' => ['show']]);
        $this->middleware(['permission:settings-index',  'permission:settings-edit'],    ['only' => ['edit', 'update']]);
        $this->middleware(['permission:settings-index',  'permission:settings-destroy'], ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('backend.settings.index');
    }

    public function create(): View
    {
        return view('backend.settings.create');
    }

    public function store(SettingRequest $request): RedirectResponse
    {
        try {
            Setting::create($request->validated());
            return to_route('backend.settings.index')->withSuccess(__('messages.success.create'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.settings.index')->withError(__('messages.error.create'));
        }
    }

    public function show(Setting $setting): View|RedirectResponse
    {
        try {
            return view('backend.settings.show', compact('setting'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function edit(Setting $setting): View|RedirectResponse
    {
        try {
            return view('backend.settings.edit', compact('setting'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function update(SettingRequest $request, Setting $setting): RedirectResponse
    {
        try {
            $setting->update($request->validated());
            return to_route('backend.settings.index')->withSuccess(__('messages.success.update'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.settings.index')->withError(__('messages.error.update'));
        }
    }

    public function destroy(Setting $setting): Response
    {
        try {
            $setting->delete();
            return response(['success' => true]);
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return response(['error' => true]);
        }
    }
}
