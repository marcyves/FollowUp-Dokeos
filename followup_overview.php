<?php
/*
===============================================================================
	Dokeos - elearning and course management software

	Copyright (c) 2004 Dokeos S.A.
	Copyright (c) 2003 Ghent University (UGent)
	Copyright (c) 2001 Universite catholique de Louvain (UCL)
	Copyright (c) Roan Embrechts (Vrije Universiteit Brussel)
	Copyright (c) Bart Mollet

	For a full list of contributors, see "credits.txt".
	The full license can be read in "license.txt".

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	See the GNU General Public License for more details.

	Contact: Dokeos, 181 rue Royale, B-1000 Brussels, Belgium, info@dokeos.com
===============================================================================
*/
/**
============================================================================== 
*	Main page for the group module.
*	This script displays the general group settings, 
*	and a list of groups with buttons to view, edit...
*	
*	@author Thomas Depraetere, Hugues Peeters, Christophe Gesche: initial versions
*	@author Bert Vanderkimpen, improved self-unsubscribe for cvs
*	@author Patrick Cool, show group comment under the group name
*	@author Roan Embrechts, initial self-unsubscribe code, code cleaning, virtual course support
*	@author Bart Mollet, code cleaning, use of Display-library, list of courseAdmin-tools, use of GroupManager
*	@package dokeos.group
============================================================================== 
*/
/*
============================================================================== 
		INIT SECTION
============================================================================== 
*/
// name of the language file that needs to be included 
$language_file = "group";
include ('../inc/global.inc.php');
$this_section=SECTION_COURSES;

$nameTools = get_lang("GroupOverview");

/*
-----------------------------------------------------------
	Libraries
-----------------------------------------------------------
*/
include_once (api_get_path(LIBRARY_PATH).'course.lib.php'); //necessary
include_once (api_get_path(LIBRARY_PATH).'groupmanager.lib.php');
include_once (api_get_path(LIBRARY_PATH).'export.lib.inc.php');
include_once (api_get_path(LIBRARY_PATH).'events.lib.inc.php'); //necessary for statistics

if( isset($_GET['action']))
{
	switch($_GET['action'])
	{
		case 'export':
			$groups = GroupManager::get_group_list();
			$data = array();
			foreach($groups as $index => $group)
			{
				$users = GroupManager::get_users($group['id']);
				foreach($users as $index => $user)
				{
					$row = array();
					$user = api_get_user_info($user);
					$row[] = $group['name'];
					$row[] = $user['official_code'];
					$row[] = $user['lastName'];
					$row[] = $user['firstName'];
					$data[] = $row;
				}	
			}
			switch($_GET['type'])
			{
				case 'csv':
					Export::export_table_csv($data);
				case 'xls':
					Export::export_table_xls($data);	
			}	
			break;
	}	
}

/*
-----------------------------------------------------------
	Header
-----------------------------------------------------------
*/
$interbreadcrumb[]=array("url" => "followup.php","name" => get_lang('GroupManagement'));
if (!isset ($_GET['origin']) || $_GET['origin'] != 'learnpath')
{ //so we are not in learnpath tool
	if (! $is_allowed_in_course) api_not_allowed(true);
	else Display::display_header($nameTools,"Group");
}
else
{
?> <link rel="stylesheet" type="text/css" href="<?php echo api_get_path(WEB_CODE_PATH); ?>css/default.css" /> <?php
}
echo '<a href="group_overview.php?'.api_get_cidreq().'&action=export&type=csv">'.get_lang('ExportAsCSV').'</a>';
echo ' | <a href="group_overview.php?'.api_get_cidreq().'&action=export&type=xls">'.get_lang('ExportAsXLS').'</a>';
$categories = GroupManager::get_categories();
foreach($categories as $index => $category)
{
	if( api_get_setting('allow_group_categories') == 'true')
	{
		echo '<h3>'.$category['title'].'</h3>';
	}	
	$groups = GroupManager::get_group_list($category['id']);
	echo '<ul>';
	foreach($groups as $index => $group)
	{
		echo '<li>';
		echo stripslashes($group['name']);
		echo '<ul>';
		$users = GroupManager::get_users($group['id']);
		foreach($users as $index => $user)
		{
			$user_info = api_get_user_info($user);
			echo '<li>'.$user_info['firstName'].' '.$user_info['lastName'].'</li>';
		}
		echo '</ul>';
		echo '</li>';	
	}
	echo '</ul>';
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