<div class="mb-3">
    <label for="{{ $name }}" class="form-label fw-bold text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
        {{ $label }}
    </label>

    <div class="input-group input-group-merge">
        <input
            type="{{ $type }}"
            class="form-control px-3 py-2 @error($name) is-invalid @enderror"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name, $value ?? '') }}"
            placeholder="{{ $placeholder ?? 'Masukan ' . strtolower($label) }}"
            style="border-radius: 6px;"
        />

        @error($name)
            <span class="input-group-text bg-transparent border-danger text-danger rounded-end">
                <i class="bx bx-error-circle"></i>
            </span>
        @enderror
    </div>

    @error($name)
        <div class="invalid-feedback d-block mt-1" style="font-size: 0.85rem;">
            {{ $message }}
        </div>
    @enderror
</div>

<style>
    /* Ubah warna border saat input diklik (Fokus) menjadi Biru BKAD */
    .form-control:focus {
        border-color: #0d47a1 !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 71, 161, 0.15) !important;
    }

    /* Ubah warna border saat Error menjadi Merah */
    .form-control.is-invalid:focus {
        border-color: #ff3e1d !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 62, 29, 0.15) !important;
    }
</style>
