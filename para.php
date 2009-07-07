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
	if(isset($_POST['modify']))
	{
		$sql = "SELECT title FROM " .$para_form_table." WHERE 1";
		$result = mysql_query($sql);
		while ($data = mysql_fetch_array($result)){
			echo $data['title'];
		}
	}
	
	if(!isset($_GET['create']))
	{
		/*echo 'Combien de champs souhaitez vous ajouter à votre formulaire?';
		
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
		echo '</TABLE></FORM>';*/
		echo '<a href="para.php?'.api_get_cidreq().'&create=1">'.get_lang('ParaCreate').'</a>&nbsp;<br/>';
		echo '<a href="para.php?'.api_get_cidreq().'&modify=1">'.get_lang('ParaModify').'</a>&nbsp;<br/>';
	}
	else
	{
		echo '<br/><FORM method="post" action="para.php">
		<TABLE BORDER=0>
			<TR>
				<TD>';
		echo 'Intitul&eacute; du paragraphe ';
		echo '<INPUT type=text name="title"><br/>';
		echo 'Description du paragraphe';
		echo '<INPUT type=text name="desc"><br/>';
		$form_amount = $_GET['form_amount'];
		//echo $form_amount;
		echo '<INPUT type="hidden" name="create_valid" value="create_valid">';
		echo '<INPUT type="submit" value="Valider">
				</TD>
			</TR>';
		echo '</TABLE></FORM>';
	}
	
	if(isset($_POST['create_valid']))
	{
		//echo $_POST['num'];
		echo $_POST['create_valid'] . '<br />';
		$sql = "INSERT INTO " .$para_form_table." (
		`title` ,
		`desc`
		)
		VALUES (
		'".$_POST['title']."', '".$_POST['desc']."'
		)";
		$result = mysql_query($sql);
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