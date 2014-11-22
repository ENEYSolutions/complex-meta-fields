<div class="wrap">
  <h2><?php _e('Fields Constructor', WP_CMF_DOMAIN); ?></h2>
  <hr />
  <form action="" method="POST">

    <!-- ng app -->
    <section id="cmf-fields-managed" ng-app="cmfApp">

      <!-- UI cols -->
      <table width="100%">
        <tr valign="top">
          
          <!-- Left col -->
          <td width="70%" ng-controller="cmfWorkspace">
            <h2><?php _e( 'Workspace' ); ?></h2>
            
            <ul>
              <li ng-repeat="field in fields">
                <h3 ng-click="field.show = !field.show">{{field.name}}</h3>
                <ul ng-show="field.show">
                  <li ng-repeat="option in field.options">{{option.name}}</li>
                </ul>
              </li>
            </ul>
          </td>
          
          <!-- Right col -->
          <td>
            <h2><?php _e( 'Elements' ); ?></h2>
          </td>
        </tr>
      </table>

    </section>

  </form>
</div>