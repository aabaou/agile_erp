Le starterkit met à disposition plusieurs modules features fournissant un système basique de News et d’événements.

Ces modules ont été subdivisés en plusieurs sous modules pour permettre à l’utilisateur de ne sélectionner que les éléments dont il a besoin pour son projet et éviter ainsi des configurations non utilisées.
Pour utiliser le système de News ou d’événement : 
1.	Activez le module "Responsive image" de Drupal;
2.	Activez le module "[Actency view default configuration](#act_view_default)". 

# SOMMAIRE

- [Activer le système de news](#news)
-	[Activer le système d’événements](#events)
-	[Contenus des modules](#modules)

# Activer le système de news <a id="news"></a>

Pour utiliser le système de news :
1.	Activez le module "[Actency news](#act_news)";
2.	Activez le module "[Actency path](#act_path)";
3.	Si vous souhaiter utiliser une des vues du système de news : activez le module "Smart trim" (https://www.drupal.org/project/smart_trim ) et "Better exposed filter" (https://www.drupal.org/project/better_exposed_filters )
4.	Le système de news propose différents vues listant tous les contenus de type « News » dont le status est publié :
     - Une vue sous forme de liste ( path : "/news-list");
     - Une vue sous forme de liste avec le 1er élément mis en évidence ( path : "/news-list");
     - Une vue sous forme de grille ( path : "/news-grid");
     - Une vue sous forme de grille avec le 1er élement mis en évidence ( path : "/news-grid").

**Pour l'affichage des news sous forme de liste**, activez les modules :
-	"[Actency view list configuration](#act_view_list)";
-	"[Actency news list configuration]("act_news_list_config)";
-	"[Actency news list](#act_news_list)".

**Pour l'affichage des news sous forme de liste avec le 1er élément de la liste mis en évidence**, activer les modules :
-	"[Actency view list configuration](#act_view_list)";
-	"[Actency view list highlight configuration]("act_view_list_highlight)";
-	"[Actency news list configuration]("act_news_list_config)";
-	"[Actency news list with highlight](#act_news_list_highlight)".

<span style="color:red">Attention : Un seul des modules « Actency news list » ou « Actency news list with highlight » doit être activé . Si les 2 modules sont activés, Vous vous retrouverez avec 2 vues accessibles par le chemin « /news-list » </span>

**Pour l'affichage des news sous forme de grille**, activez les modules :
-	"[Actency view grid configuration](#act_view_grid)"; 
-	"[Actency news grid configuration](#act_news_grid_config)"; 
-	"[Actency news grid](#act_news_grid)". 

**Pour l'affichage des news sous forme de grille avec le 1er élément de la liste mis en évidence**, activez les modules :
-	"[Actency view grid configuration](#act_view_grid); 
-	"[Actency news grid configuration](#act_news_grid_config)"; 
-	"[Actency news grid with highlight](#act_news_grid_highlight)". 

<span style="color:red">Attention : Un seul des modules « Actency news grid » ou « Actency news grid with highlight » doit être activé . Si les 2 modules sont activés, vous vous retrouverez avec 2 vues accessibles  par le chemin « /news-grid »</span>

5.Le système de news met à disposition un bloc affichant les 3 dernières news publiées. Pour utiliser ce bloc, activez les modules :

-	"[Actency view list configuration](#act_view_list)";
-	"[Actency view list mini configuration](#act_view_list_mini)";
-	"[Actency news list mini](#act_news_list_mini)";
-	Positionnez ce bloc dans la région souhaitée de votre thème.


6.Le système de news met à disposition un lien de retour à la vue des news. Ce lien est contenu dans un bloc et ne sera affiché que sur les pages d’un nœud de type « News ». Pour utiliser ce bloc, activez le module :
-	"[Actency news link 'Back to all news'](#act_news_back)”;
-	Positionnez le bloc dans la région souhaitée de votre thème

Rq : Lors de la configuration du bloc, sélectionnez :
-	Le type de contenus « News ». Si un autre type de contenu est sélectionné, le lien ne sera pas affiché;
-	Le mode de visualisation par défaut : cette option correspond au mode d’affichage (liste ou grille) de la vue des news vers lequel le lien pointera.

# Activer le système d'évènements <a id="events"></a>

Pour utiliser le système d’évenements :
1.	Activer le module "[Actency events](#act_events)"; 
2.	Activer le module "[Actency path](#act_path)";
3.	Si vous souhaiter utiliser une des vues que propose le système d’événement: activez le module "Smart trim" (https://www.drupal.org/project/smart_trim ).
4.	Le système d’événements propose différents vues listant tous les contenus de type « Events » dont le status est publié :
      - Une vue sous forme de liste ( path : "/events-list");
      - Une vue sous forme de liste avec le 1er élément mis en évidence ( path : "/events-list");
      - Une vue sous forme de grille ( path : "/events-grid");
      - Une vue sous forme de grille avec le 1er élement mis en évidence ( path : "/events-grid");
      - Une vue sous forme de calendrier (path : "/events-calendar/day" , "/events-calendar/week", "/events-calendar/month", "/events-calendar/year")


**Pour l'affichage des événements sous forme de liste**, activez les modules :
-	"[Actency view list configuration](#act_view_list)";
-	"[Actency events list](#act_events_list)".

**Pour l'affichage des événements sous forme de liste avec le 1er élément de la liste mis en évidence**, activer les modules :
-	"[Actency view list configuration](#act_view_list)";
-	"[Actency view list highlight configuration]("act_view_list_highlight)";
-	"[Actency events list with highlight](#act_events_list_highlight)".


<span style="color:red"> Attention : Un seul des modules "Actency events list" ou "Actency events list with highlight" doit être activé . Si les 2 modules sont activés, Vous vous retrouverez avec 2 vues accessibles par le chemin « /events-list »</span>

**Pour l'affichage des événements sous forme de grille**, activez les modules :
-	"[Actency view grid configuration](#act_view_grid);
-	"[Actency events grid](#act_events_grid)".

**Pour l'affichage des événements sous forme de grille avec le 1er élément de la liste mis en évidence**, activez les modules :
-	"[Actency view grid configuration](#act_view_grid); 
-	"[Actency events grid with highlight](#act_events_grid_highlight)".

<span style="color:red"> Attention : Un seul des modules "Actency events grid" ou "Actency events grid with highlight" doit être activé . Si les 2 modules sont activés, vous vous retrouverez avec 2 vues accessibles  par le chemin « /events-grid »</span>

**Pour l'affichage des événements sous forme de calendrier**, activez les modules :
-	Drupal : "Calendar" (https://www.drupal.org/project/calendar) et sa dépendance "views templates" (https://www.drupal.org/project/views_templates); 
-	"[Actency events calendar](#act_events_calendar)".


5.Le système d’évènements met à disposition un bloc affichant les 3 dernières évènements publiées. Pour utiliser ce bloc, activez les modules :
-	"[Actency view list configuration](#act_view_list)"; 
-	"[Actency view list mini configuration](#act_view_list_mini)";
-	"[Actency events list mini](#act_events_list_mini)";
- Positionnez ce bloc dans la région souhaitée de votre thème.

6.Le système de’évènements met à disposition un lien de retour à la liste des évènements. Ce lien est contenu dans un bloc et ne sera affiché que sur les pages d’un nœud de type « Events ». Pour utiliser ce bloc, activez le module :
-	"[Actency events link “Back to all events”](#act_events_back)";
-	Positionnez le bloc dans la région souhaitée de votre thème.

Rq : Lors de la configuration du bloc, sélectionnez :
-	Le type de contenus « Events ». Si un autre type de contenu est sélectionné, le lien ne sera pas affiché; 
-	Le mode de visualisation par défaut : cette option correspond au mode d’affichage (liste ou grille) de la vue des évènements vers lequel le lien pointera.

# Contenus des modules  <a id="modules"></a>
## Modules communs au 2 systèmes (News et Events)

- **Actency view default configuration**<a id="act_view_default"></a>

Ce module contient les fichiers de configuration (*.yml) des formats d’image et du style d’image adaptif qui seront utilisé pour l’affichage d’un nœud de type "News" ou "Events".

- **Actency view grid configuration,**<a id="act_view_grid"></a>
- **Actency view list configuration,**<a id="act_view_list"></a>
- **Actency view list highlight configuration,**<a id="act_view_list_highlight"></a>
- **Actency list mini configuration,**<a id="act_view_list_mini"></a>

Ces modules contiennent les fichiers de configuration (*.yml) des formats d’image et du style d’image adaptif qui seront utilisé par la vue des "News" ou des "Events".

- **Actency path**<a id="act_path"></a>

[Voir la documentation du service](act_path/LISEZMOI.md)

## Modules Events 

- **Actency events**<a id="act_events"></a>

Ce module contient les fichiers de configuration (*.yml) du type de contenu "Events" ainsi que des champs de ce contenu. Il définit également un format de date "mois année" (exemple : juin 2017) et des champs personnalisés "Image formatter for Events" et "Text formatter for Events". 
- "Image formatter for Events" : ce champ permet de lier l’image au contenu et de transmettre le mode d’affichage (grid ou list) actuel de la vue des évènements à la page d’un nœud. Le lien de l’image aura pour url http://monsite/node/{id}?mode={mode}  où {mode} correspond au mode d’affichage grid ou list actuel de la vue listant les évènements.
-	"Text formatter for Events" : ce champ a été créé pour modifier l’url du lien "Read more" du nœud. Par défaut, l’url de ce lien est http://monsite/node/{id} . L’url a été modifié en http://monsite/node/{id}?mode={mode} où {mode} correspond au mode d’affichage grid ou list actuel de la vue listant les évènements.

Rq : Ces champs personnalisés ne peuvent être utilisés que pour les vues "/events-grid" et "/events-list".

- **Actency events calendar**<a id="act_events_calendar"></a>

Ce module contient le fichier de configuration (*.yml) de la vue des évènement sous forme de calendrier ainsi que le format de date "heure minute".

- **Actency events grid,**<a id="act_events_grid"></a>
- **Actency events grid with highlight,**<a id="act_events_grid_highlight"></a>
- **Actency events list,**<a id="act_events_list"></a>
- **Actency events list with highlight,**<a id="act_events_list_highlight"></a>

Ces modules contiennent le fichier de configuration (*.yml) de la vue des évènements sous forme de grille, grille avec le 1er élément mis en évidence, liste, liste avec le 1er élément mis en évidence.

- **Actency events list mini**<a id="act_events_list_mini"></a>

Ce module contient les fichiers de configuration (*.yml) du mode d’affichage "Events list mini" et de la vue de type bloc "Events list mini". 

- **Actency events link “Back to all events”**<a id="act_events_back"></a>

Ce module contient la définissions du bloc "Back to all events". Ce bloc contient un lien de retour à la vue des évènements. Il ne pourra être affiché que sur les pages d’un nœud de type "Events".


## Modules News

- **Actency news**<a id="act_news"></a>

Ce module contient les fichiers de configuration (*.yml) du type de contenu "News",  des champs de ce contenu et du vocabulaire "News". Il définit également les champs personnalisés "Image formatter for News", "Category formatter for News" et "Text formatter for News". 
-	"Image formatter for News" : ce champ permet de lier l’image au contenu et de transmettre le mode d’affichage (grid ou list) actuel de la vue des news à la page d’un nœud. Le lien de l’image aura pour url http://monsite/node/{id}?mode={mode} où {mode} correspond au mode d’affichage grid ou list actuel de la vue listant les news.
-	"Text formatter for News" : ce champ a été créé pour modifier l’url du lien "Read more" du nœud. Par défaut, l’url de ce lien est http://monsite/node/{id} . L’url a été modifié en http://monsite/node/{id}?mode={mode} où {mode} correspond au mode d’affichage grid ou list actuel de la vue listant les news.
-	"Category formatter for News" : l’utilisation de ce champ permet, lors du clic sur un terme de taxonomie, de ne pas être dirigé à l’adresse http://monsite/taxonomy/term/{id} mais à l’adresse http://monsite/news-grid/act_categorie={id} ou http://monsite/news-list/act_categorie={id} qui correspond à la page listant les news déjà filtré par le terme de taxonomie cliqué.

Rq : Ces champs personnalisés ne peuvent être utilisés que pour les vues "/news-grid" et "/news-list".


- **Actency news list configuration,**<a id="act_news_list_config"></a>
- **Actency news grid configuration**<a id="act_news_grid_config"></a>

Ces modules contiennent les fichiers de configuration (*.yml) du mode d’affichage "News list" ou "News grid" qui sera utilisé par la vue des « News » .

- **Actency news grid,**<a id="act_news_grid"></a>
- **Actency news list**<a id="act_news_list"></a>

Ces modules contiennent le fichier de configuration (*.yml) de la vue "News grid" ou "News list". 

- **Actency news grid with highlight,**<a id="act_news_grid_highlight"></a>
- **Actency news list with highlight,**<a id="act_news_list_highlight"></a>
- **Actency news list mini**<a id="act_news_list_mini"></a>

Ces modules contiennent les fichiers de configuration (*.yml) du mode d’affichage "News grid with highlight", "News list with highlight" ou "News list mini"  et de la vue "News grid with highlight", "News list with highlight" ou "News list mini".   

- **Actency news link “Back to all news”**<a id="act_news_back"></a>

Ce module contient la définissions du bloc "Back to all news". Ce bloc contient un lien de retour à la vue des news. Il ne pourra être affiché que sur les pages d’un nœud de type "News".

