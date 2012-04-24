CiviCRM support for Aegir
=======================

This Drush module will update the CiviCRM configuration file and database
when installing and migrating sites.

Also see http://wiki.civicrm.org/confluence/display/CRMDOC/Moving+an+Existing+Installation+to+a+New+Server+or+Location

Installation instructions
-------------------------

Drop this directory in Aegir's Drush path (e.g. /var/aegir/.drush).

Create an Aegir platform that has the CiviCRM module in its sites/all
directory (although in recent versions, we try to phase out this requirement
so that we can better support install profiles).

A "drush make" makefile is available in civicrm.make.

Verify the platform once the module has been added.

When creating a new site, provision_civicrm will detect the presence
of CiviCRM in the platform and will install/configure it automatically.

Todo
----

* civicrm upgrades
* use Aegir variables in civicrm.settings.php so that the database
  details are not readable by other users on the server (as is the
  case in settings.php).
* have a clean civicrm.drush.inc
* reduce code redundancy in install.provision.inc
* support for installing civicrm in a different DB?
* configure crons automatically (civimail, civimember)