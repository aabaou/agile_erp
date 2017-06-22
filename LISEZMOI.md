# Starterkit pour Drupal 8


Ce starterkit a pour objectif de faciliter l'installation et la configuration de Drupal 8 pour un nouveau projet. Cette installation et configuration peut s'effectuer de manière automatique via l'utilisation des scripts shell du projet.

Ce starterkit utilise par défaut le thème Bactency (thème enfant du thème Bootstrap3).


1. [Git - Récupèration du starterkit](#git)
2. [Lancement du starterkit](scripts/drupal/LISEZMOI.md)
3. [Utilisation et options du build.sh](scripts/drupal/LISEZMOI.md)
4. [Importer -Sauvegarder une base de données](data/LISEZMOI.md)
5. [Aliases drush](bin/drush/LISEZMOI.md)
6. [Aliases drupal console]()
7. [Modules de News et d'évènements](web/modules/features/LISEZMOI.md)
8. [Utilisation de ckeditor.sh](scripts/drupal/LISEZMOI.md)

## Git <a id="git"></a>
Le code du projet est DR8. Toute branche créée pour ce projet doit être nommée `feature/DR8-XXX` (où XXX est le numéro du ticket).
Tous les messages de commits doivent être préfixés avec `DR8-XXX` (où XXX est le numéro du ticket) et être clair sur la tâche qui a été effectuée.

### Récupérer le starterkit depuis Github

Cloner le starterkit en lançant la commande `git clone git@github.com:Actency/drup8cy.git nom_projet` où `nom_projet` est le nom de votre dossier qui contiendra le projet.

Puis taper la commande `git checkout feature/DR8-XXX` (où XXX est le numéro du ticket) afin de vous positionner dans la bonne branche de git.

Placer vous dans votre dossier et lancer le starterkit.

## Contact
- Nicolas Loye (nicolas.loye@actency.fr)
- Stéphanie Trendel (Stephanie.Trendel@actency.fr)
- Stéphane Brichler (stephane.brichler@actency.fr)

Développé par : Actency
