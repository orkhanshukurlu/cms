<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Exception;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        try {
            $portfolio = Portfolio::with('category:id,name')->active()->latest('order')->get(['title', 'slug', 'image', 'category_id']);
            return view('frontend.portfolio.index', compact('portfolio'));
        } catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            abort(500);
        }
    }

    public function show(Portfolio $portfolio): View
    {
        try {
            $nextPortfolio = nextPortfolio($portfolio->id);
            return view('frontend.portfolio.show', compact('portfolio', 'nextPortfolio'));
        } catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            abort(500);
        }
    }
}
