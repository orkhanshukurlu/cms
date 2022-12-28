<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Exception;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        try {
            $portfolio = Portfolio::with('category:id,name')->active()->take(4)->latest('order')->get(['title', 'slug', 'image', 'category_id']);
            return view('frontend.home.index', compact('portfolio'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            abort(500);
        }
    }
}
