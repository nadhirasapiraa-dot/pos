@csrf

<div class="row g-4">
    <div class="col-md-4">
        <label class="form-label small fw-semibold">Foto Produk</label>

        <div class="border rounded-3 p-3 text-center bg-light mb-2">
            @if (!empty($produk->foto))
                <img src="{{ asset('storage/' . $produk->foto) }}"
                     id="preview"
                     class="img-fluid rounded-3 mb-2" style="max-height:180px; object-fit:cover">
            @else
                <img id="preview" class="img-fluid rounded-3 mb-2" style="display:none; max-height:180px; object-fit:cover">
                <div id="previewPlaceholder" class="text-muted py-4">
                    <i class="bi bi-image" style="font-size:2rem;"></i>
                    <div class="small mt-1">Belum ada foto</div>
                </div>
            @endif
        </div>

        <input type="file"
               name="foto"
               onchange="previewImage(this)"
               class="form-control @error('foto') is-invalid @enderror">
        @error('foto')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
        <div class="form-text">JPG/JPEG/PNG, maksimal 2MB.</div>
    </div>

    <div class="col-md-8">
        <div class="mb-3">
            <label class="form-label small fw-semibold">Jenis / Kategori Item</label>
            <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                <option value="">-- Pilih Jenis Item --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ old('kategori_id', $produk->kategori_id ?? '') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Nama Produk</label>
            <input type="text" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $produk->nama ?? '') }}"
                   placeholder="Misal: Beras Premium 5kg">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-sm-4 mb-3">
                <label class="form-label small fw-semibold">Harga Beli</label>
                <div class="input-group">
                    <span class="input-group-text bg-white">Rp</span>
                    <input type="number" name="purchase_price"
                           class="form-control @error('purchase_price') is-invalid @enderror"
                           value="{{ old('purchase_price', $produk->harga_beli ?? '') }}">
                </div>
                @error('purchase_price')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-4 mb-3">
                <label class="form-label small fw-semibold">Harga Jual</label>
                <div class="input-group">
                    <span class="input-group-text bg-white">Rp</span>
                    <input type="number" name="selling_price"
                           class="form-control @error('selling_price') is-invalid @enderror"
                           value="{{ old('selling_price', $produk->harga_jual ?? '') }}">
                </div>
                @error('selling_price')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-4 mb-3">
                <label class="form-label small fw-semibold">Stok</label>
                <input type="number" name="stock"
                       class="form-control @error('stock') is-invalid @enderror"
                       value="{{ old('stock', $produk->stok ?? '') }}">
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-flex gap-2 mt-3">
            <button class="btn btn-kpd-primary px-4" type="submit">
                <i class="bi bi-check-lg me-1"></i> Simpan
            </button>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('previewPlaceholder');
    const file = input.files[0];

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
        if (placeholder) placeholder.style.display = 'none';
    }
}
</script>
