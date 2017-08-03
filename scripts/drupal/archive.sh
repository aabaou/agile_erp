#!/bin/bash

#Backup of the database
    if [[ ! -d ../data/db ]];then
        mkdir ../data/db   
    fi

    date=`date +%Y%m%d%H%M%S`
    ../vendor/bin/drush sql-dump --result-file=../data/db/dump-$date --gzip

#Archive and compress the project file
	cd ../../
	# The archived project must exclude config/drupal/local and data/db folders except data/db/dump-$date.gz
	# It is necessary to proceed in 3 steps
	# 1 : Exclude folders
	# 2 : Add file to include. Note : Appending doesn't work with zipped archives.
	# 3 : Compress the project folder
	tar cvf archive.tar --exclude='html/data/db' --exclude='html/config/drupal/local' html/	
	tar rvf archive.tar html/data/db/dump-$date.gz
	gzip archive.tar

	
#Moves the archive.tar.gz file to the root of the project
	mv archive.tar.gz html/
	cd html/
	mv archive.tar.gz archive-`date +%Y%m%d%H%M%S`.tar.gz 


