<style>
    .option{
        background: rgb(247, 62, 62)
    }
</style>
<nav class="sidebar dark_sidebar">
    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href="#"><img src="{{ asset('img/logo_sgi_white.png') }}" alt></a>
        <a class="small_logo" href="#"><img src="{{ asset('img/mini_logo.png') }}" alt></a>
    </div>

    <ul id="sidebar_menu">

        <li class>
            <a href="{{ route('courrierHomePage') }}" class="{{ request()->is('agent/dashboard') ? 'active' : '' }}">
                <div class="nav_icon_small">
                    <i class="ti-home" style="font-size: 20px"></i>
                </div>
                <div class="nav_title">
                    <span>Accueil </span>
                </div>
            </a>
        </li>

        @if (session()->get('role_id') == 3)
            <li class>
                <a href="{{ route('courrier-arrive.index') }}" class="{{ request()->routeIs('courrier-arrive.index') || request()->is('courrier-arrive/imputation*') ? 'active' : '' }}">
                    <div class="nav_icon_small">
                        <i class="ti-bookmark" style="font-size: 20px"></i>
                    </div>
                    <div class="nav_title">
                        <span>Courriers Arrivés</span>
                    </div>
                </a>
            </li>
        @endif

        @if (session()->get('role_id') == 2)

            <li class>
                <a href="{{ route('chrono-arrive.index') }}" class="{{ request()->routeIs('chrono-arrive.*') ? 'active' : '' }}">
                    <div class="nav_icon_small">
                        <i class="ti-timer" style="font-size: 20px"></i>
                    </div>
                    <div class="nav_title">
                        <span>Chronos Arrivés</span>
                    </div>
                </a>
            </li>

            <li class>
                <a href="{{ route('courrier-arrive.create') }}" class="{{ request()->routeIs('courrier-arrive.create') ? 'active' : '' }}">
                    <div class="nav_icon_small">
                        <i class="ti-import" style="font-size: 20px"></i>
                    </div>
                    <div class="nav_title">
                        <span>Nouveau Courrier Arrivé</span>
                    </div>
                </a>
            </li>

            <li class>
                <a href="{{ route('courrier-arrive.index') }}" class="{{ request()->routeIs('courrier-arrive.index') || request()->is('courrier-arrive/imputation*') ? 'active' : '' }}">
                    <div class="nav_icon_small">
                        <i class="ti-bookmark" style="font-size: 20px"></i>
                    </div>
                    <div class="nav_title">
                        <span>Liste Courriers Arrivés</span>
                    </div>
                </a>
            </li>
        @endif

        @if (session()->get('role_id') == 4)
            <li class>
                <a href="{{ route('chrono-depart.index') }}" class="{{ request()->routeIs('chrono-depart.*') ? 'active' : '' }}">
                    <div class="nav_icon_small">
                        <i class="ti-time" style="font-size: 20px"></i>
                    </div>
                    <div class="nav_title">
                        <span>Chronos Départs</span>
                    </div>
                </a>
            </li>

            <li class>
                <a href="{{ route('courrier-depart.create') }}" class="{{ request()->routeIs('courrier-depart.create') ? 'active' : '' }}">
                    <div class="nav_icon_small">
                        <i class="ti-export" style="font-size: 20px"></i>
                    </div>
                    <div class="nav_title">
                        <span>Nouveau Courrier Départ</span>
                    </div>
                </a>
            </li>

            <li class>
                <a href="{{ route('courrier-depart.index') }}" class="{{ request()->routeIs('courrier-depart.index') ? 'active' : '' }}">
                    <div class="nav_icon_small">
                        <i class="ti-bookmark-alt" style="font-size: 20px"></i>
                    </div>
                    <div class="nav_title">
                        <span>Liste Courriers Départs</span>
                    </div>
                </a>
            </li>

            @if (session()->get('agent_absent') == 1)
                <li class="option">
                    <a href="{{ route('courrier-arrive.index') }}" class="{{ request()->routeIs('courrier-arrive.index') || request()->is('courrier-arrive/imputation*') ? 'active' : '' }}">
                        <div class="nav_icon_small">
                            <i class="ti-import" style="font-size: 20px"></i>
                        </div>
                        <div class="nav_title">
                            <span>Liste Courriers Arrivés</span>
                        </div>
                    </a>
                </li>
            @endif
        @endif

        <li class="{{ request()->is('public/archives/courriers-arrives')
            || request()->is('public/archives/courriers-arrives/details*')
            || request()->is('public/archives/courriers-departs')
            || request()->is('public/archives/courriers-departs/details*') ? 'mm-active' : '' }}"
        >
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <i class="ti-archive" style="font-size: 20px"></i>
                </div>
                <div class="nav_title">
                    <span>Archives</span>
                </div>
            </a>
            <ul class="{{ request()->is('public/archives/courriers-arrives')
            || request()->is('public/archives/courriers-arrives/details*') || request()->is('public/archives/courriers-departs') ? 'mm-collapse mm-show' : 'mm-collapse' }}">
                <li>
                    <a href="{{ route('archiveArrivePublic') }}" class="{{ request()->is('public/archives/courriers-arrives')
                    || request()->is('public/archives/courriers-arrives/details*') ? 'active' : '' }}">Courriers Arrivés</a>
                </li>
                <li>
                    <a href="{{ route('archiveDepartPublic') }}"  class="{{ request()->is('public/archives/courriers-departs')
                    || request()->is('public/archives/courriers-departs/details*') ? 'active' : '' }}">Courriers départs</a>
                </li>
            </ul>
        </li>

    </ul>
</nav>
