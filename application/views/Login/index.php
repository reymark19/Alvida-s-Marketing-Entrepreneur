
<style>

    body {
        background-color: #444;
    }

    #login-conatiner{
    margin: auto;
    }

    .mdl-card, .mdl-card__supporting-text {
        overflow: inherit !important;
    }

    .mdl-card {
        overflow: visible !important;
        z-index: auto !important;
    }

    #login-fab {
        border-radius: 50%;
        height: 56px;
        margin: auto;
        min-width: 56px;
        width: 56px;
        overflow: hidden;
        background: rgba(158,158,158,.2);
        box-shadow: 0 1px 1.5px 0 rgba(0,0,0,.12), 0 1px 1px 0 rgba(0,0,0,.24);
        position: absolute;
        top: -30px;
        text-align: center;
        left: 0;
        right: 0;
    }

    #lock-icon{
        line-height: 56px;
    }

    #login-button {
      width: 100%;
      height: 40px;
      min-width: initial;
    }

    #card-heading{
        text-align: center;
        font-weight: 600;
        font-size: 32px;
        height: 30px;
        padding-top: 30px;
        color: rgba(0, 0, 0, 0.31);
    }

    #forgotpassword{
        float: right;
    }

    #login-button-1 {
        display: block;
        text-align: center;
        margin: 50px 0;
    }
</style>

<script src="https://apis.google.com/js/platform.js" async defer></script>

<div class="mdl-layout mdl-js-layout">
    <div id="login-conatiner" class="mdl-card mdl-shadow--16dp">
        <div class="mdl-card__supporting-text">
            <div id="card-heading">
                User Login
            </div>
            <br>
            <span style="color: red;"><?php echo @$message ?></span>
            <form action="<?php echo base_url() ?>Auth/Login" method="POST">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="username" name="username" pattern="[A-Z,a-z,0-9]*" minlength="5"/>
                <label class="mdl-textfield__label" for="username">username</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="password" id="password" name="password"  pattern="[A-Z,a-z,0-9]*" minlength="5"/>
                <label class="mdl-textfield__label" for="password">Password</label>
            </div> 

             <button id="login-button" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white">
                    Login
                </button>   
            </form>
            <!-- <a id="login-button-1" href="<?= 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=offline' ?>">Login with Google</a> -->
            <div style="margin: 10px 30%;">
                
                <div class="g-signin2" data-onsuccess="onSignIn"></div>
            </div>
            <!-- <a href="#" onclick="signOut();">Sign out</a> -->
        </div>

        <div class="mdl-card__actions">
            <!-- <button class="mdl-button mdl-js-button mdl-button--primary">Register</button>
            <button id='forgotpassword' class="mdl-button mdl-js-button mdl-button--primary">Forgot Password</button> -->
        </div>
    </div>
</div>

<script>
    function onSignIn(googleUser) {
      var profile = googleUser.getBasicProfile();
      console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
      console.log('Name: ' + profile.getName());
      console.log('Image URL: ' + profile.getImageUrl());
      console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
      console.log(profile);

      $id = profile.getId();
      $name = profile.getName();
      $email = profile.getEmail();
      $picture = profile.getImageUrl();
        $.ajax({
            type: 'ajax',
            method: 'GET',
            url: "<?php echo base_url() ?>users/dashboard",
            data: {
                'id' : $id,
                'name' : $name,
                'email' : $email,
                'picture' : $picture
            },
            dataType: 'json',
            success: function(){
               window.location = "<?php echo base_url() ?>users/dashboard";
            },
            error: function(){
               window.location = "<?php echo base_url() ?>users/dashboard";
              //error('Error!');
            }
          });
    }

    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
          console.log('User signed out.');
        });
      }
</script>