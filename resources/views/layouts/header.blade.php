<header class="main-header">
    <div class="header-left">
        <a href="{{ url('/') }}" class=" logo-odedis">
            <img src="{{ asset('img/logoOdedis.png') }}" alt="ODEDIS Logo">
        </a>

        <span class="divider"></span>


    </div>
    <nav class="main-nav">
        <ul>
            <li><a href="#">Nos services<span class="chevron"></span></a></li>
            <li><a href="#">Offres et tarifs</a></li>
            <li><a href="#">Notre Écosystème <span class="chevron"></span></a></li>
            <li><a href="#">Support <span class="chevron"></span></a></li>

        </ul>
    </nav>
    <div class="uhf-search-container" style="display: none;">
        <!--?lit$109087524$-->
        <form>
            <input type="search" autocomplete="off" role="combobox" tabindex="0"
                aria-controls="uhf-autosuggest-popout" itemprop="query-input">
            <button type="submit">
                <uhf-icon iconname="Search" size="16"><!---->
                    <i class="ms-Icon ms-Icon--Search" style="font-size: 16px;"></i>
                </uhf-icon>
            </button>
        </form>
        <button class="uhf-search-cancel"> Annuler
        </button>

    </div>
    <div class="header-right">
        <button class="search-btn" aria-label="Rechercher">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>

        <a href="#" class="btn-try">Demander un devis</a>
        {{-- GUEST --}}
        @guest
        <a href="{{ route('login') }}" class="btn-login">
            <div class="user-avatar">ME</div>
        </a>

        @endguest

        {{-- AUTH --}}
        @auth
        <div class="dropdown">
            <button class="dropbtn">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
            </button>
            <div class="dropdown-content">
                <a href="{{ route('profile.edit') }}"> Mon profil </a>
                <a href="{{ route('dashboard') }}">
                    Dashboard
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                </form>

                <a href="{{ route('logout') }}"
                    class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Déconnexion
                </a>
            </div>
        </div>

        @endauth

    </div>
</header>