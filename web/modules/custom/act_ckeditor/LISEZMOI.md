# Module Actency CKEditor <a id="module"></a>
1. [Liste des plugins CKEditor automatiquement ajoutés par le module act_ckeditor](#list)
2. [Comment installer le module act_ckeditor manuellement](#manually)

Avant d’activer ce module il est conseillé de lancer le script [ckeditor.sh](../../../../scripts/drupal/LISEZMOI.md) sinon il vous faudra ajouter les librairies et modules qu’il utilise manuellement.
Ce module ajoute un nouveau format de texte qui s'appelle « Actency CKEditor ». 


## Liste des [plugins CKEditor](http://ckeditor.com/addons/plugins/all ) automatiquement ajoutés par le module act_ckeditor:<a id="list"></a>
Ce module ajoute automatiquement un certain nombre d’add-ons à CKEditor.

[ckeditor.sh](../../../../scripts/drupal/LISEZMOI.md) recherche la version de CKEditor et télécharge les bibliothèques requises par act_ckeditor.

- **Colorbutton** : Ce plugin ajoute les fonctions de Couleur du texte et Couleur de fond à l'éditeur.
- **Dialog** (requis par smiley et templates) : Ce plugin fournit l'API Dialog pour d'autres plugins pour créer une boîte de dialogue d'éditeur à partir d'un objet de définition.
- **Fakeobjects** (requis par pagebreak)
- **Floatpanel** (requis par colorbutton) : Ce plugin avec le plugin panel sert à fournir la base de tous les UI panels de l'éditeur - menu déroulant, menus, etc.
- **Pagebreak** : Ce plugin ajoute un bouton à la barre d'outils qui insère les sauts de page horizontales.
- **Panelbutton** : Ce plugin étend le plugin Button Interface et permet de visualiser un seul menu déroulant, un panneau de couleurs, etc.
- **Preview** : Ce plugin ajoute un bouton à la barre d'outils qui montre un aperçu du document tel qu’il sera affiché aux utilisateurs finaux ou imprimé.
- **Print** : Ce plugin active la fonction d'impression. Une fenêtre pop-up d'impression du système d'exploitation standard apparaîtra où l’on pourra choisir l'imprimante ainsi que toutes les options qui semblent utiles.
- **Smiley** : Ce plugin fournit un ensemble d'émoticônes à insérer dans l'éditeur via une fenêtre de dialogue.
- **Templates** : Permet l'insertion en un clic de différents modèles HTML utiles dans votre document CKEditor.


[Retourner au sommaire de la page](#module) | [Retourner au sommaire du projet](../../../../LISEZMOI.md)

## Comment installer le module act_ckeditor manuellement<a id="manually"></a>
Si vous n’utilisez pas le script ckeditor.sh, il va falloir créer un dossier libraries à la racine du site.

Vous devez savoir quelle version de CKEditor votre Drupal utilise afin de télécharger la version appropriée du plugin. Trouvez le fichier core / assets / vendor / ckeditor / ckeditor.js dans le code Drupal et recherchez le mot "version". Vous le trouverez à côté du "timestamp".

Sur la [page des plugins](http://ckeditor.com/addons/plugins/all), vérifiez que vous avez sélectionnez la bonne version à télécharger pour votre CKEditor. Décompressez le fichier et placez le dossier résultant dans le dossier libraries précédemment créé.

A cause des fichiers de configuration incluent dans le module act_ckeditor, il est également nécessaire d'activer un certain nombre de modules qui apparaissent dans les dépendances. Pour connaître la liste des modules et des librairies à installer, veuillez consulter la documentation sur [ckeditor.sh](../../../../scripts/drupal/LISEZMOI.md). 



[Retourner au sommaire de la page](#module) | [Retourner au sommaire du projet](../../../../LISEZMOI.md)
