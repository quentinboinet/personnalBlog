{% extends "base.php" %}

{% block title %} - Erreur ! {% endblock %}


{% block content %}

    <h5>Erreur !</h5>

    <div class="row">
        <div class="section">
            <p>{% if errorType == 'notAdmin' %}Vous ne disposez pas de droits suffisants où n'êtes pas connecté pour afficher cette page.{% endif %}</p>
        </div>
    </div>

{% endblock %}