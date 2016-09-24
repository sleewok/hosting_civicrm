<?php

namespace HostingCiviTest\Command;

class SiteUtils extends \HostingCiviTest\Command {
  /**
   * Returns the CiviCRM version.
   */
  public static function getCiviVersion($site) {
    $info = self::getCiviSystemInfo($site);

    if (isset($info['civi']['version'])) {
      return $info['civi']['version'];
    }

    throw new \Exception("HostingCiviTest\Command::getCiviVerson: could not find CiviCRM version: " . print_r($info, 1));
  }

  /**
   * Returns the CiviCRM system info.
   */
  public static function getCiviSystemInfo($site) {
    $site .= '.aegir.example.com';

    // Flush the drush cache to avoid 'civicrm must be enable' error.
    self::exec('drush @' . escapeshellcmd($site) . ' cc drush');

    // Run System.get API
    $output = self::exec('drush @' . escapeshellcmd($site) . ' cvapi System.get --out=json', [], TRUE);
    $info = json_decode($output, TRUE);

    return $info['values'][0];
  }

}