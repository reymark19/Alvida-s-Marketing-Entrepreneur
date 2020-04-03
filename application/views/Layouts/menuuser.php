
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--blue-600 mdl-color-text--blue-grey-50">
        <div class="mdl-layout__header-row">
          
          <div class="mdl-layout-spacer"></div>
          
          <span style="text-indent: 5px"><?php echo @$_SESSION['Fullname']; ?></span>

          <?php if ($Account['ReferredById'] == null && $Accounts != false): ?>
            <button id="btnSetReferral" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color-text--blue-grey-50" style="margin-left: 10px;margin-right: 5px;">
              Referred By
            </button>
            <div class="mdl-tooltip" data-mdl-for="btnSetReferral">
              Note: Please Contact the Person who referred you for the Account Name.
            </div>
          <?php endif ?>


          <div class="position-relative">
            <img src="<?php echo $_SESSION['Picture'] ?>" class="account-icon">
          </div>

          <button id="demo-menu-lower-right"
                  class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons">more_vert</i>
          </button>
          
          <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
              for="demo-menu-lower-right">
            <?php if ($Accounts != false): ?>
              <?php foreach ($Accounts as $account): ?>
               <li class="mdl-menu__item"><a href="<?php echo base_url() ?>Users/SwitchAccount/<?php echo @$account['AccountName'] ?>" style="color: #000; text-decoration: none;"><?php echo @$account['AccountName'] ?></a></li>
              <?php endforeach ?>
            <?php endif ?>
            

            <?php if ($AccountsCount <= 15): ?>
              <li class="mdl-menu__item"><a href="#!" style="color: #000; text-decoration: none;" class="btnAddAccount">Add Account</a></li>
            <?php endif ?>
            <li class="mdl-menu__item">
              <a href="#" style="color: #000; text-decoration: none;" onclick="signOut();">Sign out</a>

            </li>
          </ul>
          
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color-text--black-100">
        <header class="demo-drawer-header">
          <img src="<?php echo base_url() ?>images/logo.jpg" class="menu-logo">
          
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--grey-100">
          
          <?php if ($IsUserAccountVerified == true): ?>
            <a class="mdl-navigation__link" href="<?php echo base_url() ?>Users/Dashboard/<?php echo @$_SESSION['AccountName'] ?>"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">widgets</i>Dashboard</a>

            <a class="mdl-navigation__link menu-sub-header unhover" href="#!">Team</a>
            <a class="mdl-navigation__link" href="<?php echo base_url() ?>Binary/Network/<?php echo 
            @$_SESSION['AccountName'] ?>">
            <?php if ($newmembertobeassigncnt > 0): ?>
              <i class="mdl-color-text--blue-grey-900 material-icons mdl-badge mdl-badge--overlap" data-badge="<?php echo $newmembertobeassigncnt ?>" role="presentation">supervised_user_circle</i>
            <?php else: ?>
              <i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">supervised_user_circle</i>
            <?php endif ?>
            Binary</a>

            <a class="mdl-navigation__link menu-sub-header unhover" href="#!">Encashment</a>
            <a class="mdl-navigation__link" href="<?php echo base_url() ?>Encashment/<?php echo $_SESSION['AccountName'] ?>"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">speaker_notes</i>Request Order</a>
            <a class="mdl-navigation__link" href="<?php echo base_url() ?>IncomeHistor/<?php echo $_SESSION['AccountName'] ?>y"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">list_alt</i>Income History</a>
            <a class="mdl-navigation__link" href="<?php echo base_url() ?>GiftCertificate/<?php echo $_SESSION['AccountName'] ?>"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">list_alt</i>Gift Certificate</a>
            <a class="mdl-navigation__link" href="<?php echo base_url() ?>Voucher/<?php echo $_SESSION['AccountName'] ?>"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">list_alt</i>Voucher</a>

            <a class="mdl-navigation__link menu-sub-header unhover" href="#!">Store</a>
            <a class="mdl-navigation__link" href="<?php echo base_url() ?>Products/Users/<?php echo $_SESSION['AccountName'] ?>"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">shopping_cart</i>Products</a>
            <a class="mdl-navigation__link" href="<?php echo base_url() ?>PurchaseSummary/<?php echo $_SESSION['AccountName'] ?>"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">list</i>Purchase Summary</a>

            <a class="mdl-navigation__link menu-sub-header unhover" href="#!">Code</a>
            <a class="mdl-navigation__link" href="<?php echo base_url() ?>Code/CodeVault/<?php echo $_SESSION['AccountName'] ?>"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">how_to_reg</i>Code Vault</a>
          <?php else: ?>
            <a class="mdl-navigation__link btnAddAccount" href="#!"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">widgets</i>Dashboard</a>

            <a class="mdl-navigation__link menu-sub-header unhover" href="#!">Team</a>
            <a class="mdl-navigation__link btnAddAccount" href="#!"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">supervised_user_circle</i>Binary</a>

            <a class="mdl-navigation__link menu-sub-header unhover" href="#!">Encashment</a>
            <a class="mdl-navigation__link btnAddAccount" href="#!"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">speaker_notes</i>Request Order</a>
            <a class="mdl-navigation__link btnAddAccount" href="#!"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">list_alt</i>Income History</a>
            <a class="mdl-navigation__link btnAddAccount" href="#!"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">list_alt</i>Gift Certificate</a>
            <a class="mdl-navigation__link btnAddAccount" href="#!"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">list_alt</i>Voucher</a>

            <a class="mdl-navigation__link menu-sub-header unhover" href="#!">Store</a>
            <a class="mdl-navigation__link btnAddAccount" href="#!"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">shopping_cart</i>Products</a>
            <a class="mdl-navigation__link btnAddAccount" href="#!"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">list</i>Purchase Summary</a>

            <a class="mdl-navigation__link menu-sub-header unhover" href="#!">Code</a>
            <a class="mdl-navigation__link btnAddAccount" href="#!"><i class="mdl-color-text--blue-grey-900 material-icons" role="presentation">how_to_reg</i>Code Vault</a>
          <?php endif ?>

        </nav>
      </div>
      <dialog class="mdl-dialog dialog-add-account">
        <h4 class="mdl-dialog__title modal-title">Add Account</h4>
          <div class="mdl-dialog__content">
            <form action="<?php echo base_url() ?>Account/insert" id="accountForm">
              <input type="text" name="token" id="token" class="hide" value="<?php echo $_SESSION['token'] ?>">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="code" name="code" required="" style="text-transform: uppercase;">
                <label class="mdl-textfield__label" for="code">Code</label>
              </div>
            </form>
          </div>
          <div class="mdl-dialog__actions">
            <button type="button" class="mdl-button close">Cancel</button>
            <button type="button" class="mdl-button" id="btnSaveAccount">Add</button>
          </div>
        </dialog>
        <dialog class="mdl-dialog ReferredByDialog" id="">

        <h4 class="mdl-dialog__title modal-title">Refferal</h4>
          <div class="mdl-dialog__content">
            <form action="<?php echo base_url() ?>Account/setReferral" id="referralForm">
              <input type="text" name="token" id="token" class="hide" value="<?php echo $_SESSION['token'] ?>">
              <input type="text" name="id" class="hide" value="<?php echo $Account['AccountId'] ?>">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="accountname" name="accountname" required="">
                <label class="mdl-textfield__label" for="accountname">Account Name</label>
              </div>
            </form>
          </div>
          <div class="mdl-dialog__actions">
            <button type="button" class="mdl-button close">Cancel</button>
            <button type="button" class="mdl-button" id="btnSaveReferral">Save</button>
          </div>
        </dialog>

<script>
    function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
        console.log(auth2);
      auth2.signOut().then(function () {
        console.log(auth2);
        console.log('User signed out.');
        //window.location = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=<?php echo base_url() ?>Auth/Logout";
        window.location = "<?php echo base_url() ?>Auth/Logout";
      });
    }

    function onLoad() {
      gapi.load('auth2', function() {
        gapi.auth2.init();
      });
    }
  </script>
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
      <script>

        $('#btnSaveAccount').click(function(){
            var form = $('#accountForm');
            var url = form.attr('action');
            var data = form.serialize();

            if(form.valid() == true){

              $.ajax({
                type: 'ajax',
                method: 'POST',
                url: url,
                data: data,
                async: false,
                dataType: 'json',
                success: function(response){
                  if(response.success){
                    success('Successfully Added!');
                    $('.close').trigger('click');

                    setTimeout("location.reload(true);",2000);
                  }
                  else{
                    error('Invalid Code!');
                  }
                },
                error: function(){
                  error('Error!');
                }
              });

            }
            else{
            }

          });

        $('#btnSaveReferral').click(function(){
            var form = $('#referralForm');
            var url = form.attr('action');
            var data = form.serialize();

            if(form.valid() == true){

              $.ajax({
                type: 'ajax',
                method: 'POST',
                url: url,
                data: data,
                async: false,
                dataType: 'json',
                success: function(response){
                  if(response.success){
                    success('Thank you!');
                    $('.close').trigger('click');

                    setTimeout("location.reload(true);",2000);
                  }
                  else{
                    error('Invalid Account Name!');
                  }
                },
                error: function(){
                  error('Error!');
                }
              });

            }
            else{
            }

          });


        setTimeout(function(){
          addDialog('.dialog-add-account','.btnAddAccount');
          addDialog('.ReferredByDialog','#btnSetReferral');
        },500);
        
      </script>

    <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">