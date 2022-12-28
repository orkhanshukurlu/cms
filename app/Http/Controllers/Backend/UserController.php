<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:users-index'], ['only' => ['index']]);
        $this->middleware(['permission:users-index',  'permission:users-create'],  ['only' => ['create', 'store']]);
        $this->middleware(['permission:users-index',  'permission:users-edit'],    ['only' => ['edit', 'update']]);
        $this->middleware(['permission:users-index',  'permission:users-destroy'], ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('backend.users.index');
    }

    public function create(): View|RedirectResponse
    {
        try {
            $roles = Role::all(['id', 'name']);
            return view('backend.users.create', compact('roles'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function store(UserRequest $request): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request) {
                $user = User::create($request->validated());
                $user->assignRole($request->safe()->only('role_id'));
            });

            return to_route('backend.users.index')->withSuccess(__('messages.success.create'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.users.index')->withError(__('messages.error.create'));
        }
    }

    public function edit(User $user): View|RedirectResponse
    {
        try {
            $roles = Role::all(['id', 'name']);
            return view('backend.users.edit', compact('user', 'roles'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request, $user) {
                $user->update($request->validated());
                $user->syncRoles($request->safe()->only('role_id'));
            });

            return to_route('backend.users.index')->withSuccess(__('messages.success.update'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.users.index')->withError(__('messages.error.update'));
        }
    }

    public function destroy(User $user): Response
    {
        try {
            DB::transaction(function () use ($user) {
                $user->delete();
                $user->removeRole($user->role_id);
            });

            return response(['success' => true]);
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return response(['error' => true]);
        }
    }
}
