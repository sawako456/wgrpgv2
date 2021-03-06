<?php include_once "header.php"; ?>

<div class='mainWindow'>
	<div class='content'>
		<b>Create your character:</b><br/>
		<form id='createCharacterForm' action='createCharacter.php' method='post' onSubmit='return checkFields(); return false;'>
			<table>
				<tr>
					<td>Name:</td>
					<td><input id='charName' type='text' maxlength='20' name='strRPGCharacterName'/></td>
				</tr>
				<tr>
					<td>Gender:</td>
					<td><select name='strGender'>
					<?php
						$arrGenders = get_enum_values('tblrpgcharacter', 'strGender');
						foreach($arrGenders as $key => $value){
							echo "<option>" . $value . "</option>";
						}
					?>
					</select></td>
				</tr>
				<tr>
					<td>Hair Colour:</td>
					<td><select name='strHairColour'>
					<?php
						$arrHairColours = get_enum_values('tblrpgcharacter', 'strHairColour');
						foreach($arrHairColours as $key => $value){
							echo "<option>" . $value . "</option>";
						}
					?>
					</select></td>
				</tr>
				<tr>
					<td>Hair Length:</td>
					<td><select name='strHairLength'>
					<?php
						$arrHairLengths = get_enum_values('tblrpgcharacter', 'strHairLength');
						foreach($arrHairLengths as $key => $value){
							echo "<option>" . $value . "</option>";
						}
					?>
					</select></td>
				</tr>
				<tr>
					<td>Eye Colour:</td>
					<td><select name='strEyeColour'>
					<?php
						$arrEyeColours = get_enum_values('tblrpgcharacter', 'strEyeColour');
						foreach($arrEyeColours as $key => $value){
							echo "<option>" . $value . "</option>";
						}
					?>
					</select></td>
				</tr>
				<tr>
					<td>Skin Tone:</td>
					<td><select name='strEthnicity'>
					<?php
						$arrEthnicities = get_enum_values('tblrpgcharacter', 'strEthnicity');
						foreach($arrEthnicities as $key => $value){
							echo "<option>" . $value . "</option>";
						}
					?>
					</select></td>
				</tr>
				<tr>
					<td>Sexual Orientation:</td>
					<td><select name='strOrientation'/>
					<?php
						$arrOrientations = get_enum_values('tblrpgcharacter', 'strOrientation');
						foreach($arrOrientations as $key => $value){
							echo "<option>" . $value . "</option>";
						}
					?>
					</select></td>
				</tr>
				<tr>
					<td>Personality:</td>
					<td><select name='strPersonality'/>
					<?php
						$arrPersonalities = get_enum_values('tblrpgcharacter', 'strPersonality');
						foreach($arrPersonalities as $key => $value){
							echo "<option>" . $value . "</option>";
						}
					?>
					</select></td>
				</tr>
				<tr>
					<td>Stance on Fat:</td>
					<td><select name='strFatStance'/>
					<?php
						$arrFatStances = get_enum_values('tblrpgcharacter', 'strFatStance');
						foreach($arrFatStances as $key => $value){
							echo "<option>" . $value . "</option>";
						}
					?>
					</select></td>
				</tr>
				<tr>
					<td>Height:</td>
					<td><input id='heightFeet' type='number' class='heightInput' min='4' max='6' value='5' name='intHeightFeet'/> feet <input id='heightInches' type='number' value='0' min='0' max='11' class='heightInput' maxlength='2' name='intHeightInches'/> inches</td>
				</tr>
				<tr>
					<td>Weight:</td>
					<td><input readonly id='weightInput' value='108' type='text' class='heightInput' maxlength='3' name='dblWeight'/> lbs</td>
				</tr>
			</table>
			<input type='submit' value='Submit'/>
		</form>
	</div>
</div>

<script type='text/javascript'>

$(document).ready(function(){
	$('input[type=number]').numeric();
	
	$('#heightFeet').bind('keyup mouseup', function(){
		idealWeight = parseInt($('#heightInches').val()) * (1.7 * 2.2);
		idealWeightFromFeet = (parseInt($('#heightFeet').val()) - 5) * (20 * 2.2);
		$('#weightInput').val(Math.round(108 + idealWeightFromFeet + idealWeight));
	});
	$('#heightInches').bind('keyup mouseup', function(){
		idealWeight = parseInt($('#heightInches').val()) * (1.7 * 2.2);
		idealWeightFromFeet = (parseInt($('#heightFeet').val()) - 5) * (20 * 2.2);
		$('#weightInput').val(Math.round(108 + idealWeightFromFeet + idealWeight));
	});
	
	$('#createCharacterForm').submit(function(e){
		checkFields(e);
	});
	
	function checkFields(e){
		if(isNaN($('#weightInput').val())){
			alert('Weight is an invalid input. Please correct and retry.');
			e.preventDefault();
			return false;
		}
		if($('#charName').val() == ''){
			alert('Please enter a character name.');
			e.preventDefault();
			return false;
		}
	}
});

</script>
		
<?php include_once "footer.php"; ?>