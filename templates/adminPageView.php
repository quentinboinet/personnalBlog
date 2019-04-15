{% extends "base.php" %}

{% block title %} - Administration {% endblock %}

{% block js %}

{% if js == 'toasterPostAdded' %}<script>M.toast({html: "Votre article a bien été publié ! Vous pouvez dès à présent le retrouver sur la page du blog.", displayLength: 8000, classes:'rounded'});</script>{% endif %}

{% endblock %}

{% block content %}

{% if session.mail is defined and session.type == 1 %}
    <h5>Administrez le blog !</h5>

    <div class="row">
        <div class="section">
            <p>Bienvenue dans votre espace dédié à l'administration du blog. Ici vous pouvez accéder à la :</p>
        <ul>
            <li><a href="index.php?action=addPost" title="Ajoutez un article au blog">Création d'un nouvel article</a></li>
            <li><a href="index.php?action=userManagement" title="Gérez les utilisateurs">Gestion des utilisateurs</a></li>
            <li><a href="index.php?action=commentManagement" title="Modérez les commentaires">Modération des commentaires</a></li>
        </ul>
        </div>
    </div>

{% else %}

    <div class="row">
        <div class="section">
            <p>Vous n'êtes pas connecté ou n'avez pas les droits suffisants pour afficher cette page !</p>
        </div>
    </div>

{% endif %}

{% endblock %}