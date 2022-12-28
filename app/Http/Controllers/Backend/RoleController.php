<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:roles-index'], ['only' => ['index']]);
        $this->middleware(['permission:roles-index',  'permission:roles-create'],  ['only' => ['create', 'store']]);
        $this->middleware(['permission:roles-index',  'permission:roles-show'],    ['only' => ['show']]);
        $this->middleware(['permission:roles-index',  'permission:roles-edit'],    ['only' => ['edit', 'update']]);
        $this->middleware(['permission:roles-index',  'permission:roles-destroy'], ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('backend.roles.index');
    }

    public function create(): View|RedirectResponse
    {
        try {
            $permissions = Permission::all(['id', 'name']);
            return view('backend.roles.create', compact('permissions'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request) {
                $role = Role::create($request->safe()->only('name'));
                $role->givePermissionTo($request->safe()->only('permissions'));
            });

            return to_route('backend.roles.index')->withSuccess(__('messages.success.create'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.roles.index')->withError(__('messages.error.create'));
        }
    }

    public function show(Role $role): View|RedirectResponse
    {
        try {
            return view('backend.roles.show', compact('role'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function edit(Role $role): View|RedirectResponse
    {
        try {
            $permissions = Permission::all(['id', 'name']);
            return view('backend.roles.edit', compact('role', 'permissions'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request, $role) {
                $role->update($request->safe()->only('name'));
                $role->syncPermissions($request->safe()->only('permissions'));
            });

            return to_route('backend.roles.index')->withSuccess(__('messages.success.update'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.roles.index')->withError(__('messages.error.update'));
        }
    }

    public function destroy(Role $role): Response
    {
        try {
            if ($role->users()->exists()) {
                return response(['warning' => true]);
            }

            DB::transaction(function () use ($role) {
                $role->delete();
                $role->revokePermissionTo($role->permissions->modelKeys());
            });

            return response(['success' => true]);
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return response(['error' => true]);
        }
    }
}
