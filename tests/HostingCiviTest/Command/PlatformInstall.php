<?php

namespace HostingCiviTest\Command;

class PlatformInstall {

  /**
   * Helper function to install a platform.
   */
  public static function run($platform_name, $platform_alias = NULL) {
    $makes_dir = dirname(__FILE__) . '/../../../drush/provision_civicrm_tests/makes';

    if (is_null($platform_alias)) {
      $platform_alias = $platform_name;
    }

    drush_log(dt('Building platform: @platform and adding to hostmaster.', array('@platform' => $platform_alias)), 'ok');

    $args = array(
      $makes_dir . "/$platform_name.build",
      "/var/aegir/platforms/$platform_alias"
    );

    drush_invoke_process('@none', 'make', $args);

    $args = array(
      "@platform_$platform_alias",
    );

    $options = array(
      'root' => "/var/aegir/platforms/$platform_alias",
      'context_type' => 'platform',
    );

    drush_invoke_process('@none', 'provision-save', $args, $options);

    // FIXME: normally we should use backend_invoke_foo(), but the
    // hostmaster context was not successfully bootstrapped, so the
    // commands aren't found.
    exec('drush @hm hosting-import ' . drush_escapeshellarg("@platform_$platform_alias"));
    exec('drush @hm provision-civicrm-tests-run-pending');
  }
}
