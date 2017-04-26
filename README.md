# Starterkit for Drupal 8

This starterkit aims to facilitate the installation and configuration of Drupal 8 for a new project. This installation and configuration can be done automatically using the shell scripts of the project.

This starterkit uses by default the theme Bactency (child theme of the Bootstrap3 theme).


1. [Git - Recovering the starterkit](#git)
2. [Launch of the starterkit](scripts/drupal/README.md)
3. [Build.sh use and options](scripts/drupal/README.md)
3. [Import - Save a database](data/README.md)
4. [Drush aliases](bin/drush/README.md)
5. [Drupal console aliases ]()

## Git <a id="git"></a>
The project code is DR8. Any branch created for this project should be named `feature/DR8-XXX` (where XXX is the number of the ticket).
All commits messages should be prefixed with `DR8-XXX` (where XXX is the number of the ticket) and be clear about the task that has been done.

### Recover starterkit from Github

Clone the starterkit by running the command `git clone git@github.com:Actency/drup8cy.git project_name` where `project_name` is the name of your directory that will contain the project.

Then, run `git checkout feature/DR8-XXX` (where XXX is the number of the ticket) to position yourself in the right branch of git.

Place yourself in your folder and start the starterkit.

## Contact
- Nicolas Loye (nicolas.loye@actency.fr)
- Stéphanie Trendel (Stephanie.Trendel@actency.fr)
- Stéphane Brichler (stephane.brichler@actency.fr)

Developed by : Actency