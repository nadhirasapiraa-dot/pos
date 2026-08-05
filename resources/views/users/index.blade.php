@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')

<div class="kpd-page-header">
    <div>
        <h3>Data Pengguna</h3>
        <p><i class="bi bi-people me-1"></i>Kelola akun admin & kasir</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-kpd-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Pengguna
    </a>
</div>

<div class="kpd-card">
    <div class="kpd-card-body pb-0">
        <form action="{{ route('admin.users') }}" method="GET">
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="form-control" placeholder="Cari nama atau email...">
                <button class="btn btn-outline-kpd" type="submit">Cari</button>
            </div>
        </form>
    </div>

    <div class="kpd-card-body">
        <div class="table-responsive">
            <table class="table kpd-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $users->firstItem() + $loop->index }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="kpd-user-avatar" style="width:32px;height:32px;font-size:.72rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="fw-semibold">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $user->role->name === 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                                {{ ucfirst($user->role->name) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-kpd btn-sm">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin hapus user ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="kpd-card-body pt-0">
        {{ $users->links() }}
    </div>
</div>
@endsection
