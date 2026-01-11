<footer class="content-footer footer bg-footer-theme">
    <style>
        .footer {
            border-top: 1px solid #e1e4e8; /* Garis pemisah tipis */
            box-shadow: 0 -2px 10px rgba(0,0,0,0.02); /* Sedikit bayangan ke atas */
        }
        .footer-link {
            color: #697a8d;
            transition: all 0.3s;
        }
        .footer-link:hover {
            color: #0d47a1; /* Hover Biru BKAD */
            text-decoration: none;
        }
        .heart-icon {
            color: #ff3e1d; /* Merah hati */
            animation: heartbeat 1.5s infinite;
        }

        @keyframes heartbeat {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>

    <div class="container-xxl d-flex flex-wrap justify-content-between py-3 flex-md-row flex-column">

        <div class="mb-2 mb-md-0">
            <span class="fw-semibold">
                &copy; {{ date('Y') }}
            </span>
            <a href="#" class="footer-link fw-bolder">
                {{ config('app.name') }} </a>
            <span class="text-muted"> | Badan Keuangan & Aset Daerah</span>
        </div>

        <div>
            <span class="text-muted small me-1">v1.0.0</span>
            <span class="text-muted">Developed with</i> by</span>
            <a href="https://github.com/penoFahmi" target="_blank" class="footer-link fw-bold">
                penoFahmi remake 404 Not Found Indonesia
            </a>
            </div>
    </div>
</footer>
