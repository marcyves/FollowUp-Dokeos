<?php
/*
==============================================================================
		TASK CREATION
==============================================================================

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
$section_table = Database::get_course_table(TABLE_SECTION);
$task_table = Database::get_course_table(TABLE_TASK);



if(isset($_GET['create']))
{
	echo '
	<FORM method="post" action="tasks.php">
	Cr&eacute;ation d\'une t&acirc;che :
	<TABLE BORDER=0>
	
	<TR>
		<TD>Titre</TD>
		<TD>
		<INPUT type=text name="title">
		</TD>
	</TR>
	
	<TR>
		<TD>Description</TD>
		<TD>
		<TEXTAREA rows="5" name="desc">Entrez ici la description</TEXTAREA>
		</TD>
	</TR>
	
	<TR>
		<TD>Lien</TD>
		<TD>
		<INPUT type=text name="link">
		</TD>
	</TR>
	
	<TR>
		<TD>Date de début</TD>
		<TD>
		<SELECT name="day_debut">';
		
		for($i=1;$i < 32;$i++)
		{
			if($i < 10)
			{
					echo '<OPTION VALUE="0'.$i.'">0'.$i.'</OPTION>';
			}
			else
			{
					echo '<OPTION VALUE="'.$i.'">'.$i.'</OPTION>';
			}
		}
		
		echo '</SELECT>
		<SELECT name="month_debut">
			<OPTION VALUE="01">january</OPTION>
			<OPTION VALUE="02">february</OPTION>
			<OPTION VALUE="03">march</OPTION>
			<OPTION VALUE="04">april</OPTION>
			<OPTION VALUE="05">may</OPTION>
			<OPTION VALUE="06">june</OPTION>
			<OPTION VALUE="07">july</OPTION>
			<OPTION VALUE="08">august</OPTION>
			<OPTION VALUE="09">september</OPTION>
			<OPTION VALUE="10">october</OPTION>
			<OPTION VALUE="11">november</OPTION>
			<OPTION VALUE="12">december</OPTION>
		</SELECT>
		<SELECT name="year_debut">';
		
		for($i=2009;$i < 2025;$i++)
		{
			echo '<OPTION VALUE="'.$i.'">'.$i.'</OPTION>';
		}

		echo '</SELECT>
		</TD>
	</TR>
	
	<TR>
		<TD>Date de fin</TD>
		<TD>
		<SELECT name="day_end">';
		
		for($i=1;$i < 32;$i++)
		{
			if($i < 10)
			{
					echo '<OPTION VALUE="0'.$i.'">0'.$i.'</OPTION>';
			}
			else
			{
					echo '<OPTION VALUE="'.$i.'">'.$i.'</OPTION>';
			}
		}
		
		echo '</SELECT>
		<SELECT name="month_end">
			<OPTION VALUE="01">january</OPTION>
			<OPTION VALUE="02">february</OPTION>
			<OPTION VALUE="03">march</OPTION>
			<OPTION VALUE="04">april</OPTION>
			<OPTION VALUE="05">may</OPTION>
			<OPTION VALUE="06">june</OPTION>
			<OPTION VALUE="07">july</OPTION>
			<OPTION VALUE="08">august</OPTION>
			<OPTION VALUE="09">september</OPTION>
			<OPTION VALUE="10">october</OPTION>
			<OPTION VALUE="11">november</OPTION>
			<OPTION VALUE="12">december</OPTION>
		</SELECT>
		<SELECT name="year_end">';
		
		for($i=2009;$i < 2025;$i++)
		{
			echo '<OPTION VALUE="'.$i.'">'.$i.'</OPTION>';
		}

		echo '</SELECT>
		</TD>
	</TR>
	
	<TR>
		<TD>Fonction</TD>
		<TD>
		<SELECT name="dest">
			<OPTION VALUE="prof">Enseignant</OPTION>
			<OPTION VALUE="etudiant">Etudiant</OPTION>
		</SELECT>
		</TD>
	</TR>';
	
	for($i=1;$i < 11;$i++)
	{
		echo '<TR>
			<TD>Section '.$i.'</TD>
			<TD>
				<INPUT type=text name="section_'.$i.'">
			</TD>
		</TR>';
	}
	
	echo '<TR>
		<TD COLSPAN=2>
		<INPUT type="submit" value="Envoyer">
		</TD>
	</TR>
	</TABLE>
	</FORM>';

}

if(isset($_GET['delete']))
{
	$sql = "DELETE FROM " .$task_table." WHERE id = ".$_GET['delete']."";
	$result = mysql_query($sql);
	
	$sql2 = "DELETE FROM " .$section_table." WHERE id_followup_task = ".$_GET['delete']."";
	$result2 = mysql_query($sql2);
}

if(isset($_GET['modify']))
{
	$sql = "SELECT * FROM ".$task_table." WHERE 1";
	$result = mysql_query($sql);
	$data = mysql_fetch_array($result);
	
	echo '
	<FORM method="post" action="tasks.php">
	Creation d\'une tâche :
	<TABLE BORDER=0>
	
	<TR>
		<TD>Titre</TD>
		<TD>
		<INPUT type=text name="title" value='.$data['title'].'>
		</TD>
	</TR>
	
	<TR>
		<TD>Description</TD>
		<TD>
		<TEXTAREA rows="5" name="desc">'.$data['desc'].'</TEXTAREA>
		</TD>
	</TR>
	
	<TR>
		<TD>Lien</TD>
		<TD>
		<INPUT type=text name="link" value="'.$data['lien'].'">
		</TD>
	</TR>
	
	<TR>
		<TD>Date de d&eacute;but</TD>
		<TD>
		<SELECT name="day_debut">';
		
		for($i=1;$i < 32;$i++)
		{
			if($i < 10)
			{
				if($i == substr  ( $data['date_debut']  , -2))
					echo '<OPTION selected VALUE="0'.$i.'">0'.$i.'</OPTION>';
				else
					echo '<OPTION VALUE="0'.$i.'">0'.$i.'</OPTION>';
			}
			else
			{
				if($i == substr  ( $data['date_debut']  , -2))
					echo '<OPTION selected VALUE="'.$i.'">'.$i.'</OPTION>';
				else
					echo '<OPTION VALUE="'.$i.'">'.$i.'</OPTION>';
			}
		}
		
		echo'
		</SELECT>
		<SELECT name="month_debut">';
		$sub = substr($date_debut, -5,2);
		if($sub == 01)
			echo '<OPTION selected VALUE="01">january</OPTION>';
		else
			echo '<OPTION VALUE="01">january</OPTION>';
			
		if($sub == 02)
			echo '<OPTION selected VALUE="02">february</OPTION>';
		else	
			echo '<OPTION VALUE="02">february</OPTION>';
			
		echo '<OPTION VALUE="03">march</OPTION>
			<OPTION VALUE="04">april</OPTION>
			<OPTION VALUE="05">may</OPTION>
			<OPTION VALUE="06">june</OPTION>
			<OPTION VALUE="07">july</OPTION>
			<OPTION VALUE="08">august</OPTION>
			<OPTION VALUE="09">september</OPTION>
			<OPTION VALUE="10">october</OPTION>
			<OPTION VALUE="11">november</OPTION>
			<OPTION VALUE="12">december</OPTION>
		</SELECT>
		<SELECT name="year_debut">';
		for($i=2009;$i < 2025;$i++)
		{
			if($i == substr  ( $data['date_debut']  , 4))
				echo '<OPTION selected VALUE="'.$i.'">'.$i.'</OPTION>';
			else
				echo '<OPTION VALUE="'.$i.'">'.$i.'</OPTION>';
		}
		
		echo '</SELECT>
		</TD>
	</TR>
	
	<TR>
		<TD>Date de fin</TD>
		<TD>
		<SELECT name="day_end">';
		
		for($i=1;$i < 32;$i++)
		{
			if($i < 10)
			{
				if($i == substr  ( $data['date_fin']  , -2))
					echo '<OPTION selected VALUE="0'.$i.'">0'.$i.'</OPTION>';
				else
					echo '<OPTION VALUE="0'.$i.'">0'.$i.'</OPTION>';
			}
			else
			{
				if($i == substr  ( $data['date_fin']  , -2))
					echo '<OPTION selected VALUE="'.$i.'">'.$i.'</OPTION>';
				else
					echo '<OPTION VALUE="'.$i.'">'.$i.'</OPTION>';
			}
		}
		
		echo '
		</SELECT>
		<SELECT name="month_end">
			<OPTION VALUE="01">january</OPTION>
			<OPTION VALUE="02">february</OPTION>
			<OPTION VALUE="03">march</OPTION>
			<OPTION VALUE="04">april</OPTION>
			<OPTION VALUE="05">may</OPTION>
			<OPTION VALUE="06">june</OPTION>
			<OPTION VALUE="07">july</OPTION>
			<OPTION VALUE="08">august</OPTION>
			<OPTION VALUE="09">september</OPTION>
			<OPTION VALUE="10">october</OPTION>
			<OPTION VALUE="11">november</OPTION>
			<OPTION VALUE="12">december</OPTION>
		</SELECT>
		<SELECT name="year_end">';
		
		for($i=2009;$i < 2025;$i++)
		{
			if($i == substr  ( $data['date_debut']  , 4))
				echo '<OPTION selected VALUE="'.$i.'">'.$i.'</OPTION>';
			else
				echo '<OPTION VALUE="'.$i.'">'.$i.'</OPTION>';
		}
		
		echo '</SELECT>
		</TD>
	</TR>
	
	<TR>
		<TD>Fonction</TD>
		<TD>
		<SELECT name="dest">
			<OPTION VALUE="prof">Enseignant</OPTION>
			<OPTION VALUE="etudiant">Etudiant</OPTION>
		</SELECT>
		</TD>
	</TR>
	
	<TR>
		<TD COLSPAN=2>
		<INPUT type="submit" value="Envoyer">
		</TD>
	</TR>
	</TABLE>
	</FORM>';
	
}

if(isset($_POST['dest']))
{
	$submit = $_POST['submit'];
	$title = $_POST['title'];
	$desc = $_POST['desc'];	
	$link = $_POST['link'];	
	$day_debut = $_POST['day_debut'];	
	$month_debut = $_POST['month_debut'];	
	$year_debut = $_POST['year_debut'];
	$day_end = $_POST['day_end'];
	$month_end = $_POST['month_end'];
	$year_end = $_POST['year_end'];
	$dest = $_POST['dest'];
	$date_debut = $year_debut."-".$month_debut."-".$day_debut;
	$date_end = $year_end."-".$month_end."-".$day_end;
	/*echo substr($date_debut, -5,2);
	echo substr($date_end, -5,2);*/
	
	for($i=1;$i < 11;$i++)
	{
		$section[$i] = $_POST['section_'.$i.''];
	}
	
	echo $section[3];
	
	$sql = "INSERT INTO " .$task_table." (
	`title`,
	`desc` ,
	`lien` ,
	`date_debut` ,
	`date_fin` ,
	`destinataire`
	)
	VALUES (
	'".$title."', '".$desc."', '".$link."', '".$date_debut."', '".$date_end."', '".$dest."'
	)";
	$result = mysql_query($sql);
	
	$sql_select = "SELECT id FROM" .$task_table. "WHERE title = '".$title."'";
	$result_select = mysql_query($sql_select);
	
	while ($select= mysql_fetch_array($result_select)){
		$id_followup_task = $select['id'];
	}
	
	echo $id_followup_task;
	
	for($j=1;$j < 11;$j++)
	{
		$sql2 = "INSERT INTO " .$section_table." (
		`id_followup_task` ,
		`section_title` ,
		`section_order` 
		)
		VALUES ('".$id_followup_task."', '".$section[$j]."', '".$j."')";
		echo $sql2;
		$result = mysql_query($sql2);
	}
}



echo '<a href="tasks.php?'.api_get_cidreq().'&create=1">'.get_lang('TaskCreate').'</a>&nbsp;<br/>';

$sql = "SELECT * FROM ".$task_table." WHERE 1";
$result = mysql_query($sql);

echo '<br/><br/><br/><div style="width:300; height:180; overflow:auto; border:0;">
   <table width="90%" cellpadding="0" cellspacing="0" rules="none">
   <tr height="40" valign="middle">
   <td>Titre</td>
   <td>Description</td>
   <td>Lien</td>
   <td>Date de début</td>
   <td>Date de fin</td>
   <td>Destinataire</td>
   <td>Modifier</td>';
   
while ($data = mysql_fetch_array($result)){
	 echo '<tr height="40" valign="middle">
	 	   <td>'.$data['title'].'</td>
		   <td>'.$data['desc'].'</td>
		   <td>'.$data['lien'].'</td>
		   <td>'.$data['date_debut'].'</td>
		   <td>'.$data['date_fin'].'</td>
		   <td>'.$data['destinataire'].'</td>
		   <td><a href="tasks.php?cidReq='.api_get_course_id().
				'&modify='.$data['id'].'"><img src="../img/edit.gif" alt="'.get_lang('TaskModify').'"></a>
				<a href="tasks.php?cidReq='.api_get_course_id().
				'&delete='.$data['id'].'" title="'.get_lang('TaskDelete').'"  ><img src="'.api_get_path(WEB_IMG_PATH).'delete.gif" alt="'.get_lang('DirDelete').'"></a></td>
		   </tr>';
}

echo ' </table>
</div>';

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