<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\Member;
use App\Models\Position;
use App\Services\Filer;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:members-index'], ['only' => ['index']]);
        $this->middleware(['permission:members-index',  'permission:members-create'],  ['only' => ['create', 'store']]);
        $this->middleware(['permission:members-index',  'permission:members-edit'],    ['only' => ['edit', 'update']]);
        $this->middleware(['permission:members-index',  'permission:members-destroy'], ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('backend.members.index');
    }

    public function create(): View|RedirectResponse
    {
        try {
            $positions = Position::active()->get(['id', 'name']);
            return view('backend.members.create', compact('positions'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function store(MemberRequest $request, Filer $filer): RedirectResponse
    {
        try {
            $image = $filer->upload('members', $request->image);
            $data  = $request->safe()->merge(['image' => $image]);
            Member::create($data->all());
            return to_route('backend.members.index')->withSuccess(__('messages.success.create'));
        }

        catch (Exception $e) {
            if (isset($image)) {
                $filer->delete('members', $image);
            }

            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.members.index')->withError(__('messages.error.create'));
        }
    }

    public function edit(Member $member): View|RedirectResponse
    {
        try {
            $positions = Position::active()->get(['id', 'name']);
            return view('backend.members.edit', compact('member', 'positions'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function update(MemberRequest $request, Member $member, Filer $filer): RedirectResponse
    {
        try {
            if ($request->hasFile('image')) {
                $filer->delete('members', $member->image);
                $image = $filer->upload('members', $request->image);
                $data  = $request->safe()->merge(['image' => $image])->all();
            }

            else {
                $data = $request->validated();
            }

            $member->update($data);
            return to_route('backend.members.index')->withSuccess(__('messages.success.update'));
        }

        catch (Exception $e) {
            if ($request->hasFile('image') && isset($image)) {
                $filer->delete('members', $image);
            }

            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.members.index')->withError(__('messages.error.update'));
        }
    }

    public function destroy(Member $member, Filer $filer): Response
    {
        try {
            $member->delete();
            $filer->delete('members', $member->image);
            return response(['success' => true]);
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return response(['error' => true]);
        }
    }
}
