<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ODEDIS</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>

    <header class="main-header">
        <div class="header-left">
            <a href="#" class="logo-odedis">
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
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>

            @endauth

        </div>
    </header>

    <main class="hero-container">
        <section class="hero-content">
            <h1>L'avenir digital de l'Afrique commence</h1>

            <p class="hero-description">
                ODEDIS accompagne les entreprises africaines dans leur transformation digitale grâce à une expertise
                pointue, un réseau de partenaires mondiaux et un engagement sans faille.</p>

            <div class="hero-buttons">
                <a href="#" class="btn btn-primary">contact Us</a>
                <a href="#" class="btn btn-secondary">Inscrivez-vous </a>
            </div>

            <div class="hero-footer-link">
                <a href="#">
                    <span class="pulse-badge">
                        <!-- <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg> -->
                    </span>

                    <div class="marquee-wrapper">
                        <div>
                            <span>Votre partenaire Digital de référence en Afrique</span>
                        </div>
                    </div>
                </a>
            </div>
        </section>
        <!-- <section class="hero-content-right">

            <div class="card-stack">
                <div class="info-card">
                    <h4>Transformation Digitale</h4>
                    <p>Stratégie cloud, gouvernance SI, maturité digitale — nous bâtissons votre feuille de route.</p>
                </div>
                <div class="info-card">
                    <h4>Cybersécurité</h4>
                    <p>Audit, tests d'intrusion, protection des données et formation aux bonnes pratiques.</p>
                </div>
                <div class="info-card">
                    <h4>Capital Humain</h4>
                    <p>Formation, certification et montée en compétences de vos équipes IT.</p>

                </div>
                <div class="info-card">
                    <h4>Intégration</h4>
                    <p>Cloud, Datacenter hybride, cybersécurité, réseaux et protection des données.</p>

                </div>
            </div>

        </section> -->


        <section class="hero-content-right">

            <video class="bg-video" autoplay muted loop playsinline>
                <source src="{{ asset('/video-animate/background.mp4') }}" type="video/mp4">
            </video>

            <div class="overlay"></div>

            <div class="card-stack">
                <div class="info-card">
                    <h4>Transformation Digitale</h4>
                    <p>Stratégie cloud, gouvernance SI, maturité digitale.</p>
                </div>

                <div class="info-card">
                    <h4>Cybersécurité</h4>
                    <p>Audit, tests d'intrusion et protection des données.</p>
                </div>

                <div class="info-card">
                    <h4>Capital Humain</h4>
                    <p>Formation et montée en compétences IT.</p>
                </div>

                <div class="info-card">
                    <h4>Intégration</h4>
                    <p>Cloud, réseaux et infrastructures hybrides.</p>
                </div>
            </div>

        </section>
        <section class="hero-visual">
        </section>
    </main>
    <section class="clients-section">
        <div class="clients-header">
            <h2>Partenaires Technologiques</h2>
            <p>
                Les leaders technologiques mondiaux
            </p>
        </div>

        <div class="clients-grid">
            <img src="{{ asset('/img/Partenaires/Microsoft/Microsoft.png') }}" alt="">
            <img src="{{ asset('/img/Partenaires/Microsoft/Microsoft.png') }}" alt="">
            <img src="{{ asset('/img/Partenaires/Microsoft/Microsoft.png') }}" alt="">
            <img src="{{ asset('/img/Partenaires/Microsoft/Microsoft.png') }}" alt="">
            <img src="{{ asset('/img/Partenaires/Microsoft/Microsoft.png') }}" alt="">
            <img src="{{ asset('/img/Partenaires/Microsoft/Microsoft.png') }}" alt="">
            <img src="{{ asset('/img/Partenaires/Microsoft/Microsoft.png') }}" alt="">
            <img src="{{ asset('/img/Partenaires/Microsoft/Microsoft.png') }}" alt="">
        </div>
    </section>
    <script src="{{ asset('js/welcome.jsh') }}"></script>
</body>

</html>