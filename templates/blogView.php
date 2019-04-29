{% extends "base.php" %}

{% block title %} - Le blog {% endblock %}

{% block js %}

{% if js == 'toasterPostDeleted' %}<script>M.toast({html: "Post bien supprimé !", displayLength: 8000, classes:'rounded'});</script>{% endif %}
{% if js == 'toasterNoPost' %}<script>M.toast({html: "Erreur lors de la suppression du post ! Veuillez réessayer.", displayLength: 8000, classes:'rounded'});</script>{% endif %}

{% endblock %}

{% block content %}

    <h5>Les derniers articles</h5>
    {% if datas == "NoPosts" %}
    <div class="row">
        <div class="col s12">
            <p>Aucun article actuellement sur le blog !</p>
        </div>
    </div>
    {% else %}
        {% for data in datas %}
        <div class="row">
            <div class="col s12">
                <div class="card horizontal small">
                    <div class="card-image col s4">
                        <img src="{{ data.picture }}"/>
                    </div>
                    <div class="card-stacked col s8">
                        <div class="card-content">
                            <span class="card-title">{{ data.title }}</span>
                            <p>{{ data.chapo }}</p>
                        </div>
                        <div class="card-action">
                            <i>Mis à jour le : {{ data.lastModifiedDate | date("d/m/Y", "Europe/Paris") }} à {{ data.lastModifiedDate | date("H:i") }}</i>
                            <a href="index.php?action=viewPost&i={{ data.id }}" class="right">Lire la suite</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {% endfor %}

        <div class="row">
            <div class="col s12 center">
                <ul class="pagination">
                    <li {% if actualPage == 1 %} class="disabled" {% endif %}><a href="index.php?action=blog&p={{ actualPage - 1 }}" {% if actualPage == 1 %} onclick="return false;" {% endif %}><i class="material-icons">chevron_left</i></a></li>
                    {% for i in range(1, nbPage) %}
                    <li {% if actualPage == i %} class="active teal" {% endif %}><a href="index.php?action=blog&p={{ i }}">{{ i }}</a></li>
                    {% endfor %}
                    <li {% if actualPage == nbPage %} class="disabled" {% endif %}><a href="index.php?action=blog&p={{ actualPage + 1 }}" {% if actualPage == nbPage %} onclick="return false;" {% endif %}><i class="material-icons">chevron_right</i></a></li>
                </ul>
            </div>
        </div>
    {% endif %}

{% endblock %}