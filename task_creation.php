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

echo '
<FORM method="post" action="tasks.php">
Creation d\'une tâche :
<TABLE BORDER=0>
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
	<SELECT name="day_debut">
		<OPTION VALUE="01">01</OPTION>
		<OPTION VALUE="02">02</OPTION>
		<OPTION VALUE="03">03</OPTION>
		<OPTION VALUE="04">04</OPTION>
		<OPTION VALUE="05">05</OPTION>
		<OPTION VALUE="06">06</OPTION>
		<OPTION VALUE="07">07</OPTION>
		<OPTION VALUE="08">08</OPTION>
		<OPTION VALUE="09">09</OPTION>
		<OPTION VALUE="10">10</OPTION>
		<OPTION VALUE="11">11</OPTION>
		<OPTION VALUE="12">12</OPTION>
		<OPTION VALUE="13">13</OPTION>
		<OPTION VALUE="14">14</OPTION>
		<OPTION VALUE="15">15</OPTION>
		<OPTION VALUE="16">16</OPTION>
		<OPTION VALUE="17">17</OPTION>
		<OPTION VALUE="18">18</OPTION>
		<OPTION VALUE="19">19</OPTION>
		<OPTION VALUE="20">20</OPTION>
		<OPTION VALUE="21">21</OPTION>
		<OPTION VALUE="22">22</OPTION>
		<OPTION VALUE="23">23</OPTION>
		<OPTION VALUE="24">24</OPTION>
		<OPTION VALUE="25">25</OPTION>
		<OPTION VALUE="26">26</OPTION>
		<OPTION VALUE="27">27</OPTION>
		<OPTION VALUE="28">28</OPTION>
		<OPTION VALUE="29">29</OPTION>
		<OPTION VALUE="30">30</OPTION>
		<OPTION VALUE="31">31</OPTION>
	</SELECT>
	<SELECT name="month_debut">
		<OPTION VALUE="january">january</OPTION>
		<OPTION VALUE="february">february</OPTION>
		<OPTION VALUE="march">march</OPTION>
		<OPTION VALUE="april">april</OPTION>
		<OPTION VALUE="may">may</OPTION>
		<OPTION VALUE="june">june</OPTION>
		<OPTION VALUE="july">july</OPTION>
		<OPTION VALUE="august">august</OPTION>
		<OPTION VALUE="september">september</OPTION>
		<OPTION VALUE="october">october</OPTION>
		<OPTION VALUE="november">november</OPTION>
		<OPTION VALUE="december">december</OPTION>
	</SELECT>
	<SELECT name="year_debut">
		<OPTION VALUE="2009">2009</OPTION>
		<OPTION VALUE="2010">2010</OPTION>
		<OPTION VALUE="2011">2011</OPTION>
	</SELECT>
	</TD>
</TR>

<TR>
	<TD>Date de fin</TD>
	<TD>
	<SELECT name="day_end">
		<OPTION VALUE="01">01</OPTION>
		<OPTION VALUE="02">02</OPTION>
		<OPTION VALUE="03">03</OPTION>
		<OPTION VALUE="04">04</OPTION>
		<OPTION VALUE="05">05</OPTION>
		<OPTION VALUE="06">06</OPTION>
		<OPTION VALUE="07">07</OPTION>
		<OPTION VALUE="08">08</OPTION>
		<OPTION VALUE="09">09</OPTION>
		<OPTION VALUE="10">10</OPTION>
		<OPTION VALUE="11">11</OPTION>
		<OPTION VALUE="12">12</OPTION>
		<OPTION VALUE="13">13</OPTION>
		<OPTION VALUE="14">14</OPTION>
		<OPTION VALUE="15">15</OPTION>
		<OPTION VALUE="16">16</OPTION>
		<OPTION VALUE="17">17</OPTION>
		<OPTION VALUE="18">18</OPTION>
		<OPTION VALUE="19">19</OPTION>
		<OPTION VALUE="20">20</OPTION>
		<OPTION VALUE="21">21</OPTION>
		<OPTION VALUE="22">22</OPTION>
		<OPTION VALUE="23">23</OPTION>
		<OPTION VALUE="24">24</OPTION>
		<OPTION VALUE="25">25</OPTION>
		<OPTION VALUE="26">26</OPTION>
		<OPTION VALUE="27">27</OPTION>
		<OPTION VALUE="28">28</OPTION>
		<OPTION VALUE="29">29</OPTION>
		<OPTION VALUE="30">30</OPTION>
		<OPTION VALUE="31">31</OPTION>
	</SELECT>
	<SELECT name="month_end">
		<OPTION VALUE="january">january</OPTION>
		<OPTION VALUE="february">february</OPTION>
		<OPTION VALUE="march">march</OPTION>
		<OPTION VALUE="april">april</OPTION>
		<OPTION VALUE="may">may</OPTION>
		<OPTION VALUE="june">june</OPTION>
		<OPTION VALUE="july">july</OPTION>
		<OPTION VALUE="august">august</OPTION>
		<OPTION VALUE="september">september</OPTION>
		<OPTION VALUE="october">october</OPTION>
		<OPTION VALUE="november">november</OPTION>
		<OPTION VALUE="december">december</OPTION>
	</SELECT>
	<SELECT name="year_end">
		<OPTION VALUE="2009">2009</OPTION>
		<OPTION VALUE="2010">2010</OPTION>
		<OPTION VALUE="2011">2011</OPTION>
	</SELECT>
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

echo $_POST['link'];

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