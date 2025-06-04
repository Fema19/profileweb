@extends('admin.layouts.app')

@section('content')
<form action="{{ route('admin.profiles.update', $profile->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Profile</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $profile->name) }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="bio_id">Bio (Bahasa Indonesia)</label>
                        <textarea class="form-control" name="bio_id" rows="4" required>{{ old('bio_id', $bio_id) }}</textarea>
                        @error('bio_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <small class="form-text text-muted">Isi bio dalam bahasa Indonesia, akan otomatis diterjemahkan ke bahasa Inggris dan Jerman.</small>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('admin.profiles.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
