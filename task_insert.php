<html>
<head><META http-equiv="Refresh"
content="0; URL=tasks.php"></head>
<?php

/*
==============================================================================
		INIT SECTION
==============================================================================
*/
// name of the language file that needs to be included
$language_file = 'task';
include ('../inc/global.inc.php');
$this_section=SECTION_COURSES;

// notice for unauthorized people.
api_protect_course_script(true); 
 
$nameTools = get_lang('TaskManagement');

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
Display::display_header(get_lang('Tasks'));

/*
-----------------------------------------------------------
	Content
-----------------------------------------------------------
*/

//require_once (api_get_path(LIBRARY_PATH) . "course.lib.php");
	$task_table = Database::get_course_table(TABLE_TASK);
	//$currentCourseRepositorySys = api_get_path(SYS_COURSE_PATH) . $_course["path"] . "/";
	/*$sql = "SELECT * FROM " .$task_table." WHERE 1";
	$result = mysql_query($sql);*/
	$submit = $_POST['submit'];
	echo "<p>submit : ".$submit."</p>";

	$desc = $_POST['desc'];
	echo "<p>La description est : ".$desc."</p>";
	
	$link = $_POST['link'];
	echo "<p>Le lien est : ".$link."</p>";
	
	$day_debut = $_POST['day_debut'];
	echo "<p>Le jour de début est : ".$day_debut."</p>";
	
	$month_debut = $_POST['month_debut'];
	echo "<p>Le mois de début est : ".$month_debut."</p>";
	
	switch ($month_debut) {
		case january:
			$month_debut = "01";
			break;
		case february:
			$month_debut = "02";
			break;
		case march:
			$month_debut = "03";
			break;
		case march:
			$month_debut = "04";
			break;
		case march:
			$month_debut = "05";
			break;
		case march:
			$month_debut = "06";
			break;
		case march:
			$month_debut = "07";
			break;
		case march:
			$month_debut = "08";
			break;
		case march:
			$month_debut = "09";
			break;
		case march:
			$month_debut = "10";
			break;
		case march:
			$month_debut = "11";
			break;
		case march:
			$month_debut = "12";
			break;
	}
	
	$year_debut = $_POST['year_debut'];
	echo "<p>L'année de début est : ".$year_debut."</p>";
	
	$day_end = $_POST['day_end'];
	echo "<p>Le jour de fin est : ".$day_end."</p>";
	
	$month_end = $_POST['month_end'];
	echo "<p>Le mois de fin est : ".$month_end."</p>";
	
		switch ($month_end) {
		case january:
			$month_end = "01";
			break;
		case february:
			$month_end = "02";
			break;
		case march:
			$month_debut = "03";
			break;
		case march:
			$month_debut = "04";
			break;
		case march:
			$month_debut = "05";
			break;
		case march:
			$month_debut = "06";
			break;
		case march:
			$month_debut = "07";
			break;
		case march:
			$month_debut = "08";
			break;
		case march:
			$month_debut = "09";
			break;
		case march:
			$month_debut = "10";
			break;
		case march:
			$month_debut = "11";
			break;
		case march:
			$month_debut = "12";
			break;
	}
	
	$year_end = $_POST['year_end'];
	echo "<p>L'année de fin est : ".$year_end."</p>";
	
	$dest = $_POST['dest'];
	echo "<p>Le destinataire est : ".$dest."</p>";
	
/*INSERT INTO `dokeos_podcastcourse`.`task` (
`desc` ,
`lien` ,
`date_debut` ,
`date_fin` ,
`destinataire` ,
`id_para_form`
)
VALUES (
'Petite description', 'lien', '2009-02-20', '2009-02-25', 'etudiant', '2'
);*/
$date_debut = $year_debut."-".$month_debut."-".$day_debut;
$date_end = $year_end."-".$month_end."-".$day_end;
echo $date_debut;

$sql = "INSERT INTO " .$task_table." (
`desc` ,
`lien` ,
`date_debut` ,
`date_fin` ,
`destinataire`
)
VALUES (
'".$desc."', '".$link."', '".$date_debut."', '".$date_end."', '".$dest."'
)";
$result = mysql_query($sql);

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
</html>