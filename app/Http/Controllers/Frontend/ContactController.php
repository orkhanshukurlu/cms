<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function contactView(): View
    {
        return view('frontend.contact.index');
    }

    public function contact(ContactRequest $request): Response
    {
        return true ? response(['success' => true]) : response(['error' => true]);
    }
}
