#!/bin/bash

function displayOperation {
  echo -e "\e[7;49;32m$1\e[0m"
}

function displaySuccess {
  echo -e "\e[5;49;32m$1\e[0m"
}

cd /var/www/html/web

read -e -i "$themename" -p "What is the name of the subtheme ? " input
themename="${input:-$themename}"

echo "Copy bootstrap SASS starterkits"
cp -rf themes/contrib/bootstrap/starterkits/sass themes/custom/${themename}

cd themes/custom/${themename}

displayOperation "Downloading bootstrap framework"
wget "https://github.com/twbs/bootstrap-sass/archive/master.zip"
            unzip "master.zip"
            rm "master.zip"
            mv bootstrap-sass-master bootstrap

displayOperation "Rename files"
    mv THEMENAME.starterkit.yml ${themename}.info.yml
    displaySuccess ${themename}".info.yml"
    mv THEMENAME.libraries.yml ${themename}.libraries.yml
    displaySuccess ${themename}".libraries.yml"
    mv THEMENAME.theme ${themename}.theme
    sed -ie "s/THEMETITLE/${themename}/g" ${themename}.info.yml
    displaySuccess ${themename}".theme"
    rm ${themename}.info.ymle

displayOperation "Moving files"
    mv scss/ sass
    mkidr bootstrap
    mv component bootstrap/component
    mv jquery-ui bootstrap/jquery-ui
displaySuccess "Boostrap sass files moved"

    cp ../bactency/gulpfile.js gulpfile.js
    cp ../bactency/package.json package.json
    cp ../bactency/readme.md readme.md
displaySuccess "Bactency files moved"

displayOperation "Installing gulp"
    npm install gulp --no-bin-link
    npm install gulp-load-plugins --no-bin-link
    npm install gulp-autoprefixer --no-bin-link
    npm install gulp-notify --no-bin-link
    npm install gulp-sass --no-bin-link
    npm install gulp-shell --no-bin-link
    npm install gulp-sourcemaps --no-bin-link
    npm install gulp-imagemin --no-bin-link
    npm install gulp-jshint --no-bin-link
    npm install jshint-stylish --no-bin-link
    npm install gulp-uglify --no-bin-link
    npm install gulp-beautify --no-bin-link
    npm install gulp-csso --no-bin-link
    npm install gulp-accessibility --no-bin-link
    npm install gulp-scss-lint --no-bin-link
    npm install gulp-jsvalidate --no-bin-link
    npm install gulp-css-url-adjuster --no-bin-link

gulp sass

displaySuccess "Gulp installed & compiled"
displayOperation "Activate new theme"
    cd ../../
    drush drush config-set system.theme default ${themename} -y
    drush cr
