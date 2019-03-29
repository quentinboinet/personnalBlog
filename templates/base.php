<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <link rel="stylesheet" href="public/css/style.css">
        <!-- Icones google + font-awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <title>Quentin Boinet {% block title %}{% endblock %}</title>
    </head>

    <body>
        <header>
            <nav class="nav-center">
                <div class="nav-wrapper teal">
                    <div class="row">

                        <div class="col m5">
                        <ul id="nav-mobile" class="hide-on-med-and-down">
                            <li><a href="">Accueil</a></li>
                            <li><a href="#about">A propos</a></li>
                            <li><a href="#contact">Me contacter</a></li>
                        </ul>
                        </div>

                        <div class="col m2">
                            <a href="#" class="brand-logo center"><img src="public/images/logo4.png" title="Quentin Boinet" alt="Quentin Boinet" width="200" height="auto" /></a>
                        </div>

                        <div class="col m5">
                        <ul id="nav-mobile" class="hide-on-med-and-down">
                            <li><a href="">Le blog</a></li>
                            <li><a href="">Se connecter</a></li>
                            <li><a href="">S'inscrire</a></li>
                        </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="banner"></div>

        </header>

        <main>
            <div class="container">
            {% block content %}{% endblock %}
            </div>
        </main>

            <footer class="page-footer teal">
                <div class="container">
                    <div class="row">
                        <div class="col m3">
                            <h5>Contact</h5>
                            <p>+33 (0)7 67 17 24 29
                                <br />quentinboinet@live.fr</p>
                        </div>

                        <div class="col m6">
                            <h5>A propos</h5>
                            <p>Etudiant en développement web spécialisé PHP/Symfony, n'hésitez pas à me contacter pour toute réalisation !</p>
                        </div>

                        <div class="col m3">
                            <h5>Mes autres pages</h5>
                            <ul class="list-inline">
                                <li>
                                    <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.linkedin.com/in/quentin-boinet-57600b6b/">
                                        <i class="fab fa-fw fa-linkedin-in"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://github.com/quentinboinet">
                                        <i class="fab fa-fw fa-github"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://twitter.com/boinet_quentin">
                                        <i class="fab fa-fw fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.instagram.com/zerocoole/">
                                        <i class="fab fa-fw fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    </body>
</html>
