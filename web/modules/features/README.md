The starterkit provides several feature modules providing a basic system of News and Events.

These modules have been subdivided into several sub-modules to allow the user to select only the elements he needs for his project and avoid unused configurations.
To use the News or Event system: 
1.	Activate the module "Responsive image" of Drupal;
2.	Activate the module "[Actency view default configuration](#act_view_default)". 

# SUMMARY

- [Activate the News system](#news)
-	[Activate the Events system](#events)
-	[Content of modules](#modules)

# Activate the News system <a id="news"></a>

To use the News system : 
1.	Activate the module "[Actency news](#act_news)";
2.	Activate the module "[Actency path](#act_path)";
3.	If you want use one of the views in the news system : activate the module "Smart trim" (https://www.drupal.org/project/smart_trim ) and "Better exposed filter" (https://www.drupal.org/project/better_exposed_filters )
4.	The news system offers different views listing all the contents type "News" whose status is published :
     - A list view ( path : "/news-list");
     - A list view with the first item highlighted ( path : "/news-list");
     - A grid view ( path : "/news-grid");
     - A grid view with the first item highlighted ( path : "/news-grid").

**To use the list view**, activate modules :
-	"[Actency view list configuration](#act_view_list)";
-	"[Actency news list configuration]("act_news_list_config)";
-	"[Actency news list](#act_news_list)".

**To use the list view with the first item highlighted**, activate modules :
-	"[Actency view list configuration](#act_view_list)";
-	"[Actency view list highlight configuration]("act_view_list_highlight)";
-	"[Actency news list configuration]("act_news_list_config)";
-	"[Actency news list with highlight](#act_news_list_highlight)".

<span style="color:red">Warning: Only one of the "Actency news list" or "Actency news list with highlight" modules must be activated.If both modules are enabled, you will have two views accessible via the "/news-list" path.</span>

**To use the grid view**, activate modules  :
-	"[Actency view grid configuration](#act_view_grid)"; 
-	"[Actency news grid configuration](#act_news_grid_config)"; 
-	"[Actency news grid](#act_news_grid)". 

**To use the grid view with the first item highlighted**, activez les modules :
-	"[Actency view grid configuration](#act_view_grid); 
-	"[Actency news grid configuration](#act_news_grid_config)"; 
-	"[Actency news grid with highlight](#act_news_grid_highlight)". 

<span style="color:red">Warning: Only one of the "Actency news grid" or "Actency news grid with highlight" modules must be activated.If both modules are enabled, you will have two views accessible via the "/news-grid" path.</span>

5.The news system provides a block displaying the last 3 published news. To use this block, activate modules:

-	"[Actency view list configuration](#act_view_list)";
-	"[Actency view list mini configuration](#act_view_list_mini)";
-	"[Actency news list mini](#act_news_list_mini)";
-	Position this block in the region of your choice of your theme.


6.The news system provides a link back to the news view. This link is in a block and will be displayed only on the pages of a "News" node. To use this block, activate the module:
-	"[Actency news link 'Back to all news'](#act_news_back)”;
-	Position this block in the region of your choice of your theme.

Rq : When configuring the block, select:
-	The content type "News". If another type of content is selected, the link will not be displayed;
-	Default view mode: This option corresponds to the display mode (list or grid) of the news view to which the link will point.

# Activate the Events system <a id="events"></a>

To use the Events system :
1.	Activate the module "[Actency events](#act_events)"; 
2.	Activate the modulee "[Actency path](#act_path)";
3.	If you want use one of the views in the events system : activate the module "Smart trim" (https://www.drupal.org/project/smart_trim ).
4.	The events system offers different views listing all the contents type "Events" whose status is published :
      - A list view ( path : "/events-list");
      - A list view with the first item highlighted ( path : "/events-list");
      - A grid view ( path : "/events-grid");
      - A grid view with the first item highlighted ( path : "/events-grid");
      - A calendrar view (path : "/events-calendar/day" , "/events-calendar/week", "/events-calendar/month", "/events-calendar/year")


**To use the list view**, activate modules :
-	"[Actency view list configuration](#act_view_list)";
-	"[Actency events list](#act_events_list)".

**To use the list view with the first item highlighted**, activate modules :
-	"[Actency view list configuration](#act_view_list)";
-	"[Actency view list highlight configuration]("act_view_list_highlight)";
-	"[Actency events list with highlight](#act_events_list_highlight)".

<span style="color:red">Warning: Only one of the "Actency events list" or "Actency events list with highlight" modules must be activated.If both modules are enabled, you will have two views accessible via the "/events-list" path.</span>

**To use the grid view**, activate modules :
-	"[Actency view grid configuration](#act_view_grid);
-	"[Actency events grid](#act_events_grid)".

**To use the grid view with the first item highlighted**, activate modules :
-	"[Actency view grid configuration](#act_view_grid); 
-	"[Actency events grid with highlight](#act_events_grid_highlight)".

<span style="color:red">Warning: Only one of the "Actency events grid" or "Actency events grid with highlight" modules must be activated.If both modules are enabled, you will have two views accessible via the "/events-grid" path.</span>

**To use the calendar view**, activate modules :
-	Drupal : "Calendar" (https://www.drupal.org/project/calendar) and its dependence "views templates" (https://www.drupal.org/project/views_templates); 
-	"[Actency events calendar](#act_events_calendar)".


5.The events system provides a block displaying the last 3 published events. To use this block, activate modules:
-	"[Actency view list configuration](#act_view_list)"; 
-	"[Actency view list mini configuration](#act_view_list_mini)";
-	"[Actency events list mini](#act_events_list_mini)";
- Position this block in the region of your choice of your theme.

6.The events system provides a link back to the events view. This link is in a block and will be displayed only on the pages of a "Events" node. To use this block, activate the module:
-	"[Actency events link “Back to all events”](#act_events_back)";
-	Position this block in the region of your choice of your theme. 

Rq : When configuring the block, select:
-	The content type "Events". If another type of content is selected, the link will not be displayed;
-	Default view mode: This option corresponds to the display mode (list or grid) of the events view to which the link will point.

# Contents of modules  <a id="modules"></a>
## Modules common to both systems (News and Events)

- **Actency view default configuration**<a id="act_view_default"></a>

This module contains the configuration files (* .yml) of the image formats and the adaptive image style that will be used to display a "News" or "Events" node.

- **Actency view grid configuration,**<a id="act_view_grid"></a>
- **Actency view list configuration,**<a id="act_view_list"></a>
- **Actency view list highlight configuration,**<a id="act_view_list_highlight"></a>
- **Actency list mini configuration,**<a id="act_view_list_mini"></a>

These modules contain the configuration files (* .yml) of the image formats and the adaptive image style that will be used by the "News" or "Events" view.

- **Actency path**<a id="act_path"></a>

[Read service documentation](act_path/README.md)

## Events modules

- **Actency events**<a id="act_events"></a>

This module contains the configuration files (* .yml) of the content type "Events" and the fields of this content. It also defines a date format "month year" (example: June 2017) and custom fields "Image formatter for Events" and "Text formatter for Events".
- "Image formatter for Events" : This field links the image to the content and transmits the current display mode (grid or list) of the events view to the page of a node. The link URL of the image will be http://monsite/node/{id}?mode={mode} where {mode} is the current display mode (grid or list) of the events view.
-	"Text formatter for Events" : This field was created to modify the url of the "Read more" link of the node. By default, the URL of this link is http://monsite/node/{id}. The url has been changed to http://monsite/node/{id}?mode={mode} where {mode} is the current display mode (grid or list) of the events view.

Note: These custom fields can only be used for the "/events-grid" and "/events-list" views.

- **Actency events calendar**<a id="act_events_calendar"></a>

This module contains the configuration file (* .yml) of the calendar view and the date format "hour minute".

- **Actency events grid,**<a id="act_events_grid"></a>
- **Actency events grid with highlight,**<a id="act_events_grid_highlight"></a>
- **Actency events list,**<a id="act_events_list"></a>
- **Actency events list with highlight,**<a id="act_events_list_highlight"></a>

These modules contain the configuration file (* .yml) of the event view in the form of a grid, grid with the first element highlighted, list, list with the first element highlighted.

- **Actency events list mini**<a id="act_events_list_mini"></a>

This module contains the configuration files (* .yml) of the display mode "Events list mini" and the block view "Events list mini".

- **Actency events link “Back to all events”**<a id="act_events_back"></a>

This module contains the definitions of the "Back to all events" block. This block contains a link back to the events view. It can only be displayed on the pages of an "Events" node.


## News modules

- **Actency news**<a id="act_news"></a>

This module contains the configuration files (* .yml) of the content type "News", the fields of this content and the "News" vocabulary. It also defines the custom fields "Image formatter for News", "Category formatter for News" and "Text formatter for News".
-	"Image formatter for News" : This field links the image to the content and transmits the current display mode (grid or list) of the news view to the page of a node. The link URL of the image will be http://monsite/node/{id}?mode={mode} where {mode} is the current display mode (grid or list) of the news view.
-	"Text formatter for News" : This field was created to modify the url of the "Read more" link of the node. By default, the URL of this link is http://monsite/node/{id}. The url has been changed to http://monsite/node/{id}?mode={mode} where {mode} is the current display mode (grid or list) of the news view.
-	"Category formatter for News" : This field allows, when clicking on a taxonomy term, not to be directed to http://monsite/taxonomy/term/{id} but to the address http://monsite/news-grid/act_categorie={id} or http://monsite/news-list/act_categorie={id} which corresponds to the view of the news already filtered by the term of taxonomy clicked.

Note: These custom fields can only be used for the "/news-grid" and "/news-list" views.


- **Actency news list configuration,**<a id="act_news_list_config"></a>
- **Actency news grid configuration**<a id="act_news_grid_config"></a>

These modules contain the configuration files (* .yml) of the "News list" or "News grid" display mode that will be used by the "News" view.

- **Actency news grid,**<a id="act_news_grid"></a>
- **Actency news list**<a id="act_news_list"></a>

These modules contain the configuration file (* .yml) of the "News grid" or "News list" view.

- **Actency news grid with highlight,**<a id="act_news_grid_highlight"></a>
- **Actency news list with highlight,**<a id="act_news_list_highlight"></a>
- **Actency news list mini**<a id="act_news_list_mini"></a>

These modules contain the configuration files (* .yml) of the display mode "News grid with highlight", "News list with highlight" or "News list mini"  and the view "News grid with highlight", "News list with highlight" or "News list mini".   

- **Actency news link “Back to all news”**<a id="act_news_back"></a>

This module contains the definitions of the "Back to all news" block. This block contains a link back to the news view. It can only be displayed on the pages of an "News" node.
