<footer class="content-footer footer bg-footer-theme">
    <style>
        .footer {
            border-top: 1px solid #e1e4e8;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.02);
        }
        .footer-link {
            color: #697a8d;
            transition: all 0.3s;
        }
        .footer-link:hover {
            color: #0d47a1;
            text-decoration: none;
        }
        .heart-icon {
            color: #ff3e1d;
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
            <span class="text-muted"> | {{ $config['institution_name'] }}</span>
        </div>

        <div>
            <span class="text-muted small me-1">v1.0.0</span>
            <span class="text-muted">Developed with</i> by</span>
            <a href="https://github.com/penoFahmi" target="_blank" class="footer-link fw-bold">
                Peno
            </a>
            </div>
    </div>
</footer>
