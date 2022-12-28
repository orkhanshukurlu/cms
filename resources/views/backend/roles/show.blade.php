@extends('layouts.backend')
@section('title', 'Rollar')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">Rollar</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-light table-light-success mb-0">
                                <tbody>
                                    <tr>
                                        <td class="table-row-title w-25">#</td>
                                        <td class="table-center">{{ $role->id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-row-title w-25">Ad</td>
                                        <td class="table-center">{{ $role->name }}</td>
                                    </tr>
                                    @foreach ($role->permissions as $item)
                                        <tr>
                                            <td class="table-row-title w-25">
                                                @if ($loop->first) İcazələr @endif
                                            </td>
                                            <td class="table-center">{{ permission($item->name) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-9 ml-lg-auto">
                                @can('roles-edit')
                                    <a href="{{ route('backend.roles.edit', $role) }}" class="btn btn-primary mr-2">Dəyişdir</a>
                                @endcan
                                <a href="{{ route('backend.roles.index') }}" class="btn btn-light-primary">Geri qayıt</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
