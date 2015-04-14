<?php

include_once "header.php";

echo "<div class='mainWindow'>";
echo "<div class='content'>";

if ($_POST){
	$arrUserFields = array('strUserID','strPassword','strRepeatPassword');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $arrUserFields) === true) {
			$arrErrors[] = 'Fields not filled out properly. Try again.';
			break 1;
		}
	}
	
	if (empty($arrErrors) === true) {
		if (user_exists($_POST['strUserID'])) {
			$arrErrors[] = 'Error: That username already exists.';
		}
		
		if (strlen($_POST['strPassword']) < 6) {
			$arrErrors[] = 'Error: Password must be at least 7 characters.';
		}
		
		if ($_POST['strPassword'] !== $_POST['strRepeatPassword']) {
			$arrErrors[] = 'Error: Passwords dont match.';
		}
		
		if(empty($arrErrors) === true){
			$arrRegisterData = array(
				'strUserID' => $_POST['strUserID'],
				'strPassword' => $_POST['strPassword'],
				'dtmCreatedOn' => date('Y-m-d H:i:s'),
				'strCreatedBy' => 'system'
			);
			register_user($arrRegisterData);
			echo "Registered successfully.";
		}
		else{
			foreach($arrErrors as $key => $value){
				echo $value;
			}
		}
	}
	else{
		foreach($arrErrors as $key => $value){
			echo $value;
		}
	}
}
else{

?>

<form action="" method="post">
	<ul>
		<h2>Register</h2>
		<li>Username:</li>
		<li><input type="text" id="userIDTextField" name="strUserID"></li>
		<li>Password:</li>
		<li><input type="password" name="strPassword"></li>
		<li>Confirm Password:</li>
		<li><input type="password" name="strRepeatPassword"></li>
		<li><input type="submit" value="Submit"></li>
	</ul>
</form>

<?php
}
echo "</div></div>";
include_once "footer.php";
?>