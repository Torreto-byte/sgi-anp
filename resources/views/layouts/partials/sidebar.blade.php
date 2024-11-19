<nav class="sidebar dark_sidebar">
    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href="#"><img src="{{ asset('img/logo_sgi_white.png') }}" alt></a>
        <a class="small_logo" href="#"><img src="{{ asset('img/mini_logo.png') }}" alt></a>
    </div>

    <ul id="sidebar_menu">

        <li class>
            <a href="{{ route('adminHomePage') }}" class="{{ request()->is('administration/dashboard') ? 'active' : '' }}">
                <div class="nav_icon_small">
                    <i class="ti-home" style="font-size: 20px"></i>
                </div>
                <div class="nav_title">
                    <span>Accueil </span>
                </div>
            </a>
        </li>

        <li class="{{ request()->routeIs('direction.*') ? 'mm-active' : '' }}">
            <a class="has-arrow" href="#" aria-expanded="{{ request()->routeIs('direction.*') ? 'true' : 'false' }}">
                <div class="nav_icon_small">
                    <i class="ti-briefcase" style="font-size: 20px"></i>
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
                    <i class="ti-import" style="font-size: 20px"></i>
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

        <li class="{{ request()->routeIs('courriers-departs.*', 'chrono-depart.*') ? 'mm-active' : '' }}">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <i class="ti-export" style="font-size: 20px"></i>
                </div>
                <div class="nav_title">
                    <span>Courriers Départs</span>
                </div>
            </a>
            <ul class="{{ request()->routeIs('courriers-departs.*', 'chrono-depart.*') ? 'mm-collapse mm-show' : '' }}">
                <li><a href="{{ route('chrono-depart.index') }}" class="{{ request()->routeIs('chrono-depart.*') ? 'active' : '' }}">Chrono</a></li>
                <li><a href="{{ route('courriers-departs.create') }}" class="{{ request()->routeIs('courriers-departs.create') ? 'active' : '' }}">Nouveau courrier</a></li>
                <li><a href="{{ route('courriers-departs.index') }}" class="{{ request()->routeIs('courriers-departs.index') ? 'active' : '' }}">Afficher</a></li>
            </ul>
        </li>

        <li class="{{ request()->is('archives/courriers-arrives')
            || request()->is('archives/courriers-arrives/details*')
            || request()->is('archives/courriers-departs')
            || request()->is('archives/courriers-departs/details*') ? 'mm-active' : '' }}"
        >
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <i class="ti-archive" style="font-size: 20px"></i>
                </div>
                <div class="nav_title">
                    <span>Archives</span>
                </div>
            </a>
            <ul class="{{ request()->is('archives/courriers-arrives')
            || request()->is('archives/courriers-arrives/details*') || request()->is('archives/courriers-departs') ? 'mm-collapse mm-show' : 'mm-collapse' }}">
                <li>
                    <a href="{{ route('archiveArrive') }}" class="{{ request()->is('archives/courriers-arrives')
                    || request()->is('archives/courriers-arrives/details*') ? 'active' : '' }}">Courriers Arrivés</a>
                </li>
                <li>
                    <a href="{{ route('archiveDepart') }}"  class="{{ request()->is('archives/courriers-departs')
                    || request()->is('archives/courriers-departs/details*') ? 'active' : '' }}">Courriers départs</a>
                </li>
            </ul>
        </li>

        <li class="{{ request()->routeIs('utilisateurs.*') || request()->is('administration/utilisateurs/historiques') ? 'mm-active' : '' }}">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <i class="ti-user" style="font-size: 20px"></i>
                </div>
                <div class="nav_title">
                    <span>Gestion des utilisateurs</span>
                </div>
            </a>
            <ul class="{{ request()->routeIs('utilisateurs.*') || request()->is('administration/utilisateurs/historiques') ? 'mm-collapse mm-show' : 'mm-collapse' }}">
                <li><a href="{{ route('utilisateurs.create') }}" class="{{ request()->routeIs('utilisateurs.create') ? 'active' : '' }}">Ajouter</a></li>
                <li><a href="{{ route('utilisateurs.index') }}" class="{{ request()->routeIs('utilisateurs.index') ? 'active' : '' }}">Afficher</a></li>
                <li><a href="{{ route('historyUtulisateur') }}" class="{{ request()->is('administration/utilisateurs/historiques') ? 'active' : '' }}">Historique</a></li>
            </ul>
        </li>

    </ul>
</nav>
