<style>
    /* Latar belakang Sidebar */
    .bg-menu-theme {
        background-color: #0d2b5e !important;
        color: #e4e6eb !important;
    }
    .layout-menu {
        display: flex !important;
        flex-direction: column !important;
        height: 100% !important;
    }
    .menu-inner {
        flex-grow: 1;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .menu-footer {
        padding: 15px;
        background-color: rgba(0, 0, 0, 0.2); /* Sedikit lebih gelap */
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        flex-shrink: 0;
    }

    /* Styling Teks Profile di Footer */
    .user-profile-name {
        color: #ffffff;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .user-profile-role {
        color: #b0c4de;
        font-size: 0.75rem;
    }

    /* Warna Teks Menu Normal */
    .bg-menu-theme .menu-link {
        color: #b0c4de !important;
    }

    /* Warna Icon Menu Normal */
    .bg-menu-theme .menu-icon {
        color: #b0c4de !important;
    }

    /* Hover State */
    .bg-menu-theme .menu-link:hover,
    .bg-menu-theme .menu-item.active > .menu-link:not(.menu-toggle) {
        background-color: rgba(255, 255, 255, 0.1) !important;
        color: #ffffff !important;
    }

    /* Active State  */
    .bg-menu-theme .menu-item.active > .menu-link {
        color: #ffffff !important;
        font-weight: 600;
    }

    .bg-menu-theme .menu-item.active .menu-icon {
        color: #ffffff !important;
    }

    /* Submenu */
    .bg-menu-theme .menu-sub > .menu-item > .menu-link {
        color: #b0c4de !important;
    }

    .bg-menu-theme .menu-sub > .menu-item.active > .menu-link:not(.menu-toggle) {
        background-color: transparent !important;
        color: #ffffff !important;
        position: relative;
    }

    .bg-menu-theme .menu-sub > .menu-item.active > .menu-link:before {
        background-color: #ffffff !important;
        box-shadow: 0 0 5px rgba(255,255,255,0.8);
    }

    .bg-menu-theme .menu-header-text {
        color: #6c8caf !important;
        font-weight: 700;
        letter-spacing: 1px;
    }

    /* Garis pemisah bayangan */
    .menu-inner-shadow {
        background: linear-gradient(#0d2b5e 41%, rgba(13, 43, 94, 0.11) 95%, rgba(13, 43, 94, 0)) !important;
    }

    /* Dropdown menu style fix */
    .menu-footer .dropdown-menu {
        background-color: #ffffff;
        min-width: 200px;
    }
</style>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="app-brand demo" style="height: 80px; background-color: #0a224a;">
        <a href="{{ route('home') }}" class="app-brand-link">
            <img src="{{ asset('logo-black.png') }}" alt="{{ config('app.name') }}" width="35" style="invert(1);">
            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="color: #ffffff; text-transform: uppercase; font-size: 1.2rem;">
                E-Arsip Surat
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle" style="color: white;"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="{{ __('menu.home') }}">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Persuratan</span>
        </li>

        <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('transaction.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-mail-send"></i>
                <div data-i18n="{{ __('menu.transaction.menu') }}">{{ __('menu.transaction.menu') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('transaction.incoming.*') || \Illuminate\Support\Facades\Route::is('transaction.disposition.*') ? 'active' : '' }}">
                    <a href="{{ route('transaction.incoming.index') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.transaction.incoming_letter') }}">{{ __('menu.transaction.incoming_letter') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('transaction.outgoing.*') ? 'active' : '' }}">
                    <a href="{{ route('transaction.outgoing.index') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.transaction.outgoing_letter') }}">{{ __('menu.transaction.outgoing_letter') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('agenda.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                <div data-i18n="{{ __('menu.agenda.menu') }}">{{ __('menu.agenda.menu') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('agenda.incoming') ? 'active' : '' }}">
                    <a href="{{ route('agenda.incoming') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.agenda.incoming_letter') }}">{{ __('menu.agenda.incoming_letter') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('agenda.outgoing') ? 'active' : '' }}">
                    <a href="{{ route('agenda.outgoing') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.agenda.outgoing_letter') }}">{{ __('menu.agenda.outgoing_letter') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Arsip Digital</span>
        </li>

        <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('gallery.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-images"></i>
                <div data-i18n="{{ __('menu.gallery.menu') }}">{{ __('menu.gallery.menu') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('gallery.incoming') ? 'active' : '' }}">
                    <a href="{{ route('gallery.incoming') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.gallery.incoming_letter') }}">{{ __('menu.gallery.incoming_letter') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('gallery.outgoing') ? 'active' : '' }}">
                    <a href="{{ route('gallery.outgoing') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.gallery.outgoing_letter') }}">{{ __('menu.gallery.outgoing_letter') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        @if(auth()->user()->role == 'admin')
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Pengaturan</span>
            </li>

            <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('reference.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-data"></i> <div data-i18n="{{ __('menu.reference.menu') }}">{{ __('menu.reference.menu') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('reference.classification.*') ? 'active' : '' }}">
                        <a href="{{ route('reference.classification.index') }}" class="menu-link">
                            <div data-i18n="{{ __('menu.reference.classification') }}">{{ __('menu.reference.classification') }}</div>
                        </a>
                    </li>
                    <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('reference.status.*') ? 'active' : '' }}">
                        <a href="{{ route('reference.status.index') }}" class="menu-link">
                            <div data-i18n="{{ __('menu.reference.status') }}">{{ __('menu.reference.status') }}</div>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('user.*') ? 'active' : '' }}">
                <a href="{{ route('user.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-pin"></i>
                    <div data-i18n="{{ __('menu.users') }}">{{ __('menu.users') }}</div>
                </a>
            </li>
        @endif
    </ul>
    <div class="menu-footer">
        <div class="dropup d-flex align-items-center justify-content-center">
            <a class="nav-link w-100 dropdown-toggle hide-arrow p-0 d-flex align-items-center" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online me-3">
                    <img src="{{ auth()->user()->profile_picture }}" alt class="w-px-40 h-auto rounded-circle"
                        style="border: 2px solid #e7e7e7; padding: 2px;" />
                </div>
                <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                    <span class="user-profile-name text-truncate">{{ auth()->user()->name }}</span>
                    <small class="user-profile-role text-truncate text-capitalize">{{ auth()->user()->role }}</small>
                </div>
                <i class="bx bx-chevron-up text-white ms-2"></i>
            </a>

            <ul class="dropdown-menu shadow-lg">
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                    <img src="{{ auth()->user()->profile_picture }}" alt
                                        class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-semibold d-block text-dark">{{ auth()->user()->name }}</span>
                                <small class="text-muted text-capitalize">{{ auth()->user()->role }}</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                        <i class="bx bx-user me-2 text-primary"></i>
                        <span class="align-middle">{{ __('navbar.profile.profile') }}</span>
                    </a>
                </li>

                @if (auth()->user()->role == 'admin')
                    <li>
                        <a class="dropdown-item" href="{{ route('settings.show') }}">
                            <i class="bx bx-cog me-2 text-warning"></i>
                            <span class="align-middle">{{ __('navbar.profile.settings') }}</span>
                        </a>
                    </li>
                @endif

                <li>
                    <div class="dropdown-divider"></div>
                </li>

                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="dropdown-item cursor-pointer text-danger">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle fw-bold">{{ __('navbar.profile.logout') }}</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</aside>
