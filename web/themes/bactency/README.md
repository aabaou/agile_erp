<!-- @file Instructions for subtheming using the Sass Starterkit. -->
<!-- @defgroup sub_theming_sass -->
<!-- @ingroup sub_theming -->
# Bactency
Below are instructions on how to create a Bootstrap sub-theme using a Sass preprocessor.

- [Starting theming](#starting-theming)
- [Gulp commands](#gulp-commands)
- [Official documentation](#official-documentation)
- [Compass utilities](#compass-utilities)
- [About bactency](#about-bactency)
- [See also](#see-also)

## Starting theming
If you didn't already initialized your project you first need to install the required NPM libraries.
To do so please go to the current folder (/web/themes/bactency) and run the following command:
```sh
npm install --no-bin-links
```
The `--no-bin-links` option is important if you work on Actency's docker VM as npm may not find a proper way to install the packages otherwise.
If the process is stopped by this error `RangeError: Maximum call stack size exceeded`, then proceed with the following commands:
```sh
npm rebuild --no-bin-links
npm install --no-bin-links
```
This operation may take a while, but it should work. If it's still broken for some reason you can try repeating the process.
If at the end of the process any gulp command fails due to a missing package you can install it globally with the following command:
```sh
npm install -g [package name]
```
You can find additional solutions for difficulties installing the packages [here](http://techblog.actency.fr/comment/23#comment-23).

## Gulp commands
Bactency ships with a bunch of predefined commands to help you in your work.
To run these please go in the current folder (/web/themes/bactency) after having properly initialized the project (see [Starting theming](#starting-theming)):

```sh
gulp
```
> Equivalent of a compass watch, if you don't know what to run, proceed with this one.

```sh
gulp images
```
> Images minification

```sh
gulp jshint
```
> Check javascript quality code

```sh
gulp beautify
```
> Format js

```sh
gulp compress
```
> Minify js

```sh
gulp drush
```
> Same as drush cc css-js

## Official documentation
To help consolidate and remove possible future inconsistencies, the documentation for this sub-theme starter kit rely on the official drupal bootstrap sub-theming documentation, available [here](http://drupal-bootstrap.org/api/bootstrap/docs%21Sub-Theming.md/group/sub_theming/8) (See Sass implementation).

## Compass utilities
Compass utilities are very helpfull. You can find all here : http://compass-style.org/index/mixins/

## About Bactency
This is Actency's Bootstrap SASS sub-theme starterkit.

We can work here on a cool "out of the box" version for every new projects :)

Do not sub-theme this theme again, simply use it as is.

It is not recommended to rename it for your project but it's not forbidden. If you proceed to change its name, please be careful with hooks etc.

#### See also:
- @link theme_settings Theme Settings @endlink
- @link templates Templates @endlink
- @link plugins Plugin System @endlink

[Bootstrap Framework]: http://getbootstrap.com
[Bootstrap Framework Source Files]: https://github.com/twbs/bootstrap-sass
[Sass]: http://sass-lang.com
