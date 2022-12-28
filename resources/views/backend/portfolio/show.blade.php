@extends('layouts.backend')
@section('title', 'Portfolio')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">Portfolio</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-light table-light-success mb-0">
                                <tbody>
                                    <tr>
                                        <td class="table-row-title w-25">#</td>
                                        <td class="table-center">{{ $portfolio->id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-row-title w-25">Başlıq</td>
                                        <td class="table-center">{{ $portfolio->title }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-row-title w-25">Açıqlama</td>
                                        <td class="table-center">{!! $portfolio->description !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-row-title w-25">Əsas şəkil</td>
                                        <td class="table-center">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#imageModal">Bax</button>
                                            <div class="modal fade" id="imageModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Əsas şəkil</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <i aria-hidden="true" class="ki ki-close"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ asset("uploads/portfolio/$portfolio->image") }}" class="d-block w-100">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-row-title w-25">Digər şəkillər</td>
                                        <td class="table-center">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#imagesModal">Bax</button>
                                            <div class="modal fade" id="imagesModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Digər şəkillər</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <i aria-hidden="true" class="ki ki-close"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="carousel" class="carousel slide" data-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    @foreach ($portfolio->photos as $item)
                                                                        <div class="carousel-item @if($loop->first) active @endif">
                                                                            <img src="{{ asset("uploads/portfolio/$item->image") }}" class="d-block w-100">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                                                                    <span classs="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-row-title w-25">Kateqoriya</td>
                                        <td class="table-center">{{ $portfolio->category?->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-row-title w-25">Sıra</td>
                                        <td class="table-center">{{ $portfolio->order }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-9 ml-lg-auto">
                                @can('portfolio-edit')
                                    <a href="{{ route('backend.portfolio.edit', $portfolio) }}" class="btn btn-primary mr-2">Dəyişdir</a>
                                @endcan
                                <a href="{{ route('backend.portfolio.index') }}" class="btn btn-light-primary">Geri qayıt</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
