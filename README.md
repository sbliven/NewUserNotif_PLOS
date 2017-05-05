New User Email Notifications (PLOS Customizations)
--------------------------------------------------

This is a MediaWiki extension. It requires the [New User Email
Notifications](https://www.mediawiki.org/wiki/Extension:New_User_Email_Notification)
extension.

This extension makes additional parameters available in the customization page
(MediaWiki:Newusernotifbody):

| Var   | Description                   
| ----- | -----------
| $1    | Recipient's Username
| $2    | Username of the new account
| $3    | Site name
| $4    | Time and date of account creation
| $5    | Email of new account
| $6    | Submitter's IP address
| $7    | Real name of new account
| $8    | URL-encoded username of new account

Compatibility
=============
This extension should be compatible with 'New User Email Notification' version
1.5.2 and later.

Installation
============

Add the NewUserNotif_PLOS directory to your extensions directory. Then add the
following to `LocalSettings.php`:

```
require_once( "{$IP}/extensions/NewUserNotif/NewUserNotif.php" );
require_once( "{$IP}/extensions/NewUserNotif_PLOS/PLOSParams.php" );
```

After this, the email message can be customized by editing the page
`MediaWiki:Newusernotifbody` on the wiki.

Example `MediaWiki:Newusernotifbody`:

```
Hello $1,

A new user account, $2, has been created on $3 at $4.

User name: $2
Real name: $7
Email: $5
IP: $6

If this account looks all right, you can update their user rights with the following link:

  {{fullurl:Special:UserRights}}/$8
```

License and copyright
=====================

The code was originally created by Spencer Bliven, based on the original
NewUserNotif extension.

This is free software licenced under the GNU General Public Licence version 2.0
or later. Please see http://www.gnu.org/copyleft/gpl.html for further details,
including the full text and terms of the license.

