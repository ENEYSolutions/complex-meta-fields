<div class="wrap">
  <h2><?php _e('Manage Complex Fields', WP_CMF_DOMAIN); ?></h2>
  <form action="" method="POST">

    <section id="cmf-fields-managed" ng-app>

      <div>
        <label>Name:</label>
        <input type="text" ng-model="yourName" placeholder="Enter a name here">
        <hr>
        <h1>Hello {{yourName}}!</h1>
      </div>

    </section>

  </form>
</div>