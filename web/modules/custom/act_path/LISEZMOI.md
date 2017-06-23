# Module Actency Path

Ce module est un service  qui permet de récupérer le chemin ou le nom de la route de la vue des news ou des événements.

**Pourquoi utiliser un service ?**

Les vues des news ("News grid", "News grid with highlight", "News list" et "News list with highlight") est chargée en ajax lors de la modification d’un critère de filtrage ou de trie. 

Exemple avec la vue "News-grid" : Pour la vue « News grid » le chemin courant déterminé par \Drupal::service('path.current')->getPath() vaut "/news-grid".
Cependant si la page est chargée en ajax ce chemin vaut "//news-grid" ou "//views/ajax".
Ce service a donc été créé pour déterminer si le chemin courant correspond à la vue "News grid".

Ce service définit plusieurs méthodes :
- **isNewsGrid()** : retourne true si le chemin courant correspond à la vue "News grid" ou "News grid with highlight";
- **isNewsList()** : retourne true si le chemin courant correspond à la vue "News list" ou "News list with highlight";
- **getRouteNameNewsGrid()** : retourne le nom de la route de la vue des news sous forme de grille. Si aucune vue des news sous forme de grille existe, la méthode retourne false;
- **getRouteNameNewsList()** : retourne le nom de la route de la vue des news sous forme de liste. Si aucune vue des news sous forme de liste existe, la méthode retourne false.
- **getRouteNameNewsViews()** : retourne le nom de la route de la vue des news actuelle. Si aucune vue des news existe, la méthode retourne false;
- **isEventsGrid()** : retourne true si le chemin courant correspond à la vue "Events grid" ou "Events grid with highlight";
- **isEventsList()** : retourne true si le chemin courant correspond à la vue "Events list" ou "Events list with highlight";
- **getRouteNameEventsGrid()** : retourne le nom de la route de la vue des événements sous forme de grille. Si aucune vue des évènements sous forme de grille existe, la méthode retourne false;
- **getRouteNameEventsList()** : retourne le nom de la route de la vue des évènements sous forme de liste. Si aucune vue des évènements sous forme de liste existe, la méthode retourne false;
- **getRouteNameEventsViews()** : retourne le nom de la route de la vue des évènements actuelle. Si aucune vue des évènements existe, la méthode retourne false.

**Pour utiliser le service :**

$path=\Drupal::service('act_path.path_view_news_events');

**Pour utiliser une méthode du service :**

$path->nomMethode();

*Exemple:*
$path->isNewsGrid();
