{% extends "base.php" %}

{% block title %} - Ajouter un article {% endblock %}

{% block content %}

{% if session.mail is defined and session.type == 1 %}
    <h5>Ajout d'un article</h5>

    <div class="row">
        <div class="section">
            <form action="index.php?action=addPost" method="post" class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">title</i>
                        <input placeholder="Titre de l'article" name="title" id='title' type="text" class="validate" required>
                        <label for="title">Titre :</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">add_a_photo</i>
                        <input placeholder="URL de l'image" name="image" id='image' type="text" class="validate" required>
                        <label for="image">Image de couverture :</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="input-field col s12">
                            <textarea placeholder="Châpo de l'article" id="chapo" name="chapo" class="materialize-textarea" rows="3"></textarea>
                            <label for="chapo">Châpo :</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="input-field col s12">
                            <textarea name="content" id="content" name="content" class="materialize-textarea" rows="10"></textarea>
                            <label for="content">Contenu :</label>
                        </div>
                    </div>
                </div>
                <div class="row center">
                    <div class="col s12">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Poster
                                <i class="material-icons right">check</i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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