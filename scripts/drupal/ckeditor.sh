#!/bin/bash


function displayOperation {
  echo -e "\e[7;49;32m$1\e[0m"
}

function displayError {
  echo -e "\e[7;49;31m$1\e[0m"
}


#Asks the user the version of ckeditor
while ! [[ $version =~ ^4\.[5-7]\.[0-9]{1,2}$ ]]
do
        read -p 'What is your version of ckeditor (example: 4.6.2) :' version
		echo $version
		if ! [[ ${version} =~ ^4\.[5-7]\.[0-9]{1,2}$ ]]; then
			displayError "The version is invalid"
		fi
done

#If the version is valid
if [[ ${version} =~ ^4\.[5-7]\.[0-9]{1,2}$ ]]; then

    displayOperation "Download CKEditor libraries"

	#Creates the libraries directory   
	if [[ ! -d ../libraries ]];then
		mkdir ../libraries   
	fi

	cd ../libraries	
	
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

	#Download libraries
	for library in ${libraries[*]}
	do
		if [[ -d "${library}" ]];then
			rm -r "${library}"   
			
		fi
		
		wget "http://download.ckeditor.com/${library}/releases/${library}_$version.zip"
		unzip "${library}_$version.zip" 
		rm "${library}_$version.zip" 

	done


fi
