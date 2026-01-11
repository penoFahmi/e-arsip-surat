<style>
    .navbar-detached {
        box-shadow: 0 0.375rem 1rem 0 rgba(161, 172, 184, 0.15) !important;
    }
    .search-input-wrapper {
        background-color: #f5f5f9; 
        border-radius: 20px;
        padding: 5px 15px;
        transition: all 0.3s ease;
    }
    .search-input-wrapper:focus-within {
        background-color: #fff;
        box-shadow: 0 0 0 2px rgba(13, 71, 161, 0.2);
    }
    .date-display {
        font-weight: 600;
        color: #566a7f;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }
</style>

<nav
    class="layout-navbar container-xxl zindex-5 navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar"
>
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <div class="d-none d-md-flex date-display me-4">
            <i class='bx bx-calendar'></i>
            <span>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
        </div>

        <form action="{{ url()->current() }}" class="d-flex align-items-center w-100" style="max-width: 400px;">
            <div class="navbar-nav align-items-center w-100">
                <div class="nav-item d-flex align-items-center w-100 search-input-wrapper">
                    <i class="bx bx-search fs-4 lh-0 text-muted"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-0 shadow-none bg-transparent"
                        placeholder="{{ __('navbar.search') }}..."
                        aria-label="{{ __('navbar.search') }}"
                    />
                </div>
            </div>
        </form>
        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ auth()->user()->profile_picture }}" alt class="w-px-40 h-auto rounded-circle" style="border: 2px solid #e7e7e7; padding: 2px;"/>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ auth()->user()->profile_picture }}" alt class="w-px-40 h-auto rounded-circle"/>
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

                    @if(auth()->user()->role == 'admin')
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
            </li>
            </ul>
    </div>
</nav>
