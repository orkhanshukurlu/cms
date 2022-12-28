@extends('layouts.backend')
@section('title', 'Rollar')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom example example-compact">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">Rollar</h3>
                        </div>
                    </div>
                    <form action="{{ route('backend.roles.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3 col-sm-12">
                                    Ad <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Ad daxil edin">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3 col-sm-12">
                                    İcazələr <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <div class="input-group">
                                        <select class="form-control select-2 @if($errors->has('permissions') || $errors->has('permissions.*')) is-invalid @endif" name="permissions[]" multiple>
                                            <option value=""></option>
                                            @foreach ($permissions as $item)
                                                <option value="{{ $item->id }}" @selected(collect(old('permissions'))->contains($item->id))>
                                                    {{ permission($item->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('permissions'))
                                            <div class="invalid-feedback">{{ $errors->first('permissions') }}</div>
                                        @elseif ($errors->has('permissions.*'))
                                            <div class="invalid-feedback">{{ $errors->first('permissions.*') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-9 ml-lg-auto">
                                    <button type="submit" class="btn btn-primary mr-2">Yadda saxla</button>
                                    <a href="{{ route('backend.roles.index') }}" class="btn btn-light-primary">Geri qayıt</a>
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
        $('select[name="permissions[]"]').select2({placeholder: 'İcazələr seçin'})
    </script>
@endsection
