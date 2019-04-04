{% extends "base.php" %}

{% block title %} - Article {% endblock %}

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
{% endblock %}