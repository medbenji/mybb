<?php
/**
 * MyBB 1.2
 * Copyright � 2007 MyBB Group, All Rights Reserved
 *
 * Website: http://www.mybboard.net
 * License: http://www.mybboard.net/license.php
 *
 * $Id$
 */

// Disallow direct access to this file for security reasons
if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

if($mybb->input['action'] == 'phpinfo')
{
	phpinfo();
	exit;
}

$page->add_breadcrumb_item("PHP Info", "index.php?".SID."&amp;module=tools/php_info");

if(!$mybb->input['action'])
{
	$page->output_header("PHP Info");
	
	echo "<iframe src=\"index.php?".SID."&amp;module=tools/php_info&amp;action=phpinfo\" width=\"100%\" height=\"500\" frameborder=\"0\">Your browser does not support iframes</iframe>";
	
	$page->output_footer();
}

?>