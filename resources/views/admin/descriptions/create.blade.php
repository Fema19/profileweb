@extends('admin.layouts.app')

@section('content')
    <form action="{{ route('admin.descriptions.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Deskripsi Baru</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" value="{{ old('slug') }}" required>
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title">Judul Portofolio</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="link">Link Website (contoh: https://example.com)</label>
                            <input type="url" class="form-control" name="link" value="{{ old('link') }}">
                            @error('link')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content_id">Konten (Bahasa Indonesia)</label>
                            <textarea class="form-control" name="content_id" rows="5" required>{{ old('content_id') }}</textarea>
                            @error('content_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.descriptions.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
