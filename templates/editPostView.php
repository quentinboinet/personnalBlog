{% extends "base.php" %}

{% block title %} - Modifier un article {% endblock %}

{% block content %}

{% if session.mail is defined and session.type == 1 %}
    <h5>Modification d'un article</h5>

    {% for data in datas %}
    <div class="row">
        <div class="section">
            <form action="index.php?action=editPost&i={{ data.id }}" method="post" class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">title</i>
                        <input value="{{ data.title }}" name="title" id='title' type="text" class="validate" required>
                        <label for="title">Titre :</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="input-field col s12">
                            <textarea name="chapo" id="chapo" class="materialize-textarea" rows="3">{{ data.chapo }}</textarea>
                            <label for="chapo">Châpo :</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="input-field col s12">
                            <textarea name="content" id="content" class="materialize-textarea" rows="10">{{ data.content }}</textarea>
                            <label for="content">Contenu :</label>
                        </div>
                    </div>
                </div>
                <div class="row center">
                    <div class="col s12">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Modifier
                                <i class="material-icons right">edit</i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {% endfor %}

{% else %}

    <div class="row">
        <div class="section">
            <p>Vous n'êtes pas connecté ou n'avez pas les droits suffisants pour afficher cette page !</p>
        </div>
    </div>

{% endif %}

{% endblock %}