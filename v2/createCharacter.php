<?php

include_once "header.php";

echo "<div class='mainWindow'><div class='content'>";

	if(!empty($_POST)){
		$intHeight = getHeightInCM($_POST['intHeightFeet'], $_POST['intHeightInches']);
		$objCharacter = new RPGCharacter();
		$objCharacter->createNewCharacter($_SESSION['objUser']->getStringUserID(), $_POST['strRPGCharacterName'], $_POST['dblWeight'], $intHeight, $_POST['strGender'], $_POST['strOrientation'], $_POST['strPersonality'], $_POST['strFatStance'], $_POST['strHairColour'], $_POST['strHairLength'], $_POST['strEyeColour'], $_POST['strEthnicity']);
		$_SESSION['objRPGCharacter'] = $objCharacter;
		$_SESSION['blnNewCharacter'] = true;
		header('Location: main.php?page=DisplayGameUI');
		exit;
	}
	else{
		echo 'you do not have permission to view this page';
	}
	
echo "</div></div>";

include_once "footer.php";

?>