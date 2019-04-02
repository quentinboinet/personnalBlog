{% extends "base.php" %}

{% block title %} - Accueil {% endblock %}

{% block js %}
<!-- Bloc permettant d'ajouter et d'afficher le toaster si jamais on a validé l'envoi du formulaire de contact -->
{% if js == 'toaster' %}<script>M.toast({html: 'Votre message a bien été envoyé ! J\'y répondrais dans les plus brefs délais.', displayLength: 8000, classes:'rounded'});</script>{% endif %}
{% endblock %}

{% block content %}

<div class="row">
    <div class="section" id="about">
        <h5>Quentin Boinet, un développeur à votre écoute !</h5>
        <p>Diplômé d'un master en ingénierie et conception de produits sportifs, j'ai toujours été passionné par les nouvelles technologies et plus particulièrement la programmation informatique. <br />
        C'est ainsi qu'après une premièère expérience réussie dans une startup et l'acquisition de compétences en management et gestion de projets je me suis lancé dans une formation de développeurs d'applications
        web, spécialisé en PHP/Symfony.<br />
            Les différentes technologies pour lesquelles je peux vous aider sont :<br />
            <ul>
            <li>Mise en place et intégration de sites Wordpress</li>
            <li>Accompagnement, supervision et gestion de projets informatiques</li>
            <li>HTML/CSS</li>
            <li>PHP/SQL</li>
            <li>Framework Symfony</li>
        </ul>
            Pour une présentation plus détaillée, veuillez trouver ici <a href="cv_qb.pdf" title="Mon C.V.">mon CV</a>.</p>
    </div>
</div>

<div class="row">
    <div class="divider"></div>
    <div class="section" id="contact">
        <h5>Contactez-moi</h5>
            <form action="index.php?action=sendContactMail" method="post" class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input placeholder="Votre nom" name="first_name" id="first_name" type="text" class="validate" required>
                        <label for="first_name">Nom :</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input placeholder="Votre prénom" name="last_name" id="last_name" type="text" class="validate" required>
                        <label for="last_name">Prénom :</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input placeholder="Votre adresse e-mail" name="email" id="email" type="email" class="validate" required>
                        <label for="email">E-mail :</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">question_answer</i>
                            <input placeholder="Sujet de votre contact" name="subject" id="subject" type="text" class="validate" required>
                            <label for="subject">Objet :</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="input-field col s12">
                            <textarea name="message" id="message" class="materialize-textarea" rows="5"></textarea>
                            <label for="message">Message :</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Envoyer
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>

{% endblock %}