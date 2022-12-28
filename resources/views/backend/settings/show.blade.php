@extends('layouts.backend')
@section('title', 'Tənzimləmələr')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">Tənzimləmələr</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-light table-light-success mb-0">
                                <tbody>
                                    <tr>
                                        <td class="table-row-title w-25">#</td>
                                        <td class="table-center">{{ $setting->id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-row-title w-25">Açar söz</td>
                                        <td class="table-center">{{ $setting->keyword }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-row-title w-25">Məzmun</td>
                                        <td class="table-center">{!! $setting->content !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-9 ml-lg-auto">
                                @can('settings-edit')
                                    <a href="{{ route('backend.settings.edit', $setting) }}" class="btn btn-primary mr-2">Dəyişdir</a>
                                @endcan
                                <a href="{{ route('backend.settings.index') }}" class="btn btn-light-primary">Geri qayıt</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
