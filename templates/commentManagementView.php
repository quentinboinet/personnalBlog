{% extends "base.php" %}

{% block title %} - Gestion des commentaires {% endblock %}

{% block js %}

{% if js == 'toasterCommentApproved' %}<script>M.toast({html: "Le commentaire a bien été validé !", displayLength: 8000, classes:'rounded'});</script>{% endif %}
{% if js == 'toasterCommentDeleted' %}<script>M.toast({html: "Le commentaire a bien été supprimé !", displayLength: 8000, classes:'rounded'});</script>{% endif %}
{% if js == 'toasterCommentNotExist' %}<script>M.toast({html: "Aucun commentaire ne porte cet identifiant ! Veuillez réessayer", displayLength: 8000, classes:'rounded'});</script>{% endif %}

{% endblock %}

{% block content %}

{% if session.mail is defined and session.type == 1 %}

    <h5>Modération des commentaires</h5>

    <div class="row">
        <div class="section">
            {% if nbComment > 0 %}
            <p>Retrouvez ci-dessous un listing de tous les commentaires postés par les utilisateurs et en attente de validation. Vous pouvez approuver un commentaire en cliquant sur le symbole correspondant, il sera alors
                visible et affiché sur le post. Sinon, vous pouvez décider de le refuser et il sera alors supprimé.</p>

            <div class="col s12 m8 offset-m2">
                    <ul class="collection">

                        {% for comment in comments %}
                            {% if user.email != session.mail %} <!-- on s'assure de ne pas afficher notre profil utilisateur -->
                            <li class="collection-item avatar">
                                <img src="public/images/comment-icon.png" alt="Commentaire" class="circle">
                                <span class="title">{{ comment.firstName }} {{ comment.lastName }} le {{ comment.creationDate | date("d/m/Y", "Europe/Paris") }} à {{ comment.creationDate | date("H:i") }} (article : {{ comment.title }} )</span>
                                <p><br /><i>"{{ comment.content | nl2br}}"</i></p>
                                <br />
                                <div class="divider"></div>
                                <a href="index.php?action=approveComment&i={{ comment.id }}" title="Approuver ce commentaire"><i class="small material-icons">check</i></a>
                                <a href="index.php?action=deleteComment&i={{ comment.id }}" title="Supprimer ce commentaire"><i class="small material-icons">delete</i></a>
                            </li>
                            {% endif %}
                        {% endfor %}

                    </ul>
            </div>

            {% else %}
            <p>Aucun commentaire à valider !</p>
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