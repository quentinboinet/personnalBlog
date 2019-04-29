<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>

        <link rel="icon" type="image/png" href="public/images/favicon.png">

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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <!--MMaterialize JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js"></script>

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var elems = document.querySelectorAll('.sidenav');
                var instances = M.Sidenav.init(elems,
                    {
                        edge: 'left',
                        draggable: true,
                        inDuration: 250,
                        outDuration: 200
                    }
                    );
            });
        </script>

        <title>Quentin Boinet {% block title %}{% endblock %}</title>

        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    </head>

    <body>
    {% block js %}{% endblock %}
        <header>
            <nav class="nav-center">
                <div class="nav-wrapper teal">
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger brand-logo center"><i class="material-icons">menu</i></a>
                    <div class="row">

                        <div class="col m5">
                            <ul id="nav-mobile" class="hide-on-med-and-down">
                                <li><a href="index.php">Accueil</a></li>
                                <li><a href="index.php#about">A propos</a></li>
                                <li><a href="index.php#contact">Me contacter</a></li>
                            </ul>
                        </div>

                        <div class="col m2 hide-on-med-and-down">
                            <a href="index.php" class="brand-logo center"><img src="public/images/logo4.png" title="Quentin Boinet" alt="Quentin Boinet" width="200"/></a>
                        </div>

                        <div class="col m5">
                            <ul id="nav-mobile" class="hide-on-med-and-down">
                                <li><a href="index.php?action=blog">Le blog</a></li>
                                {% if session.mail is defined %}
                                <li><a href="index.php?action=logout">Se déconnecter</a></li>
                                {% endif %}
                                {% if session.mail is not defined %}
                                <li><a href="index.php?action=login">Se connecter</a></li>
                                <li><a href="index.php?action=signup">S'inscrire</a></li>
                                {% endif %}
                            </ul>
                        </div>

                        <ul class="sidenav" id="mobile-demo">
                            <li><a href="index.php">Accueil</a></li>
                            <li><a href="index.php#about">A propos</a></li>
                            <li><a href="index.php#contact">Me contacter</a></li>
                            <li><a href="index.php?action=blog">Le blog</a></li>
                            {% if session.mail is defined %}
                            <li><a href="index.php?action=logout">Se déconnecter</a></li>
                            {% endif %}
                            {% if session.mail is not defined %}
                            <li><a href="index.php?action=login">Se connecter</a></li>
                            <li><a href="index.php?action=signup">S'inscrire</a></li>
                            {% endif %}
                        </ul>

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

        <div class="banner"></div>

            <footer class="page-footer teal">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m12 l3">
                            <h5>Contact</h5>
                            <p>+33 (0)7 67 17 24 29
                                <br />quentinboinet@live.fr</p>
                        </div>

                        <div class="col s12 m12 l6 hide-on-med-and-down">
                            <h5>A propos</h5>
                            <p>Etudiant en développement web spécialisé PHP/Symfony, n'hésitez pas à me contacter pour toute réalisation !</p>
                        </div>

                        <div class="col s12 m12 l3">
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
                    {% if session.mail is defined and session.type == 1 %}
                    <div class="row">
                        <div class="divider"></div>
                        <p><a  style="color:black;" href="index.php?action=adminPage" title="Administrez le blog">Administration</a></p>
                    </div>
                    {% endif %}
                </div>
            </footer>

    </body>
</html>
