<div class="wrap">
  <h2><?php _e( 'Plugin Settings' ); ?></h2>
  <form action="options.php" method="POST">
    <?php settings_fields('cmf-settings'); ?>
    <?php do_settings_sections('cmf-settings-general'); ?>
    <?php submit_button(); ?>
  </form>
</div>