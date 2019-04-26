{% extends "base.php" %}

{% block title %} - Erreur ! {% endblock %}


{% block content %}

    <h5>Erreur !</h5>

    <div class="row">
        <div class="section">
            <p>
                {% if errorType == 'notAdmin' %}Vous ne disposez pas de droits suffisants où n'êtes pas connecté pour afficher cette page.{% endif %}
                {% if errorType == 'postDoesNotExist' %}Cet identifiant d'article n'existe pas. Retour <a href="index.php?action=blog" title="Accueil du blog">au blog</a>.{% endif %}
                {% if errorType == 'unidentified' %} Une erreur inconnue est survenue ! Merci de bien vouloir réessayer. {% endif %}
            </p>
        </div>
    </div>

{% endblock %}