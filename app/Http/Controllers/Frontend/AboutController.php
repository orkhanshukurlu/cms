<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Member;
use Exception;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function __invoke(): View
    {
        try {
            $members = Member::with('position:id,name')->active()->get(['name', 'image', 'position_id']);
            $brands  = Brand::active()->get(['name', 'image']);
            return view('frontend.about.index', compact('members', 'brands'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            abort(500);
        }
    }
}
