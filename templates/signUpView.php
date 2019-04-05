{% extends "base.php" %}

{% block title %} - S'inscrire {% endblock %}

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
                            <input placeholder="Votre nom" name="first_name" id="first_name" type="text" class="validate" required>
                            <label for="first_name">Nom :</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input placeholder="Votre prénom" name="last_name" id="last_name" type="text" class="validate" required>
                            <label for="last_name">Prénom :</label>
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