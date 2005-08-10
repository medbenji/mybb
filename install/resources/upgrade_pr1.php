<?php
/**
 * MyBB 1.0
 * Copyright � 2005 MyBulletinBoard Group, All Rights Reserved
 *
 * Website: http://www.mybboard.com
 * License: http://www.mybboard.com/eula.html
 *
 * $$
 */

/**
 * Upgrade Script: PR1 (Released to Testers) to Latest PR1
 */

function upgrade3_dbchanges()
{
	global $db, $output;

	$output->print_header("Update Process");
	echo "Modifying database...";
	$db->query("UPDATE mybb_users SET salt='';");
	$db->query("INSERT INTO mybb_settings (sid, name, title, description, optionscode, value, disporder, gid) VALUES (113, 'decpoint', 'Decimal Point', 'The decimal point you use in your region.', 'text', '.', 1, 1);");
	$db->query("INSERT INTO mybb_settings (sid, name, title, description, optionscode, value, disporder, gid) VALUES (114, 'thousandssep', 'Thousands Numeric Separator', 'The punctuation you want to use .  (for example, the setting \',\' with the number 1200 will give you a number such as 1,200)', 'text', ',', 1, 1);");
	$db->query("INSERT INTO mybb_settings (sid, name, title, description, optionscode, value, disporder, gid) VALUES (115, 'showvernum', 'Show Version Numbers', 'Allows you to turn off the public display of version numbers in MyBB.', 'onoff', 'off', 1, 1);");

	$db->query("ALTER TABLE mybb_users ADD loginkey varchar(50) NOT NULL AFTER salt;");
	$db->query("ALTER TABLE mybb_threads ADD firstpost int unsigned NOT NULL default '0' AFTER dateline;");
	$db->query("DROP TABLE mybb_online;");
	$db->query("CREATE TABLE mybb_sessions (
		  sid varchar(32) NOT NULL default '',
		  uid int unsigned NOT NULL default '0',
		  ip varchar(40) NOT NULL default '',
		  time bigint(30) NOT NULL default '0',
		  location varchar(150) NOT NULL default '',
		  useragent varchar(100) NOT NULL default '',
		  anonymous int(1) NOT NULL default '0',
		  nopermission int(1) NOT NULL default '0',
		  location1 int(10) NOT NULL default '0',
		  location2 int(10) NOT NULL default '0',
		  PRIMARY KEY(sid),
		  KEY location1 (location1),
		  KEY location2 (location2)
		);");
	$db->query("CREATE TABLE mybb_datacache (
	  title varchar(15) NOT NULL default '',
	  cache mediumtext NOT NULL,
	  PRIMARY KEY(title)
	) TYPE=MyISAM;");

	echo "Done. Click Next.";
	$output->print_footer("3_dbchanges2");
}

function upgrade3_dbchanges2()
{
	global $db, $output;

	$output->print_header("More Database Modifications");
	echo "Be patient, this page could take a while to complete depending on the size of your forums...";

$db->query("ALTER TABLE mybb_adminlog CHANGE uid uid int unsigned NOT NULL;");
	
$db->query("ALTER TABLE mybb_adminoptions CHANGE uid uid int(10) NOT NULL;");

$db->query("ALTER TABLE mybb_announcements CHANGE aid aid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_announcements CHANGE fid fid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_announcements CHANGE uid uid int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_attachments CHANGE aid aid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_attachments CHANGE uid uid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_attachments CHANGE visible visible int(1) NOT NULL;");
$db->query("ALTER TABLE mybb_attachments CHANGE downloads downloads int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_attachtypes CHANGE atid atid int unsigned NOT NULL auto_increment;");

$db->query("ALTER TABLE mybb_awaitingactivation CHANGE aid aid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_awaitingactivation CHANGE uid uid int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_badwords CHANGE bid bid int unsigned NOT NULL auto_increment;");

$db->query("ALTER TABLE mybb_banned CHANGE uid uid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_banned CHANGE gid gid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_banned CHANGE oldgroup oldgroup int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_banned CHANGE admin admin int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_events CHANGE eid eid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_events CHANGE author author int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_favorites CHANGE fid fid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_favorites CHANGE uid uid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_favorites CHANGE tid tid int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_forumpermissions CHANGE pid pid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_forumpermissions CHANGE fid fid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_forumpermissions CHANGE gid gid int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_forums CHANGE fid fid smallint unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_forums CHANGE pid pid smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_forums CHANGE disporder disporder smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_forums CHANGE threads threads int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_forums CHANGE posts posts int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_forums CHANGE style style smallint unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_forumsubscriptions CHANGE fsid fsid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_forumsubscriptions CHANGE fid fid smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_forumsubscriptions CHANGE uid uid int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_groupleaders CHANGE lid lid smallint unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_groupleaders CHANGE gid gid smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_groupleaders CHANGE uid uid int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_helpdocs CHANGE hid hid smallint unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_helpdocs CHANGE sid sid smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_helpdocs CHANGE disporder disporder smallint unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_helpsections CHANGE sid sid smallint unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_helpsections CHANGE disporder disporder smallint unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_icons CHANGE iid iid smallint unsigned NOT NULL auto_increment;");

$db->query("ALTER TABLE mybb_joinrequests CHANGE rid rid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_joinrequests CHANGE uid uid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_joinrequests CHANGE gid gid smallint unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_moderatorlog CHANGE uid uid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_moderatorlog CHANGE fid fid smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_moderatorlog CHANGE tid tid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_moderatorlog CHANGE pid pid int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_moderators CHANGE mid mid smallint unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_moderators CHANGE fid fid smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_moderators CHANGE uid uid int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_polls CHANGE pid pid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_polls CHANGE tid tid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_polls CHANGE numoptions numoptions smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_polls CHANGE numvotes numvotes smallint unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_pollvotes CHANGE vid vid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_pollvotes CHANGE pid pid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_pollvotes CHANGE uid uid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_pollvotes CHANGE voteoption voteoption smallint unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_posts CHANGE pid pid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_posts CHANGE tid tid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_posts CHANGE replyto replyto int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_posts CHANGE fid fid smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_posts CHANGE icon icon smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_posts CHANGE uid uid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_posts CHANGE edituid edituid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_posts CHANGE visible visible int(1) NOT NULL;");

$db->query("ALTER TABLE mybb_privatemessages CHANGE pmid pmid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_privatemessages CHANGE uid uid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_privatemessages CHANGE toid toid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_privatemessages CHANGE fromid fromid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_privatemessages CHANGE folder folder smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_privatemessages CHANGE icon icon smallint unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_profilefields CHANGE fid fid smallint unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_profilefields CHANGE disporder disporder smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_profilefields CHANGE length length smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_profilefields CHANGE maxlength maxlength smallint unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_reportedposts CHANGE rid rid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_reportedposts CHANGE pid pid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_reportedposts CHANGE tid tid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_reportedposts CHANGE fid fid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_reportedposts CHANGE uid uid int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_reputation CHANGE uid uid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_reputation CHANGE pid pid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_reputation CHANGE adduid adduid int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_searchlog CHANGE sid sid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_searchlog CHANGE uid uid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_searchlog CHANGE limitto limitto smallint(4) NOT NULL;");

$db->query("ALTER TABLE mybb_settinggroups CHANGE gid gid smallint unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_settinggroups CHANGE disporder disporder smallint unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_settings CHANGE sid sid smallint unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_settings CHANGE disporder disporder smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_settings CHANGE gid gid smallint unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_smilies CHANGE sid sid smallint unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_smilies CHANGE disporder disporder smallint unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_templates CHANGE tid tid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_templates CHANGE sid sid int(10) NOT NULL;");

$db->query("ALTER TABLE mybb_templatesets CHANGE sid sid smallint unsigned NOT NULL auto_increment;");

$db->query("ALTER TABLE mybb_themes CHANGE tid tid smallint unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_themes CHANGE pid pid smallint unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_threadratings CHANGE rid rid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_threadratings CHANGE tid tid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_threadratings CHANGE uid uid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_threadratings CHANGE rating rating smallint unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_threads CHANGE tid tid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_threads CHANGE fid fid smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_threads CHANGE icon icon smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_threads CHANGE poll poll int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_threads CHANGE uid uid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_threads CHANGE replies replies int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_threads CHANGE views views int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_threads CHANGE sticky sticky int(1) NOT NULL;");
$db->query("ALTER TABLE mybb_threads CHANGE numratings numratings smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_threads CHANGE totalratings totalratings smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_threads CHANGE visible visible int(1) NOT NULL;");

$db->query("ALTER TABLE mybb_threadsread CHANGE tid tid int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_threadsread CHANGE uid uid int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_userfields CHANGE ufid ufid int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_usergroups CHANGE gid gid smallint unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_usergroups CHANGE stars stars smallint(4) NOT NULL;");

$db->query("ALTER TABLE mybb_users CHANGE uid uid int unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_users CHANGE usergroup usergroup smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_users CHANGE displaygroup displaygroup smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_users CHANGE style style smallint unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_users CHANGE referrer referrer int unsigned NOT NULL;");

$db->query("ALTER TABLE mybb_usertitles CHANGE utid utid smallint unsigned NOT NULL auto_increment;");
$db->query("ALTER TABLE mybb_usertitles CHANGE posts posts int unsigned NOT NULL;");
$db->query("ALTER TABLE mybb_usertitles CHANGE stars stars smallint(4) NOT NULL;");

	echo "Done";
	echo "<br /><br />Click Next.";
	echo "<p><font color=\red\"><b>WARNING:</font> The next step will delete any custom themes or templates you have! Please back them up before continuing!</p>";
	$output->print_footer("templates");
}


?>