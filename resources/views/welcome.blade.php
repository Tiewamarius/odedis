@extends('layouts.myapp')
@section('content')
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

<!-- ABOUT -->
<section class="about section">

    <div class="container about-grid">

        <div class="about-visual">

            <div class="about-box">

                <span class="year">Depuis 2017</span>

                <p>
                    ODEDIS accompagne les entreprises africaines vers l’excellence numérique grâce à son expertise et
                    ses partenariats technologiques mondiaux.
                </p>

            </div>

        </div>

        <div class="about-content">

            <span class="section-subtitle">
                Qui sommes-nous ?
            </span>

            <h2>
                Un partenaire de confiance pour votre croissance digitale
            </h2>

            <p>
                Nous accompagnons les entreprises dans leur évolution numérique grâce à des solutions innovantes,
                sécurisées et adaptées aux réalités africaines.
            </p>

            <ul class="check-list">

                <li>Transformation digitale & systèmes d'information</li>
                <li>Intégration de solutions technologiques</li>
                <li>Développement du capital humain</li>
                <li>Partenariats avec les leaders mondiaux</li>

            </ul>

            <a href="#" class="btn btn-primary">
                En savoir plus
            </a>

        </div>

    </div>

</section>
<!-- SERVICES -->
<section class="services section-alt">

    <div class="container">

        <div class="section-head">

            <span class="section-subtitle">
                Nos expertises
            </span>

            <h2>
                Nos services stratégiques
            </h2>

            <p>
                Une expertise complète pour accélérer votre transformation digitale.
            </p>

        </div>

        <div class="services-cards">

            <div class="service-box">
                <h3>Transformation Digitale</h3>
                <p>Stratégie, gouvernance SI et cloud.</p>
            </div>

            <div class="service-box">
                <h3>Intégration</h3>
                <p>Infrastructure hybride, cybersécurité et réseaux.</p>
            </div>

            <div class="service-box">
                <h3>Audit & Conseil</h3>
                <p>Audit organisationnel et gestion des risques.</p>
            </div>

            <div class="service-box">
                <h3>Capital Humain</h3>
                <p>Formation et certification des équipes IT.</p>
            </div>

        </div>

    </div>

</section>
<!-- STATS -->
<section class="stats">

    <div class="container stats-grid">

        <div class="stat-item">
            <h3>2017</h3>
            <p>Création</p>
        </div>

        <div class="stat-item">
            <h3>10+</h3>
            <p>Partenaires</p>
        </div>

        <div class="stat-item">
            <h3>7+</h3>
            <p>Secteurs</p>
        </div>

        <div class="stat-item">
            <h3>4</h3>
            <p>Expertises</p>
        </div>

    </div>

</section>
<!-- PARTNERS -->
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
@endsection