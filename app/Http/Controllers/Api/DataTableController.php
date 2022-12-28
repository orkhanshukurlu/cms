<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Member;
use App\Models\Portfolio;
use App\Models\Position;
use App\Models\Setting;
use App\Models\Social;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;

class DataTableController extends Controller
{
    public function getBrands(): JsonResponse
    {
        $query = Brand::all(['id', 'name', 'image', 'status']);

        return datatables()
            ->of($query)
            ->editColumn('image',  fn($row) => image('brands', $row->image))
            ->editColumn('status', fn($row) => status($row->status))
            ->addColumn('actions', fn($row) => buttons($row, 'brands', [2, 3]))
            ->rawColumns(['image', 'status', 'actions'])
            ->make(true);
    }

    public function getCategories(): JsonResponse
    {
        $query = Category::all(['id', 'name', 'status']);

        return datatables()
            ->of($query)
            ->editColumn('status', fn($row) => status($row->status))
            ->addColumn('actions', fn($row) => buttons($row, 'categories', [2, 3]))
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function getMembers(): JsonResponse
    {
        $query = Member::with('position:id,name')->get()->makeHidden(['created_at', 'updated_at']);

        return datatables()
            ->of($query)
            ->editColumn('image',   fn($row) => image('members', $row->image))
            ->addColumn('position', fn($row) => $row->position?->name)
            ->editColumn('status',  fn($row) => status($row->status))
            ->addColumn('actions',  fn($row) => buttons($row, 'members', [2, 3]))
            ->rawColumns(['image', 'status', 'actions'])
            ->make(true);
    }

    public function getPortfolio(): JsonResponse
    {
        $query = Portfolio::with('category:id,name')->get()->makeHidden(['created_at', 'updated_at']);

        return datatables()
            ->of($query)
            ->editColumn('image',   fn($row) => image('portfolio', $row->image))
            ->addColumn('category', fn($row) => $row->category?->name)
            ->editColumn('status',  fn($row) => status($row->status))
            ->addColumn('actions',  fn($row) => buttons($row, 'portfolio', [1, 2, 3]))
            ->rawColumns(['image', 'status', 'actions'])
            ->make(true);
    }

    public function getPositions(): JsonResponse
    {
        $query = Position::all(['id', 'name', 'status']);

        return datatables()
            ->of($query)
            ->editColumn('status', fn($row) => status($row->status))
            ->addColumn('actions', fn($row) => buttons($row, 'positions', [2, 3]))
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function getRoles(): JsonResponse
    {
        $query = Role::all(['id', 'name']);

        return datatables()
            ->of($query)
            ->addColumn('actions', fn($row) => buttons($row, 'roles', [1, 2, 3]))
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function getSettings(): JsonResponse
    {
        $query = Setting::all(['id', 'keyword']);

        return datatables()
            ->of($query)
            ->addColumn('actions', fn($row) => buttons($row, 'settings', [1, 2, 3]))
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function getSocials(): JsonResponse
    {
        $query = Social::all(['id', 'name', 'link', 'status']);

        return datatables()
            ->of($query)
            ->editColumn('link',   fn($row) => anchor($row->link))
            ->editColumn('status', fn($row) => status($row->status))
            ->addColumn('actions', fn($row) => buttons($row, 'socials', [2, 3]))
            ->rawColumns(['link', 'status', 'actions'])
            ->make(true);
    }

    public function getUsers(): JsonResponse
    {
        $query = User::with('role:id,name')->get(['id', 'name', 'email', 'role_id']);

        return datatables()
            ->of($query)
            ->addColumn('role',    fn($row) => $row->role?->name)
            ->addColumn('actions', fn($row) => buttons($row, 'users', [2, 3]))
            ->rawColumns(['actions'])
            ->make(true);
    }
}
