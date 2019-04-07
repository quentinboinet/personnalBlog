{% extends "base.php" %}

{% block title %} - S'inscrire {% endblock %}

{% block js %}
<!-- Bloc permettant d'ajouter et d'afficher le toaster si jamais on a validé le formulaire d'inscription -->
{% if js == 'toaster' %}<script>M.toast({html: 'Votre inscription a bien été prise en compte ! Merci, vous pouvez désormais vous connecter.', displayLength: 8000, classes:'rounded'});</script>{% endif %}
{% if js == 'toasterUserExist' %}<script>M.toast({html: 'Cette adresse e-mail est déjà utilisée !', displayLength: 8000, classes:'rounded'});</script>{% endif %}
{% endblock %}

{% block content %}

<h5>Votre inscription en 2 minutes !</h5>

<div class="row signup">
    <div class="col s12 m8 offset-m2">
        <div class="card teal darken-1 z-depth-3">
            <form action="index.php?action=signup" method="post">
            <div class="card-content white-text">
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input placeholder="Votre nom" name="lastName" id="lastName" type="text" class="validate" required>
                            <label for="lastName">Nom :</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input placeholder="Votre prénom" name="firstName" id="firstName" type="text" class="validate" required>
                            <label for="firstName">Prénom :</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input placeholder="Votre adresse e-mail" name="email" id="email" type="email" class="validate" required>
                            <label for="email">E-mail :</label>
                        </div>
                    </div>
                    <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">security</i>
                                <input placeholder="Mot de passe" name="password" id="password" type="password" class="validate" required>
                                <label for="password">Mot de passe :</label>
                            </div>
                    </div>
                <div class="row">
                    <div class="col s2 offset-s5">
                    <div class="input-field">
                        <button class="btn-floating btn-large pulse waves-effect waves-light" type="submit" name="action">
                            <i class="material-icons">check</i>
                        </button>
                    </div>
                </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

{% endblock %}