<?php
/**
 * Extension to provide additional parameters to the subject line and message body for NewUserNotif
 *
 * @file
 * @author Spencer Bliven <spencer.bliven@gmail.com>
 * @ingroup Extensions
 * @copyright 2016 Spencer Bliven
 * @url https://github.com/sbliven/NewUserNotif_PLOS
 * @licence GNU General Public Licence 2.0 or later
 */

if (!defined('MEDIAWIKI')) die('Not an entry point.');

$wgExtensionFunctions[] = 'efNewUserNotifSetupExtension';
$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'New User Email Notification - PLOS customizations',
	'author' => array( 'Spencer Bliven' ),
	'version' => '1.0',
	'url' => 'https://www.mediawiki.org/wiki/Extension:NewUserNotif',
);
wfDebug("Loading PLOSParams.php");
/**
 * Set up hooks for Additional NewUserNotif Parameters
 *
*/
function efNewUserNotifSetupExtension() {
	global $wgHooks;
	wfDebug("Adding PLOS customization hooks");
	$wgHooks['NewUserNotifSubject'][] =  'efNewUserNotifSubject';
	$wgHooks['NewUserNotifBody'][] = 'efNewUserNotifBody';
	return true;
}


/**
 * This function creates additional parameters which can be used in the email notification Subject Line for new users
 *
 * @param $callobj NewUserNotifier object (this).
 * @param $subjectLine String: Returns the message subject line
 * @param $siteName Site Name of the Wiki
 * @param $recipient Email/User Name of the Message Recipient.
 * @param $user User name of the added user
 * @return  true
 */

function efNewUserNotifSubject ( &$callobj , &$subjectLine , $siteName , $recipient , $user )
{
	$subjectLine = wfMessage(
				'newusernotifsubj',
				$siteName,										// $1 Site Name
				$user->getName()								// $2 User Name
	)->inContentLanguage()->text();
	return ( true );
}

/**
 * This function creates additional parameters which can be used in the email notification message body for new users
 *
 * @param $callobj NewUserNotifier object (this).
 * @param $messageBody String: Returns the message body.
 * @param $siteName Site Name of the Wiki
 * @param $recipient Email/User Name of the Message Recipient.
 * @param $user User name of the added user
 * @return  true
 */

function efNewUserNotifBody ( &$callobj , &$messageBody , $siteName , $recipient , $user )
{
	global $wgContLang, $wgRequest;
	wfDebug("Generating PLOS user creation email");
	$messageBody = wfMessage(
				'newusernotifbody',
				$recipient, // $1 Recipient (of notification message) 
				$user->getName(), // $2 User Name
				$siteName, // $3 Site Name
				$wgContLang->timeAndDate( wfTimestampNow() ), // $4 Time and date stamp
				$user->getEmail(), // $5 email
				$wgRequest->getIP(), // $6 Submitter's IP Address
				$user->getRealName(), //$7 real name
				rawurlencode($user->getName()) //$8 encoded user name
	)->inContentLanguage()->text();
	wfDebug("Email Body: ".$messageBody);
	return ( true );
}
