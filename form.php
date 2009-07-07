<?php
/*
==============================================================================
		INIT SECTION
==============================================================================
*/
// name of the language file that needs to be included
$language_file = 'form';
include ('../inc/global.inc.php');
$this_section=SECTION_COURSES;

// notice for unauthorized people.
api_protect_course_script(true); 
 
$nameTools = get_lang('FormManagement');

/*
-----------------------------------------------------------
	Libraries
-----------------------------------------------------------
*/
require_once (api_get_path(LIBRARY_PATH).'course.lib.php');

/*
-----------------------------------------------------------
	Header
-----------------------------------------------------------
*/
/*if (!isset ($_GET['origin']) || $_GET['origin'] != 'learnpath')
{ //so we are not in learnpath tool
	event_access_tool(TOOL_GROUP);
	if (! $is_allowed_in_course) api_not_allowed(true);
}*/

Display::display_header(get_lang('Forms'));
$para_form_table = Database::get_course_table(TABLE_PARA_FORM);

//$form_amount = $_GET['form_amount'];
$i = 1;
if (api_is_allowed_to_edit()) 
{
	if(!isset($_GET['form_amount']))
	{
		echo 'Combien de champs souhaitez vous ajouter à votre formulaire?';
		
		echo '<br/><FORM method="get" action="form.php">
		<TABLE BORDER=0>
			<TR>
				<TD>
				<SELECT name="form_amount">';
				for($i=1; $i<20; $i++)
				{
					echo '<OPTION VALUE="'.$i.'">'.$i.'</OPTION>';
				}
				echo '</SELECT>
				<INPUT type="submit" value="Ok">
				</TD>
			</TR>';
		echo '</TABLE></FORM>';
	}
	else
	{
		echo '<br/><FORM method="post" action="form.php">
		<TABLE BORDER=0>
			<TR>
				<TD>';
		echo 'Titre du formulaire ';
		echo '<INPUT type=text name="title"><br/>';
		for($i=1; $i<$_GET['form_amount'] + 1 ; $i++)
		{
			echo 'Champ n°'.$i.'  ';
			echo '<INPUT type=text name="'.$i.'"><br/>';
		}
		$form_amount = $_GET['form_amount'];
		//echo $form_amount;
		echo '<INPUT type="hidden" name="num" value="'.$form_amount.'">';
		echo '<INPUT type="submit" value="Valider">
				</TD>
			</TR>';
		echo '</TABLE></FORM>';
	}
	
	if(isset($_POST['num']))
	{
		//echo $_POST['num'];
		
		for($i=1; $i<$_POST['num'] + 1 ; $i++)
		{
			echo $_POST[''.$i.''] . '<br />';
			$sql = "INSERT INTO " .$para_form_table." (
			`num_par` ,
			`title`
			)
			VALUES (
			'".$i."', '".$_POST[''.$i.'']."'
			)";
			$result = mysql_query($sql);
		}
	}
}
else
{
	echo 'apprenant ou prof';
}
/*
==============================================================================
		FOOTER
==============================================================================
*/
if (!isset ($_GET['origin']) || $_GET['origin'] != 'learnpath')
{
	Display::display_footer();
}
?>