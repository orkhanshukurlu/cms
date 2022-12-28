<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function profileView(): View
    {
        return view('backend.profile.index');
    }

    public function profile(ProfileRequest $request): RedirectResponse
    {
        try {
            auth()->user()->update($request->validated());
            return to_route('backend.dashboard')->withSuccess(__('messages.success.profile'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.dashboard')->withError(__('messages.error.profile'));
        }
    }
}
