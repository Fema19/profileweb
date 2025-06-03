@extends('admin.layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Data Deskripsi</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Manajemen Deskripsi</h6>
                <a href="{{ route('admin.descriptions.create') }}" class="btn btn-primary">Tambah Deskripsi</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Slug</th>
                                <th>Link</th>
                                <th>Konten (ID)</th>
                                <th>Konten (EN)</th>
                                <th>Konten (DE)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($descriptions as $item)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>
                                        @if ($item->link)
                                            <a href="{{ $item->link }}" target="_blank" rel="noopener noreferrer">Lihat Website</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $item->translation('id')->content ?? '-' }}</td>
                                    <td>{{ $item->translation('en')->content ?? '-' }}</td>
                                    <td>{{ $item->translation('de')->content ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.descriptions.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.descriptions.destroy', $item->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
