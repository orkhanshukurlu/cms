<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Member;
use App\Models\Portfolio;
use App\Models\Social;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View|RedirectResponse
    {
        try {
            $brandCount     = Brand::all()->count();
            $memberCount    = Member::all()->count();
            $portfolioCount = Portfolio::all()->count();
            $socialCount    = Social::all()->count();

            return view('backend.dashboard.index', [
                'brandCount'     => $brandCount,
                'memberCount'    => $memberCount,
                'portfolioCount' => $portfolioCount,
                'socialCount'    => $socialCount
            ]);
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            auth()->logout();
            return to_route('backend.login.view')->withError(__('messages.error.system'));
        }
    }
}
