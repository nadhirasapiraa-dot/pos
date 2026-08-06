@csrf

<div class="mb-3">
    <label class="form-label small fw-semibold">Nama</label>
    <input type="text" name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $user->name ?? '') }}" placeholder="Nama lengkap">
           @error('name')
               <div class="invalid-feedback">{{ $message }}</div>
           @enderror
</div>

<div class="mb-3">
    <label class="form-label small fw-semibold">Email</label>
    <input type="email" name="email"
           class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $user->email ?? '') }}" placeholder="nama@koperasi.desa">
           @error('email')
               <div class="invalid-feedback">{{ $message }}</div>
           @enderror
</div>

<div class="mb-3">
    <label class="form-label small fw-semibold">
        Password @isset($user) <span class="text-muted fw-normal">(kosongkan jika tidak diubah)</span> @endisset
    </label>
    <input type="password" name="password"
           class="form-control @error('password') is-invalid @enderror"
           placeholder="{{ isset($user) ? '••••••••' : 'Minimal 8 karakter' }}">
           @error('password')
               <div class="invalid-feedback">{{ $message }}</div>
           @enderror
</div>

<div class="mb-3">
    <label class="form-label small fw-semibold">Role</label>
    <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
        <option value="">-- Pilih Role --</option>
    @foreach($roles as $role)
    <option value="{{ $role->id }}"
        @selected(old('role_id', $user->role_id ?? '') == $role->id)>
        {{ ucfirst($role->name) }}
    </option>
    @endforeach
    </select>
        @error('role_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex gap-2">
    <button class="btn btn-kpd-primary px-4 ">
        <i class="bi bi-check-lg me-1"></i> Simpan
    </button>
</div>
