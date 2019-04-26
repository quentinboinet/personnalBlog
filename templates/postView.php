{% extends "base.php" %}

{% block title %} - Article {% endblock %}

{% block js %}
{% if js == 'toasterCommentAdded' %}<script>M.toast({html: "Votre commentaire a bien été posté ! Merci pour votre contribution.", displayLength: 8000, classes:'rounded'});</script>{% endif %}
{% if js == 'toasterCommentValidation' %}<script>M.toast({html: "Merci pour votre contribution ! Le commentaire va être étudié puis validé dans les plus brefs délais.", displayLength: 8000, classes:'rounded'});</script>{% endif %}
{% if js == 'toasterPostEdited' %}<script>M.toast({html: "Article correctement mis à jour !", displayLength: 8000, classes:'rounded'});</script>{% endif %}
{% endblock %}

{% block content %}

    {% for data in datas %}

    {% if session.mail is defined and session.type == 1 %}
    <br />
    <div class="row center">
        <ul class="list-inline">
            <li>
                <a href="index.php?action=editPost&i={{ data.id }}">
                    <i class="material-icons">edit</i> <br />Modifier
                </a>
            </li>
            <li>
                <a href="index.php?action=deletePost&i={{ data.id }}">
                    <i class="material-icons">delete</i> <br />Supprimer
                </a>
            </li>
        </ul>
    </div>
    <div class="divider"></div>
    {% endif %}

    <!-- affichage des infos sur le post -->
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-image">
                    <img src="{{ data.picture }}" height="400">
                </div>
                <div class="card-content">
                    <span class="card-title">{{ data.title }}</span>
                    <p><b>{{ data.chapo | nl2br }}</b></p><br />
                    <p><i>{% if data.firstName is defined %}{{ data.firstName }} {{ data.lastName }} {% else %} Utilisateur anonyme {% endif %} | {{ data.lastModifiedDate | date("d/m/Y", "Europe/Paris") }} à {{ data.lastModifiedDate | date("H:i") }} | {{ nbComments }} commentaires</i></p><br/>
                    <div class="divider"></div>
                    <br /><p>{{ data.content | nl2br }}</p>
                </div>
            </div>
        </div>
    </div>

    <h5>Commentaires</h5>

    {% if nbComments == 0 %} <p><b>Aucun commentaire !</b></p>{% endif %}

    {% for comment in comments %}

    <!-- affichage des commentaires du post -->
    <div class="row">
        <div class="col s12">
            <div class="section">
                <p><b>{% if comment.firstName is null %} Utilisateur anonyme {% else %} {{ comment.firstName }} {{ comment.lastName }} {%endif %}| {{ comment.creationDate | date("d/m/Y", "Europe/Paris") }} à {{ comment.creationDate | date("H:i") }}</b><br/>
                <i>{{ comment.content | nl2br}}</i></p>
                <div class="divider"></div>
            </div>
        </div>
    </div>
    {% endfor %}

    {% if session.mail is defined %}
    <!-- affichage du formulaire pour ajouter un commentaire si utilisateur connecté -->
   <br />
    <h5>Ajouter un commentaire</h5>
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <form action="index.php?action=viewPost&i={{ data.id }}" method="post">
                <div class="row">
                        <div class="input-field">
                            <textarea name="comment" id="comment" class="materialize-textarea" rows="5" required></textarea>
                            <label for="comment">Commentaire :</label>
                        </div>
                </div>
                <div class="row">
                        <div class="input-field">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                </div>
            </form>
        </div>
    </div>
    {% endif %}
{% endfor %}

{% endblock %}