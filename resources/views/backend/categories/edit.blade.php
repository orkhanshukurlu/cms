@extends('layouts.backend')
@section('title', 'Kateqoriyalar')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom example example-compact">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">Kateqoriyalar</h3>
                        </div>
                    </div>
                    <form action="{{ route('backend.categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3 col-sm-12">
                                    Ad <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $category) }}" placeholder="Ad daxil edin">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3 col-sm-12">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <div class="input-group">
                                        <select class="form-control select-2 @error('status') is-invalid @enderror" name="status">
                                            <option value=""></option>
                                            <option value="1" @selected(old('status', $category) == 1)>Aktiv</option>
                                            <option value="0" @selected(old('status', $category) == 0 && is_numeric(old('status', $category)))>Deaktiv</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-9 ml-lg-auto">
                                    <button type="submit" class="btn btn-primary mr-2">Yadda saxla</button>
                                    <a href="{{ route('backend.categories.index') }}" class="btn btn-light-primary">Geri qayıt</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('backend/js/select2.js') }}"></script>
    <script>
        $('select[name="status"]').select2({placeholder: 'Status seçin'})
    </script>
@endsection
