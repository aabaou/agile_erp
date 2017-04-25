# Importer une base de données

Pour pouvoir importer une base de données:
1. Créer un dossier db (dans le dossier data).
2. Placez ensuite le fichier sql compressé ( example.sql.gz) dont vous souhaitez importer la base de données dans le dossier `db` .
3. Executer le script install.sh `../scripts/drupal/install.sh` OU build.sh `../scripts/drupal/build.sh --dump="example.sql.gz"`


# Sauvegarder une base de données

1. Créer un dossier db (dans le dossier data).
2. Exectuter le script build.sh `../scripts/drupal/build.sh`


Voir les [scripts shell](../scripts/drupal/LISEZMOI.md)
[Retourner au sommaire du projet](../LISEZMOI.md)