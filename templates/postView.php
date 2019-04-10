{% extends "base.php" %}

{% block title %} - Article {% endblock %}

{% block js %}
{% if js == 'toasterCommentAdded' %}<script>M.toast({html: "Votre commentaire a bien été posté ! Merci pour votre contribution.", displayLength: 8000, classes:'rounded'});</script>{% endif %}
{% if js == 'toasterCommentValidation' %}<script>M.toast({html: "Merci pour votre contribution ! Le commentaire va être étudié puis validé dans les plus brefs délais.", displayLength: 8000, classes:'rounded'});</script>{% endif %}

{% endblock %}

{% block content %}

    {% for data in datas %}

    <!-- affichage des infos sur le post -->
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-image">
                    <img src="{{ data.picture }}" height="400">
                </div>
                <div class="card-content">
                    <span class="card-title">{{ data.title }}</span>
                    <p><b>{{ data.chapo }}</b></p><br />
                    <p><i>{{ data.firstName }} {{ data.lastName }} | {{ data.lastModifiedDate | date("d/m/Y", "Europe/Paris") }} à {{ data.lastModifiedDate | date("H:i") }} | {{ nbComments }} commentaires</i></p><br/>
                    <div class="divider"></div>
                    <br /><p>{{ data.content }}</p>
                </div>
            </div>
        </div>
    </div>

    {% endfor %}

    <h5>Commentaires</h5>

    {% if nbComments == 0 %} <p><b>Aucun commentaire !</b></p>{% endif %}

    {% for comment in comments %}

    <!-- affichage des commentaires du post -->
    <div class="row">
        <div class="col s12">
            <div class="section">
                <p><b>{{ comment.firstName }} {{ comment.lastName }} | {{ comment.creationDate | date("d/m/Y", "Europe/Paris") }} à {{ comment.creationDate | date("H:i") }}</b><br/>
                <i>{{ comment.content }}</i></p>
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
                            <textarea name="comment" id="comment" class="materialize-textarea" rows="5"></textarea>
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


{% endblock %}