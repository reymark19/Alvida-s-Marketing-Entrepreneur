
  <body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

      <div class="android-header mdl-layout__header mdl-layout__header--waterfall">
        <div class="mdl-layout__header-row">
          <span class="android-title mdl-layout-title">
            <img class="android-logo-image" src="<?php echo base_url() ?>images/logo.jpg">
          </span>
          <!-- Add spacer, to align navigation to the right in desktop -->
          <div class="android-header-spacer mdl-layout-spacer"></div>
          <!-- Navigation -->
          <div class="android-navigation-container">
            <nav class="android-navigation mdl-navigation">
            <?php if ($IsUserAccountVerified == true): ?>
              <a class="mdl-navigation__link mdl-typography--text-uppercase" href="<?php echo base_url() ?>Users/Dashboard/<?php echo @$_SESSION['AccountName'] ?>">Dashboard</a>
              <?php if ($newmembertobeassigncnt > 0): ?>
                <a class="mdl-navigation__link mdl-typography--text-uppercase mdl-badge mdl-badge--overlap" data-badge="<?php echo $newmembertobeassigncnt ?>" href="<?php echo base_url() ?>Binary/Network/<?php echo @$_SESSION['AccountName'] ?>">Binary</a>
              <?php else: ?>
                <a class="mdl-navigation__link mdl-typography--text-uppercase" href="<?php echo base_url() ?>Binary/Network/<?php echo @$_SESSION['AccountName'] ?>">Binary</a>
              <?php endif ?>
              <a class="mdl-navigation__link mdl-typography--text-uppercase" href="#!">Order</a>
              <a class="mdl-navigation__link mdl-typography--text-uppercase" href="#!">Gift</a>
              <a class="mdl-navigation__link mdl-typography--text-uppercase" href="#!">Voucher</a>
              <a class="mdl-navigation__link mdl-typography--text-uppercase" href="#!">Products</a>
              <a class="mdl-navigation__link mdl-typography--text-uppercase" href="#!">Code</a>
              <a class="mdl-navigation__link mdl-typography--text-uppercase payout-button" href="#!">Encashment</a>
            <?php else: ?>
              <a class="mdl-navigation__link mdl-typography--text-uppercase btnAddAccount" href="#!">Dashboard</a>
              <a class="mdl-navigation__link mdl-typography--text-uppercase btnAddAccount" href="#!">Binary</a>
              <a class="mdl-navigation__link mdl-typography--text-uppercase btnAddAccount" href="#!">Order</a>
              <a class="mdl-navigation__link mdl-typography--text-uppercase btnAddAccount" href="#!">Gift</a>
              <a class="mdl-navigation__link mdl-typography--text-uppercase btnAddAccount" href="#!">Voucher</a>
              <a class="mdl-navigation__link mdl-typography--text-uppercase btnAddAccount" href="#!">Products</a>
              <a class="mdl-navigation__link mdl-typography--text-uppercase btnAddAccount" href="#!">Code</a>
              <a class="mdl-navigation__link mdl-typography--text-uppercase btnAddAccount" href="#!">Encashment</a>
            <?php endif ?>
              <?php if ($Account['ReferredById'] == null && $Accounts != false): ?>
              <a class="mdl-navigation__link mdl-typography--text-uppercase" href="#!">
              <button id="btnSetReferral" class="btnSetReferral mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" style="margin-left: 10px;margin-right: 5px;">
                ReferredBy
              </button>
              </a>
              <div class="mdl-tooltip" data-mdl-for="btnSetReferral">
                Note: Please Contact the Person who referred you for the Account Name.
              </div>
            <?php endif ?>
            </nav>
          </div>
          <span class="android-mobile-title mdl-layout-title">
            <img class="android-logo-image" src="<?php echo base_url() ?>images/logo.jpg">
          </span>
          <button class="android-more-button mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect" id="more-button">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right mdl-js-ripple-effect" for="more-button">
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
      </div>

      <div class="android-drawer mdl-layout__drawer">
        <span class="mdl-layout-title">
          <img class="android-logo-image" src="<?php echo base_url() ?>images/logo.jpg">
        </span>
        <nav class="mdl-navigation">
          <span class="mdl-navigation__link" href="">Menu</span>
          <?php if ($IsUserAccountVerified == true): ?>
          <a class="mdl-navigation__link" href="<?php echo base_url() ?>Users/Dashboard/<?php echo @$_SESSION['AccountName'] ?>">Dashboard</a>
          <a class="mdl-navigation__link" href="<?php echo base_url() ?>Binary/Network/<?php echo @$_SESSION['AccountName'] ?>">Binary</a>
          <a class="mdl-navigation__link" href="#!">Order</a>
          <a class="mdl-navigation__link" href="#!">Gift Certificate</a>
          <a class="mdl-navigation__link" href="#!">Voucher</a>
          <a class="mdl-navigation__link" href="#!">Products</a>
          <a class="mdl-navigation__link" href="#!">Code Vault</a>
          <a class="mdl-navigation__link payout-button" href="#!">Request Payout</a>
          <?php else: ?>
          <a class="mdl-navigation__link btnAddAccount" href="#!">Dashboard</a>
          <a class="mdl-navigation__link btnAddAccount" href="#!">Binary</a>
          <a class="mdl-navigation__link btnAddAccount" href="#!">Order</a>
          <a class="mdl-navigation__link btnAddAccount" href="#!">Gift Certificate</a>
          <a class="mdl-navigation__link btnAddAccount" href="#!">Voucher</a>
          <a class="mdl-navigation__link btnAddAccount" href="#!">Products</a>
          <a class="mdl-navigation__link btnAddAccount" href="#!">Code Vault</a>
          <a class="mdl-navigation__link btnAddAccount" href="#!">Request Payout</a>
          <?php endif ?>
          <?php if ($Account['ReferredById'] == null && $Accounts != false): ?>
              <a class="mdl-navigation__link mdl-typography--text-uppercase" href="#!">
              <button id="btnSetReferral" class="btnSetReferral mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" style="margin-left: 10px;margin-right: 5px;">
                ReferredBy
              </button>
              </a>
          <?php endif ?>
          <div class="android-drawer-separator"></div>
          <span class="mdl-navigation__link" href="">Switch Account</span>
            <?php if ($Accounts != false): ?>
              <?php foreach ($Accounts as $account): ?>
              <a class="mdl-navigation__link" href="<?php echo base_url() ?>Users/SwitchAccount/<?php echo @$account['AccountName'] ?>"><?php echo @$account['AccountName'] ?></a>
              <?php endforeach ?>
            <?php endif ?>
            <?php if ($AccountsCount <= 8): ?>
              <a class="mdl-navigation__link btnAddAccount" href="#!" style="color: #000; text-decoration: none;">Add Account</a>
            <?php endif ?>
            <a class="mdl-navigation__link" style="color: #000; text-decoration: none;" href="#!"  onclick="signOut();">Sign out</a>
        
          
        </nav>
      </div>

      <dialog class="mdl-dialog payout-dialog">
            <h4 class="mdl-dialog__title modal-title">Request Payout</h4>
              <div class="mdl-dialog__content">
                <form action="<?php echo base_url() ?>Payout/insert" id="payoutForm">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="fullname" name="fullname" maxlength="60" required>
                                <label class="mdl-textfield__label" for="fullname">Fullname</label>
                            </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                             <input type="text" value="" class="mdl-textfield__input" id="transactiontype" readonly>
                                       <input type="hidden" value="" name="transactiontype" tabindex="2">
                            <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            <label for="transactiontype" class="mdl-textfield__label">Transaction Type</label>
                            <ul for="transactiontype" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                              <li class="mdl-menu__item" data-val="Palawan" data-selected="true">Palawan</li>
                              <li class="mdl-menu__item" data-val="Cebuana Lhuillier">Cebuana Lhuillier</li>
                              <li class="mdl-menu__item" data-val="Western Union">Western Union</li>
                              <li class="mdl-menu__item" data-val="Metropolitan Bank and Trust Company">MetroBank</li>
                              <li class="mdl-menu__item" data-val="Bank of the Philippine Islands">Bank of the Philippine Islands</li>
                              <li class="mdl-menu__item" data-val="Philippine National Bank">Philippine National Bank</li>
                              <li class="mdl-menu__item" data-val="China Banking Corporation">China Banking Corporation</li>
                              <li class="mdl-menu__item" data-val="Security Bank Corporation">Security Bank Corporation</li>
                              <li class="mdl-menu__item" data-val="Union Bank of the Philippines">Union Bank of the Philippines</li>
                              <li class="mdl-menu__item" data-val="EastWest Bank">EastWest Bank</li>
                              <li class="mdl-menu__item" data-val="Citibank Philippines">Citibank Philippines</li>
                              <li class="mdl-menu__item" data-val="Philtrust Bank">Philtrust Bank</li>
                            </ul>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="accountnumber" name="accountnumber" required>
                                <label class="mdl-textfield__label" for="accountnumber">Account Number</label>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="accountnamefrom" name="accountnamefrom" required>
                                <label class="mdl-textfield__label" for="accountnamefrom">Account Name</label>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="number" id="amount" name="amount" min="900" required>
                                <label class="mdl-textfield__label" for="amount">Amount (Min: ₱1,100)</label>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="address" name="address" required>
                                <label class="mdl-textfield__label" for="address">Address</label>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="contact" name="contact" required>
                                <label class="mdl-textfield__label" for="contact">Contact</label>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="email" id="email" name="email" required>
                                <label class="mdl-textfield__label" for="email">Email</label>
                            </div>
                </form>

                <span>Payout Summary</span><br>
                <span style="color: #757575;">Amount: <span id="amount_vessel"></span></span><br>
                <span style="color: #757575;">Admin fee: <span id="admin_fee"></span></span><br>
                <span style="color: #757575;">tax(10%): <span id="tax"></span></span><br>
                <span style="color: #757575;border-top: 1px solid;">Encash: <span id="encash"></span></span>
              </div>
              <div class="mdl-dialog__actions">
                <button type="button" class="mdl-button close">Cancel</button>
                <button type="button" class="mdl-button" id="btnSavePayout">Save</button>
              </div>
            </dialog>

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
      $('#btnSavePayout').click(function(){
          var form = $('#payoutForm');
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
                        reload('tablePayout');
                          success('Request Payout successfully sent');
                          $('.close').trigger('click');
                      }
                      else{
                          error(response.message);
                      }
                  },
                  error: function(){
                      error('Request Payout failed');
                  }
              });

          }
          else{
          }
      });

      $('#amount').change(function(){
        var amount = $(this).val();
        $('#amount_vessel').text(money(amount));
        var tax = (amount * .10).toFixed(2);
        $('#tax').text(money(tax));
        var encash = (amount-((amount * .10)+100)).toFixed(2);
        $('#encash').text(money(encash));
        $('#admin_fee').text(money(100));
      });

      $('#transactiontype').change(function(){

        var type = $(this).val();
        console.log(type);

        if (type == 'Palawan' || type == 'Cebuana Lhuillier' || type == 'Western Union') {
          $('#fullname').parent().css('display','block');
          $('#fullname').attr('required','true');

          $('#accountnamefrom').parent().css('display','none');
          $('#accountnamefrom').attr('required','false');

          $('#accountnumber').parent().css('display','none');
          $('#accountnumber').attr('required','false');

          $('#address').parent().css('display','block');
          $('#address').attr('required','true');

          $('#email').parent().css('display','block');
          $('#email').attr('required','true');

          $('#amount').parent().css('display','block');
          $('#amount').attr('required','true');

          $('#contact').parent().css('display','block');
          $('#contact').attr('required','true');
        }
        else{
          $('#fullname').parent().css('display','block');
          $('#fullname').attr('required','true');

          $('#accountnamefrom').parent().css('display','block');
          $('#accountnamefrom').attr('required','true');

          $('#accountnumber').parent().css('display','block');
          $('#accountnumber').attr('required','true');

          $('#address').parent().css('display','block');
          $('#address').attr('required','true');

          $('#email').parent().css('display','block');
          $('#email').attr('required','true');

          $('#amount').parent().css('display','block');
          $('#amount').attr('required','true');

          $('#contact').parent().css('display','block');
          $('#contact').attr('required','true');
        }
      });

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
        
        $('.btnSaveReferral').click(function(){
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
          addDialog('.ReferredByDialog','.btnSetReferral');
          addDialog('.payout-dialog','.payout-button');
        },500);
        
      </script>
    
      <div class="android-content mdl-layout__content">
        <a name="top"></a>
