<div class="mb-4">
    <label for="{{ $name }}" class="form-label fw-bold text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
        {{ $label }}
    </label>

    <div class="input-group input-group-merge">
        <textarea
            class="form-control px-3 py-3 @error($name) is-invalid @enderror"
            id="{{ $name }}"
            name="{{ $name }}"
            rows="4"
            placeholder="Ketik {{ strtolower($label) }} di sini..."
            style="resize: vertical; min-height: 100px; border-radius: 6px; background-color: #fcfcfc;"
        >{{ old($name, $value ?? '') }}</textarea>
    </div>

    @error($name)
        <div class="invalid-feedback d-block mt-1">
            <i class="bx bx-error-circle me-1"></i> {{ $message }}
        </div>
    @enderror
</div>

<style>
    /* Mengubah warna border saat diklik menjadi Biru BKAD */
    textarea.form-control:focus {
        border-color: #0d47a1 !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 71, 161, 0.15) !important;
        background-color: #ffffff !important;
    }

    /* Placeholder text style */
    textarea.form-control::placeholder {
        color: #b5b5c3;
        font-style: italic;
        font-size: 0.9rem;
    }
</style>
