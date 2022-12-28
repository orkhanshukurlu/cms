<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialRequest;
use App\Models\Social;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SocialController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:socials-index'], ['only' => ['index']]);
        $this->middleware(['permission:socials-index',  'permission:socials-create'],  ['only' => ['create', 'store']]);
        $this->middleware(['permission:socials-index',  'permission:socials-edit'],    ['only' => ['edit', 'update']]);
        $this->middleware(['permission:socials-index',  'permission:socials-destroy'], ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('backend.socials.index');
    }

    public function create(): View
    {
        return view('backend.socials.create');
    }

    public function store(SocialRequest $request): RedirectResponse
    {
        try {
            Social::create($request->validated());
            return to_route('backend.socials.index')->withSuccess(__('messages.success.create'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.socials.index')->withError(__('messages.error.create'));
        }
    }

    public function edit(Social $social): View|RedirectResponse
    {
        try {
            return view('backend.socials.edit', compact('social'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function update(SocialRequest $request, Social $social): RedirectResponse
    {
        try {
            $social->update($request->validated());
            return to_route('backend.socials.index')->withSuccess(__('messages.success.update'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.socials.index')->withError(__('messages.error.update'));
        }
    }

    public function destroy(Social $social): Response
    {
        try {
            $social->delete();
            return response(['success' => true]);
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return response(['error' => true]);
        }
    }
}
