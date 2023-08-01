@php
$user = Auth::user();

$name = trim(collect(explode(' ', $user->name))->map(function ($segment) {
    return mb_substr($segment, 0, 1);
})->join(' '));

$default_pic = 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
@endphp

<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="#" class="logo logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('images') }}/blog.png" alt="logo-dark" height="60">
                    </span>
                </a>

                <a href="#" class="logo logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('images') }}/blog.png" alt="logo-light" height="60">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ Auth::user()->profile_photo_path ?  asset('storage\/') . Auth::user()->profile_photo_path : $default_pic }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('profile.show') }}"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ri-logout-box-r-line me-1"></i> Logout</a>
                    <form action="{{ url('logout') }}" method="POST" style="display: none;" id="logout-form">
                        @csrf
                        <input type="submit" value="Logout">
                    </form>    
                </div>
            </div>

        </div>
    </div>
</header>