#!/bin/bash


function displayOperation {
  echo -e "\e[7;49;32m$1\e[0m"
}

function displayError {
  echo -e "\e[7;49;31m$1\e[0m"
}
function displayWarning {
  echo -e "\e[7;49;33m$1\e[0m"
}

#Asks the user the version of ckeditor
#while ! [[ $version =~ ^4\.[5-7]\.[0-9]{1,2}$ ]]
#do
#        read -p 'What is your version of ckeditor (example: 4.6.2) :' version
#		echo $version
#		if ! [[ ${version} =~ ^4\.[5-7]\.[0-9]{1,2}$ ]]; then
#			displayError "The version is invalid"
#		fi
#done

version_chaine=$(grep -o 'version:\"4\.[5-7]\.[0-9]\{1,2\}\"' "../web/core/assets/vendor/ckeditor/ckeditor.js")

if [[ $version_chaine ]] ; then    
    displayWarning "CkEditor $version_chaine"
	version=$(echo $version_chaine | cut -d'"' -f2)


	#If the version is valid
	if [[ ${version} =~ ^4\.[5-7]\.[0-9]{1,2}$ ]]; then

		displayOperation "Download CKEditor libraries"

		#Creates the libraries directory   
		if [[ ! -d libraries ]];then
			mkdir libraries   
		fi

		cd libraries	
		
		#Libraries to download
		libraries=(
					"colorbutton" 
					"dialog" 
					"div" 
					"fakeobjects" 
					"floatpanel"
					"pagebreak" 
					"panelbutton" 
					"preview" 
					"print" 
					"smiley" 
					"templates" 
					
				)
		
		#Downloads the libraries required by the file_browser module
		if [[ ! -d imagesloaded ]];then
			wget "https://github.com/desandro/imagesloaded/archive/master.zip"
			unzip "master.zip"
			rm "master.zip"
			mv imagesloaded-master imagesloaded
		fi
		
		if [[ ! -d masonry ]];then
			wget "https://github.com/desandro/masonry/archive/v4.1.1.zip"
			unzip "v4.1.1.zip"
			rm "v4.1.1.zip"
			mv masonry-4.1.1 masonry
		fi
		
		if [[ ! -d dropzone ]];then
			wget "https://github.com/enyo/dropzone/archive/master.zip"
			unzip "master.zip"
			rm "master.zip"
			mv dropzone-master dropzone
		fi
		
		#Downloads libraries required by act_ckeditor
		for library in ${libraries[*]}
		do
			if [[ -d "${library}" ]];then
				rm -r "${library}"   
				
			fi
			
			wget "http://download.ckeditor.com/${library}/releases/${library}_$version.zip"
			unzip "${library}_$version.zip" 
			rm "${library}_$version.zip"

			#If a library could not be downloaded,
			if [[ ! -d "${library}" ]];then
			
				#An error message is displayed
			    displayError "The library ${library} could not be installed"
				
				#We delete the .php file that includes this library
			    cd ../web/modules/custom/act_ckeditor/src/Plugin/CKEditorPlugin
				file=$(grep -lR "libraries/${library}" *)
				if [[ -f $file ]];then
					rm $file
				fi
				
			fi

		done

		
		cd /var/www/html/web/modules/contrib
		
	
		#Modules to download
		modules=(
					"youtube"
					"embed" 
					"dropzonejs" 
					"anchor_link" 
					"entity" 
					"entity_embed" 
					"entity_browser" 
					"file_browser"
					"imce" 
					"layouter" 
					
				)
		#Downloads and activates modules required by act_ckeditor
		displayOperation "Download modules required by act_ckeditor"
		for module in ${modules[*]}
		do
			
			if [[ ! -d "${module}" ]];then
				drush dl ${module} && drush en ${module} -y
			else
				drush en ${module} -y
			fi
			
		done
		
		#Activates act_ckeditor module
		drush en act_ckeditor -y
	fi

else
    echo "Can not find ckeditor's version"
fi
