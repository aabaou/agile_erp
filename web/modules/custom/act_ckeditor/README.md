# Module Actency CKEditor <a id="module"></a>
1. [List of CKEditor plugins added automatically by the act_ckeditor module](#list)
2. [How to install libraries manually](#manually)

Before activating this module it is advisable to run the script [ckeditor.sh](../../../../scripts/drupal/README.md) otherwise you will have to manually add the libraries that it uses.


## List of [CKEditor plugins](http://ckeditor.com/addons/plugins/all ) added automatically by the act_ckeditor module <a id="list"></a>
This module automatically adds a number of add-ons to CKEditor.

[ckeditor.sh](../../../../scripts/drupal/README.md) searches for the CKEditor version and downloads the libraries required by act_ckeditor. You must configure your WYSIWYG toolbar to include the buttons that have been added.

- **Colorbutton** : This plugin adds the Text Color and Background Color feature to the editor.
- **Dialog** (Required by smiley and templates) : This plugin provides the Dialog API for other plugins to build an editor Dialog from a definition object.
- **Fakeobjects** (Required by pagebreak) : This plugin helps to create a "representative" (image with styles) for certain elements which have problem with living in editable, it provides the API to transform an real DOM element into the "fake" one, and to restore the real element from the fake one on the output.
- **Floatpanel** (Required by colorbutton) : This plugin along with the panel plugin is to provide the basis of all editor UI panels - dropdown, menus, etc.
- **Pagebreak** : This plugin adds toolbar button which inserts horizontal page breaks.
- **Panelbutton** : This plugin extends the Button Interface plugin and represents a single dropdown menu item, color panel, etc.
- **Preview** : This plugin adds toolbar button which shows a preview of the document as it will be displayed to end users or printed.
- **Print** : This plugin activates the printing function. A standard operating system printing pop-up window will appear where you will be able to choose the printer as well as all relevant options.
- **Smiley** : This plugin provides a set of emoticons to insert into the editor via a dialog window.
- **Templates** : Quick one-click insertion various usefull HTML templates to your CKEditor's document.

[Back to the top of the page](#module) | [Return to project summary](../../../../README.md)

## How to install libraries manually <a id="manually"></a>
If you do not use the ckeditor.sh script, you will need to create a libraries folder at the root of the site.

You need to find out which CKEditor version your Drupal is using in order to download the appropriate version of the plugin. Find the core/assets/vendor/ckeditor/ckeditor.js file inside Drupal code and search for "version." You will find it beside the "timestamp".

On the [plugins page](http://ckeditor.com/addons/plugins/all), check for the right version to download for your CKEditor. Unzip the file and place the resulting folder inside the libraries folder on your Drupal root directory.

After this step, all you have to do is activate the act_ckeditor module (Actency CKEditor) once you have downloaded all the libraries it uses.

You will need to configure your WYSIWYG toolbar to include the buttons that have been added.

[Back to the top of the page](#module) | [Return to project summary](../../../../README.md)
