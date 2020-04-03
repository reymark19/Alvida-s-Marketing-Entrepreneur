
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title"><?php echo @$_SESSION['MenuName']; ?></span>
          <div class="mdl-layout-spacer"></div>
          <a href="<?php echo base_url() ?>Auth/Logout" class="mdl-button mdl-js-button" style="color: #70787c; text-decoration: none;">Logout</a>
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--grey-300 mdl-color-text--black-100">
        <header class="demo-drawer-header">
          <img src="<?php echo base_url() ?>images/user.jpg" class="demo-avatar">
          <div class="demo-avatar-dropdown">
            <span style="text-indent: 5px"><?php echo @$_SESSION['Fullname']; ?></span>
          </div>
          <!-- <div class="mdl-layout-spacer"></div> -->
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--grey-100">
          <a class="mdl-navigation__link" href="<?php echo base_url() ?>Dashboard"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">widgets</i>Dashboard</a>
          <a class="mdl-navigation__link menu-sub-header unhover" href="#!">Members</a>
          <a class="mdl-navigation__link" href="<?php echo base_url() ?>Code"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">how_to_reg</i>Codes</a>
          <a class="mdl-navigation__link" href="<?php echo base_url() ?>RequestOrder"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">speaker_notes</i>Request Order</a>
          <a class="mdl-navigation__link" href="<?php echo base_url() ?>Payout"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">list_alt</i>Request Payout</a>
          <a class="mdl-navigation__link menu-sub-header unhover" href="#!">Reports</a>
          <a class="mdl-navigation__link" href="<?php echo base_url() ?>Expenses"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">assessment</i>Expenses</a>
          <a class="mdl-navigation__link" href="<?php echo base_url() ?>ProductSummary"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">list</i>Product Summary</a>
          <a class="mdl-navigation__link" href="<?php echo base_url() ?>CommissionSummary"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">assignment</i>Commission Summary</a>
          <a class="mdl-navigation__link menu-sub-header unhover" href="#!">Products</a>
          <a class="mdl-navigation__link" href="<?php echo base_url() ?>Products"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">shop</i>Products</a>
          <a class="mdl-navigation__link" href="<?php echo base_url() ?>Supply"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">local_shipping</i>Supply</a>
          <a class="mdl-navigation__link menu-sub-header unhover" href="#!">System</a>
          <a class="mdl-navigation__link" href="<?php echo base_url() ?>Package"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">work</i>Packages</a>
          <a class="mdl-navigation__link" href="<?php echo base_url() ?>ProfitShare"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">near_me</i>Profit Share</a>
          <a class="mdl-navigation__link" href="<?php echo base_url() ?>User"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">supervised_user_circle</i>Users</a>
        </nav>
      </div>