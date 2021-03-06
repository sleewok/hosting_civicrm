<?php

/**
 * Implementation of hook_post_provision_migrate
 */
function drush_provision_civicrm_post_provision_migrate($url = NULL) {
  if (_provision_civicrm_is_site_context(TRUE)) {
    // important for saving the cron/sitekey info, c.f. d.o#1282200
    $civi_opts = _provision_civicrm_drush_options('post migrate');
    $civi_opts['strict'] = FALSE;
    $target = drush_get_option('target_name');

    provision_backend_invoke($target, 'provision-verify', array(), $civi_opts);
  }
}
