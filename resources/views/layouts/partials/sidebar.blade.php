<nav class="sidebar dark_sidebar">
    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href="#"><img src="{{ asset('img/logo_sgi_white.png') }}" alt></a>
        <a class="small_logo" href="#"><img src="{{ asset('img/mini_logo.png') }}" alt></a>
    </div>

    <ul id="sidebar_menu">

        <li class>
            <a href="{{ route('adminHomePage') }}" class="{{ request()->is('administration/dashboard') ? 'active' : '' }}">
                <div class="nav_icon_small">
                    <img src="{{asset('img/menu-icon/dashboard.svg')}}" alt>
                </div>
                <div class="nav_title">
                    <span>Accueil </span>
                </div>
            </a>
        </li>

        <li class="{{ request()->routeIs('direction.*') ? 'mm-active' : '' }}">
            <a class="has-arrow" href="#" aria-expanded="{{ request()->routeIs('direction.*') ? 'true' : 'false' }}">
                <div class="nav_icon_small">
                    <img src="{{asset('img/menu-icon/6.svg')}}" alt>
                </div>
                <div class="nav_title">
                    <span>Gestion des Directions </span>
                </div>
            </a>
            <ul class="{{ request()->routeIs('direction.*') ? 'mm-collapse mm-show' : 'mm-collapse' }}">
                <li>
                    <a href="{{ route('direction.create') }}" class="{{ request()->routeIs('direction.create') ? 'active' : '' }}">Ajouter</a>
                </li>
                <li>
                    <a href="{{ route('direction.index') }}"  class="{{ request()->routeIs('direction.index') ? 'active' : '' }}">Afficher</a>
                </li>
            </ul>
        </li>

        <li class="{{ request()->routeIs('courriers-arrives.*', 'chrono-arrive.*', 'type-instruction.*') || request()->is('courriers-arrives/imputation*') ? 'mm-active' : '' }}">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('img/menu-icon/8.svg') }}" alt>
                </div>
                <div class="nav_title">
                    <span>Courriers Arrivés</span>
                </div>
            </a>
            <ul class="{{ request()->routeIs('courriers-arrives.*', 'chrono-arrive.*', 'type-instruction.*') || request()->is('courriers-arrives/imputation*') ? 'mm-collapse mm-show' : 'mm-collapse' }}">
                <li><a href="{{ route('chrono-arrive.index') }}" class="{{ request()->routeIs('chrono-arrive.*') ? 'active' : '' }}">Chronos</a></li>
                <li><a href="{{ route('type-instruction.index') }}" class="{{ request()->routeIs('type-instruction.*') ? 'active' : '' }}">Instructions</a></li>
                <li><a href="{{ route('courriers-arrives.create') }}" class="{{ request()->routeIs('courriers-arrives.create') ? 'active' : '' }}">Nouveau courrier</a></li>
                <li><a href="{{ route('courriers-arrives.index') }}" class="{{ request()->routeIs('courriers-arrives.index') || request()->is('courriers-arrives/imputation*') ? 'active' : '' }}">Afficher</a></li>
            </ul>
        </li>

        <li class="{{ request()->is('chrono-depart.*') ? 'mm-active' : '' }}">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('img/menu-icon/7.svg') }}" alt>
                </div>
                <div class="nav_title">
                    <span>Courriers Départs</span>
                </div>
            </a>
            <ul class="{{ request()->is('chrono-depart.*') ? 'mm-collapse mm-show' : '' }}">
                <li><a href="{{ route('chrono-depart.index') }}">Chrono</a></li>
                <li><a href="#">Nouveau courrier</a></li>
                <li><a href="#">Afficher</a></li>
            </ul>
        </li>

        <li class="{{ request()->routeIs('utilisateurs.*') ? 'mm-active' : '' }}">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('img/menu-icon/5.svg') }}" alt>
                </div>
                <div class="nav_title">
                    <span>Gestion des utilisateurs</span>
                </div>
            </a>
            <ul class="{{ request()->routeIs('utilisateurs.*') ? 'mm-collapse mm-show' : 'mm-collapse' }}">
                <li><a href="{{ route('utilisateurs.create') }}" class="{{ request()->routeIs('utilisateurs.create') ? 'active' : '' }}">Ajouter</a></li>
                <li><a href="{{ route('utilisateurs.index') }}" class="{{ request()->routeIs('utilisateurs.index') ? 'active' : '' }}">Afficher</a></li>
                <li><a href="add_new_user.html">Historique</a></li>
            </ul>
        </li>

    </ul>
</nav>
