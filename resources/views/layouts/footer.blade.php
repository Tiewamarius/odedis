<style>
    /* =========================
   ODEDIS FOOTER
========================= */

    .odedis-footer {
        background: #071326;
        color: #ffffff;
        padding: 70px 0 25px;
        position: relative;
        overflow: hidden;
    }

    .odedis-footer-wrapper {
        width: 90%;
        max-width: 1300px;
        margin: auto;
    }

    /* GRID */
    .odedis-footer-layout {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 50px;
        padding-bottom: 50px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    /* LEFT SIDE */
    .odedis-footer-brand {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .odedis-footer-title {
        font-size: 1.rem;
        line-height: 1.5;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 35px;
        max-width: 520px;
    }

    /* SOCIAL */
    .odedis-footer-social {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .odedis-social-link {
        width: 55px;
        height: 55px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s ease;
        text-decoration: none;
    }

    .odedis-social-link:hover {
        background: #0f62fe;
        transform: translateY(-5px);
    }

    .odedis-social-link img {
        width: 24px;
        height: 24px;
        object-fit: contain;
    }

    /* COLUMNS */
    .odedis-footer-column {
        display: flex;
        flex-direction: column;
    }

    .odedis-footer-heading {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 22px;
        letter-spacing: 1px;
        color: #ffffff;
        position: relative;
    }

    .odedis-footer-heading::after {
        content: "";
        width: 35px;
        height: 3px;
        background: #0f62fe;
        position: absolute;
        left: 0;
        bottom: -8px;
        border-radius: 10px;
    }

    /* LINKS */
    .odedis-footer-column a {
        color: rgba(255, 255, 255, 0.78);
        text-decoration: none;
        margin-bottom: 14px;
        transition: 0.3s ease;
        font-size: 0.96rem;
        line-height: 1.6;
    }

    .odedis-footer-column a:hover {
        color: #ffffff;
        padding-left: 5px;
    }

    /* BOTTOM */
    .odedis-footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 25px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .odedis-footer-bottom p {
        margin: 0;
        color: rgba(255, 255, 255, 0.65);
        font-size: 0.92rem;
    }

    /* =========================
   RESPONSIVE
========================= */

    @media (max-width: 1100px) {

        .odedis-footer-layout {
            grid-template-columns: 1fr 1fr;
        }

        .odedis-footer-brand {
            grid-column: 1 / -1;
        }

        .odedis-footer-title {
            max-width: 100%;
        }
    }

    @media (max-width: 768px) {

        .odedis-footer {
            padding: 55px 0 20px;
        }

        .odedis-footer-layout {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .odedis-footer-title {
            font-size: 1.5rem;
        }

        .odedis-footer-bottom {
            flex-direction: column;
            align-items: flex-start;
        }

        .odedis-social-link {
            width: 48px;
            height: 48px;
        }

        .odedis-social-link img {
            width: 20px;
            height: 20px;
        }
    }
</style>
<footer class="odedis-footer">

    <div class="odedis-footer-wrapper">

        <div class="odedis-footer-layout">

            <!-- LEFT -->
            <div class="odedis-footer-brand">

                <h2 class="odedis-footer-title">
                    Votre Partenaire de référence pour la transformation digitale des entreprises en Afrique.
                </h2>

                <div class="odedis-footer-social">

                    <a href="https://www.linkedin.com/company/odedis/posts/?feedView=all" class="odedis-social-link">
                        <img src="assets/images/linkedin.png" alt="Linkedin">
                    </a>

                    <a href="https://www.facebook.com/odedis1" class="odedis-social-link">
                        <img src="assets/images/facebook.png" alt="Facebook">
                    </a>

                    <a href="https://wa.me/2250707646363?text=Bonjour%20,%20ODELIA%20DIGITAL%20SERVICES.%20J'aimerais%20avoir%20plus%20d'informations%20sur%20vos%20services"
                        class="odedis-social-link">
                        <img src="assets/images/whatsapp.png" alt="Whatsapp">
                    </a>

                </div>

            </div>

            <!-- SERVICES -->
            <div class="odedis-footer-column">

                <h5 class="odedis-footer-heading">SERVICES</h5>

                <a href="services.php#digital">Transformation Digitale</a>
                <a href="services.php#integration">Intégration</a>
                <a href="services.php#audit">Audit & Conseil</a>
                <a href="services.php#humain">Développement du Capital Humain</a>

            </div>

            <!-- ENTREPRISE -->
            <div class="odedis-footer-column">

                <h5 class="odedis-footer-heading">ENTREPRISE</h5>

                <a href="about.php">À propos</a>
                <a href="about.php#vision">Vision & Mission</a>
                <a href="about.php#atouts">Nos atouts</a>
                <a href="ecosysteme.php">Partenaires</a>
                <a href="references.php">Références</a>

            </div>

            <!-- CONTACT -->
            <div class="odedis-footer-column">

                <h5 class="odedis-footer-heading">CONTACT</h5>

                <a href="mailto:info@odedis.com">info@odedis.com</a>
                <a href="mailto:consulting@odedis.com">odedis consulting</a>
                <a href="https://www.odedis.com">www.odedis.com</a>
                <a href="contact.php">Formulaire de contact</a>

            </div>

        </div>

        <!-- BOTTOM -->
        <div class="odedis-footer-bottom">

            <p>
                © 2025 ODEDIS – Odelia Digital Services. Tous droits réservés.
            </p>

            <p>
                Abidjan · Tallinn
            </p>

        </div>

    </div>

</footer>