@extends('admin.layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Data Profile</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Manajemen Profile</h6>
                <a href="{{ route('admin.profiles.create') }}" class="btn btn-primary">Tambah Profile</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Bio (ID)</th>
                                <th>Bio (EN)</th>
                                <th>Bio (DE)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($profiles as $item)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->translation('id')->bio ?? '-' }}</td>
                                    <td>{{ $item->translation('en')->bio ?? '-' }}</td>
                                    <td>{{ $item->translation('de')->bio ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.profiles.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.profiles.destroy', $item->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
