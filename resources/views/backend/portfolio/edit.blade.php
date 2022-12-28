@extends('layouts.backend')
@section('title', 'Portfolio')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom example example-compact">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">Portfolio</h3>
                        </div>
                    </div>
                    <form action="{{ route('backend.portfolio.update', $portfolio) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3 col-sm-12">
                                    Başlıq <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $portfolio) }}" placeholder="Başlıq daxil edin">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3 col-sm-12">
                                    Açıqlama <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <div class="input-group">
                                        <textarea class="@error('description') is-invalid @enderror" name="description">{!! old('description', $portfolio) !!}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3 col-sm-12">Əsas şəkil</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" accept=".jpg,.jpeg,.png,.jfif">
                                            <label class="custom-file-label">Əsas şəkil seçin</label>
                                        </div>
                                        @error('image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3 col-sm-12">Digər şəkillər</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @if($errors->has('images') || $errors->has('images.*')) is-invalid @endif" name="images[]" accept=".jpg,.jpeg,.png,.jfif" multiple>
                                            <label class="custom-file-label">Digər şəkillər seçin</label>
                                        </div>
                                        @if ($errors->has('images'))
                                            <div class="invalid-feedback">{{ $errors->first('images') }}</div>
                                        @elseif ($errors->has('images.*'))
                                            <div class="invalid-feedback">{{ $errors->first('images.*') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3 col-sm-12"></label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <div class="input-group">
                                        <input class="form-control @error('delete_images') is-invalid @enderror" placeholder="Silmək istədiyiniz şəkilləri seçin" disabled>
                                        @error('delete_images')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @foreach ($portfolio->photos as $item)
                                <div class="form-group row">
                                    <label class="col-form-label text-right col-lg-3 col-sm-12">
                                        <div class="checkbox-list">
                                            @php $checked = false @endphp
                                            @if (is_array(old('delete_images')) && in_array($item->id, old('delete_images')))
                                                @php $checked = true @endphp
                                            @endif
                                            <label class="checkbox checkbox-lg checkbox-danger ml-auto">
                                                <input type="checkbox" name="delete_images[]" value="{{ $item->id }}" @checked($checked) multiple>
                                                <span class="mr-0"></span>
                                            </label>
                                        </div>
                                    </label>
                                    <div class="col-lg-6 col-md-9 col-sm-12">
                                        <img src="{{ asset("uploads/portfolio/$item->image") }}" class="d-block w-100">
                                    </div>
                                </div>
                            @endforeach
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3 col-sm-12">
                                    Kateqoriya <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <div class="input-group">
                                        <select class="form-control select-2 @error('category_id') is-invalid @enderror" name="category_id">
                                            <option value=""></option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" @selected(old('category_id', $portfolio) == $item->id)>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3 col-sm-12">
                                    Sıra <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <div class="input-group">
                                        <input type="number" class="form-control @error('order') is-invalid @enderror" name="order" value="{{ old('order', $portfolio) }}" placeholder="Sıra daxil edin">
                                        @error('order')
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
                                            <option value="1" @selected(old('status', $portfolio) == 1)>Aktiv</option>
                                            <option value="0" @selected(old('status', $portfolio) == 0 && is_numeric(old('status', $portfolio)))>Deaktiv</option>
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
                                    <a href="{{ route('backend.portfolio.index') }}" class="btn btn-light-primary">Geri qayıt</a>
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
        $('textarea[name="description"]').summernote({height: 300})
        $('select[name="category_id"]').select2({placeholder: 'Kateqoriya seçin'})
        $('select[name="status"]').select2({placeholder: 'Status seçin'})
    </script>
@endsection
