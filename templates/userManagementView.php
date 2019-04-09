{% extends "base.php" %}

{% block title %} - Gestion des utilisateurs {% endblock %}

{% block js %}

{% if js == 'toasterUserDeleted' %}<script>M.toast({html: "L'utilisateur a correctement été suppprimé !", displayLength: 8000, classes:'rounded'});</script>{% endif %}
{% if js == 'toasterUserNotDeleted' %}<script>M.toast({html: "Suppression de l'utilisateur impossible ! Veuillez réessayer.", displayLength: 8000, classes:'rounded'});</script>{% endif %}

{% endblock %}

{% block content %}

{% if session.mail is defined and session.type == 1 %}

    <h5>Gestion des utilisateurs</h5>

    <div class="row">
        <div class="section">
            {% if nbUser > 0 %}
            <p>Retrouvez ci-dessous un listing de tous les utilisateurs enregistrés sur le blog, du plus récent au plus ancien. Vous pouvez en supprimer un en cliquant sur la poubelle, mais attention cette opération est irréversible !</p>

            <div class="col s12 m8 offset-m2">
                    <ul class="collection">

                        {% for user in users %}
                            {% if user.email != session.mail %} <!-- on s'assure de ne pas afficher notre profil utilisateur -->
                            <li class="collection-item avatar">
                                <img src="public/images/account-icon.png" alt="Utilisateur" class="circle">
                                <span class="title">{{ user.firstName }} {{ user.lastName }}</span>
                                <p>{{ user.email }}</p>
                                <a href="index.php?action=deleteUser&i={{ user.id }}" title="Supprimer cet utilisateur" class="secondary-content"><i class="small material-icons">delete</i></a>
                            </li>
                            {% endif %}
                        {% endfor %}

                    </ul>
            </div>

            {% else %}
            <p>Aucun utilisateur n'est actuellement enregistré sur votre blog !</p>
            {% endif %}
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