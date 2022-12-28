<?php

use App\Models\Portfolio;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

if (! function_exists('anchor'))
{
    function anchor(string $url): string
    {
        return "<a href='$url' class='text-primary' target='_blank'>Linki açmaq üçün klikləyin</a>";
    }
}

if (! function_exists('buttons'))
{
    function buttons(Model $model, string $name, array $actions): string
    {
        $html = '';

        if (collect($actions)->contains(1) && auth()->user()->can("$name-show")) {
            $html .= "<a href='" . route("backend.$name.show", $model) . "'";
            $html .= " class='btn btn-sm btn-icon btn-clean mr-2'><i class='la la-cog'></i></a>";
        }

        if (collect($actions)->contains(2) && auth()->user()->can("$name-edit")) {
            $html .= "<a href='" . route("backend.$name.edit", $model) . "'";
            $html .= " class='btn btn-sm btn-icon btn-clean mr-2'><i class='la la-edit'></i></a>";
        }

        if (collect($actions)->contains(3) && auth()->user()->can("$name-destroy")) {
            $html .= "<a href='" . route("backend.$name.destroy", $model) . "'";
            $html .= " class='btn btn-sm btn-icon btn-clean delete'><i class='la la-trash'></i></a>";
        }

        return $html;
    }
}

if (! function_exists('confirm'))
{
    function confirm(): string
    {
        return "Swal.fire({
                    title: 'Əminsiniz ?',
                    text: 'Silinən məlumatları geri qaytara bilməyəcəksiniz !',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Bəli, sil',
                    cancelButtonText: 'Ləğv et'
                })";
    }
}

if (! function_exists('hasMany'))
{
    function hasMany(array $data, string $key = 'image'): array
    {
        $result = [];

        foreach ($data as $item) {
            $result[] = [$key => $item];
        }

        return $result;
    }
}

if (! function_exists('image'))
{
    function image(string $folder, string $file): string
    {
        $path = "uploads/$folder/$file";
        return File::exists($path) ? '<img src="' . asset($path) . '" width="70">' : '';
    }
}

if (! function_exists('menu'))
{
    function menu(string $name): bool
    {
        $route = explode('.', Route::currentRouteName());
        return count($route) > 1 && $route[1] == $name;
    }
}

if (! function_exists('nextPortfolio'))
{
    function nextPortfolio(int $id): Portfolio
    {
        return Portfolio::with('category')->where('id', '>', $id)->firstOr(function () {
            return Portfolio::with('category')->first();
        });
    }
}

if (! function_exists('notify'))
{
    function notify(string $icon, string $title): string
    {
        return "Swal.fire({icon: '$icon', title: '$title', showConfirmButton: false, timer: 4000})";
    }
}

if (! function_exists('permission'))
{
    function permission(string $permission): string
    {
        $name = explode('-', $permission);
        return count($name) == 2 ? ucwords("$name[0] $name[1]") : '';
    }
}

if (! function_exists('setting'))
{
    function setting(string $keyword): ?string
    {
        return Setting::whereKeyword($keyword)->first()?->content;
    }
}

if (! function_exists('short'))
{
    function short(): string
    {
        $name = explode(' ', auth()->user()->name);
        return count($name) > 1 ? $name[0][0] . $name[1][0] : $name[0][0];
    }
}

if (! function_exists('status'))
{
    function status(int $value): string
    {
        return $value
            ? '<span class="label label-lg label-inline label-light-success">Aktiv</span>'
            : '<span class="label label-lg label-inline label-light-danger">Deaktiv</span>';
    }
}
