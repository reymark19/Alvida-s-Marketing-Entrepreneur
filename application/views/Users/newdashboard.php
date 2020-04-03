
    <!-- Banner here -->
        <div class="android-be-together-section mdl-typography--text-center">
          <div class="logo-font android-slogan">Welcome to Systemax</div>
          <br>
          <br>
        </div>

    <!-- Main -->
        <div class="android-screen-section mdl-typography--text-center" style="background-color: #f7f7f7 !important">
            <div class="android-wear-band-text mdl-grid" >
                <div class="mdl-cell--12-col text-center pb10 mdl-cell--12-col-phone">
                    <img src="<?php echo $_SESSION['Picture'] ?>" class="large-account-icon"><br><br>
                    <button class="mdl-button mdl-js-button starter">
                      <?php echo $AccountPackage['PackageName']; ?>
                    </button>
                    <br>
                    <span style="font-size: 0.7em;"><?php echo $AccountRank ?></span>
                    
                </div>

                <div class="mdl-cell mdl-cell--12-col pt10 pb10 mdl-cell--12-col-phone text-center">
                    <span class="text-m">₱<?php echo number_format($TotalEarned, 2) ?></span><br>
                    <span class="text-s">Total Reward Earned</span>
                    <button class="mdl-button mdl-js-button mdl-button--icon" id="btnRefreshMatchSales">
                      <i class="material-icons">cached</i>
                    </button>
                </div>
                <div class="mdl-cell mdl-cell--3-col text-center pt10 pb10 mdl-cell--12-col-phone">
                    <span class="text-m"><?php echo $ReferalsCount ?></span><br>
                    <span class="text-s">Refferal</span>
                </div>
                <div class="mdl-cell mdl-cell--3-col text-center pt10 pb10 mdl-cell--12-col-phone">
                    <span class="text-m"><?php echo $Account['TotalMVP'] ?></span><br>
                    <span class="text-s">Multilevel Points</span>
                </div>
                <div class="mdl-cell mdl-cell--3-col text-center pt10 pb10 mdl-cell--12-col-phone">
                    <span class="text-m"><?php echo $IncentivePoints ?></span><br>
                    <span class="text-s">Incentive Points</span>
                </div>
                <div class="mdl-cell mdl-cell--3-col text-center pt10 pb10 mdl-cell--12-col-phone">
                    <span class="text-m"><?php echo $DaysLeft ?></span><br>
                    <span class="text-s">Days Left</span>
                    <span id="guide-tips" class="icon material-icons help">help_outline</span>
                    <div class="mdl-tooltip" data-mdl-for="guide-tips">
                    Note: Profit Shares and Multilevel Master Program will be Inactive of account (your account will be inactive everytime you reach the monthly maintenance . You only have to do is to REPURCHASE PRODUCTS EVERY MONTHLY to enjoy products and benefits.
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Earned Area -->
        <div class="android-screen-section v2 mdl-typography--text-center" style="background-color: #fff !important">
            <div class="android-wear-band-text mdl-grid" >
          		<div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone mdl-typography--text-center" style="color: #8BC34A;">
                    <i class="material-icons" style="font-size: 3.2em;">
                    local_atm
                    </i><br><br>
          			<span class="text-m">₱<?php echo number_format($CurrentEarned, 2) ?></span><br>
                    <span class="text-s">Available Balance Earned</span>
                    <span></span>
                    <div id="totalrewardprogress" class="mdl-progress mdl-js-progress" style="width: 300px;margin: auto;margin-top:5px;"></div>
                    <script>
                    document.querySelector('#totalrewardprogress').addEventListener('mdl-componentupgraded', function() {
                        this.MaterialProgress.setProgress(<?php echo @((float)$CurrentEarned/(float)$TotalEarned)*100 ?>);
                    });
                    </script>
                  </div>
                  
                  <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone mdl-typography--text-center" style="color: #03a9f4;">
                    <i class="material-icons" style="font-size: 3.2em;">
                    done_all
                    </i><br><br>
          			<span class="text-m">₱<?php echo number_format($TotalEncashment, 2) ?></span><br>
                    <span class="text-s">Total Encashment</span>
                    <span></span>
                    <div id="TotalEncashmentprogress" class="mdl-progress mdl-js-progress" style="width: 300px;margin: auto;margin-top:5px;"></div>
                    <script>
                    document.querySelector('#TotalEncashmentprogress').addEventListener('mdl-componentupgraded', function() {
                        this.MaterialProgress.setProgress(<?php echo @((float)$TotalEncashment/(float)$TotalEarned)*100 ?>);
                    });
                    </script>
                  </div>
                  
                  <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone mdl-typography--text-center" style="color: #009688;">
                    <i class="material-icons" style="font-size: 3.2em;">
                    group
                    </i><br><br>
          			<span class="text-m">₱<?php echo number_format($ReferralEarned, 2) ?></span><br>
                    <span class="text-s">Total Referral Earned</span>
                    <span></span>
                    <div id="ReferralEarnedprogress" class="mdl-progress mdl-js-progress" style="width: 300px;margin: auto;margin-top:5px;"></div>
                    <script>
                    document.querySelector('#ReferralEarnedprogress').addEventListener('mdl-componentupgraded', function() {
                        this.MaterialProgress.setProgress(<?php echo @((float)$ReferralEarned/(float)$TotalEarned)*100 ?>);
                    });
                    </script>
          		</div>
            </div>
        </div>

        <!-- Total Earned Area -->
        <div class="android-screen-section v2 mdl-typography--text-center" style="background-color: #f7f7f7 !important">
            <div class="android-wear-band-text mdl-grid" >
                <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone mdl-typography--text-center" style="color: #ff5722;">
                    <i class="material-icons" style="font-size: 3.2em;">
                    group_add
                    </i><br><br>
          			<span class="text-m">₱<?php echo number_format($MatchEarned, 2) ?></span><br>
                    <span class="text-s">Total Match Sales Earned</span>
                    <span></span>
                    <div id="MatchEarnedprogress" class="mdl-progress mdl-js-progress" style="width: 300px;margin: auto;margin-top:5px;"></div>
                    <script>
                    document.querySelector('#MatchEarnedprogress').addEventListener('mdl-componentupgraded', function() {
                        this.MaterialProgress.setProgress(<?php echo @((float)$MatchEarned/(float)$TotalEarned)*100 ?>);
                    });
                    </script>
                  </div>
                  
                  <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone mdl-typography--text-center" style="color: #607d8b;">
                    <i class="material-icons" style="font-size: 3.2em;">
                    location_city
                    </i><br><br>
          			<span class="text-m">₱<?php echo number_format($ProfitShareEarned, 2) ?></span><br>
                    <span class="text-s">Total Profit Share Earned</span>
                    <span></span>
                    <div id="ProfitShareEarnedprogress" class="mdl-progress mdl-js-progress" style="width: 300px;margin: auto;margin-top:5px;"></div>
                    <script>
                    document.querySelector('#ProfitShareEarnedprogress').addEventListener('mdl-componentupgraded', function() {
                        this.MaterialProgress.setProgress(<?php echo @((float)$ProfitShareEarned/(float)$TotalEarned)*100 ?>);
                    });
                    </script>
                  </div>
                  
                  <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone mdl-typography--text-center" style="color: #3F51B5;">
                    <i class="material-icons" style="font-size: 3.2em;">
                    call_split
                    </i><br><br>
          			<span class="text-m"><?php echo $WaitingPoints ?></span><br>
                    <span class="text-s">Waiting Points</span>
                    <span></span>
                    <div id="WaitingPointsprogress" class="mdl-progress mdl-js-progress" style="width: 300px;margin: auto;margin-top:5px;"></div>
                    <script>
                    document.querySelector('#WaitingPointsprogress').addEventListener('mdl-componentupgraded', function() {
                        this.MaterialProgress.setProgress(<?php echo @(100-((float)$WaitingPoints/(float)$Account['TotalMVP'])*100) ?>);
                    });
                    </script>
          		</div>
            </div>
        </div>

        <div class="android-screen-section v2 mdl-typography--text-center" style="background-color: #fff !important">
            <div class="android-wear-band-text mdl-grid" >
            <div class="main-container">
                <section id="timeline" class="timeline-outer">
                    <div class="container" id="content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                        <h1 class="blue-text lighten-1 header">Your Income Timeline</h1>
                        <ul class="timeline">
                            <?php if ($LatestEarnings != false): ?>
                              <?php foreach ($LatestEarnings as $l): ?>
                                <?php 

                                  $text = "";
                                  if((int)$l['Credit'] > 0){
                                    $text = "Earned P".number_format($l['Credit'],2) . ' from ' . $l['Tag'];
                                  }
                                  else{
                                    $text = "Deducted P".number_format($l['Debit'],2) . ' from ' . $l['Tag'];
                                  }

                                 ?>

                                <li class="event" data-date="<?php echo date_format(date_create($l['DateCreated']),"m/d H:i") ?>">
                                <h3><?php echo $text ?></h3>
                                <p>

                                    <?php echo $l['Description'] . '. This will be your reference number #'.$l['EarnId'] ?>
                                </p>
                              <?php endforeach ?>
                            <?php endif ?>
                        </ul>
                        </div>
                    </div>
                    </div>
                    <span><i>this only shows your 20 latest income records</i></span>
                </section>
                </div>
            </div>
        </div>

        <?php if ($LatestPayoutRequest != false): ?>
            <div class="android-screen-section v2 mdl-typography--text-center" style="background-color: #f7f7f7 !important">
              <div class="android-wear-band-text mdl-grid">
                <h3 class="blue-text lighten-1 header">Your Latest Request for Encashment</h1>
                <ul class="demo-list-item mdl-list">
                  <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                      <span style="font-style: italic;">Note: Your old not approved request will be canceled if you create a new request.</span>
                    </span>
                  </li>
                  <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                      Fullname: "<?php echo $LatestPayoutRequest[0]['Fullname'] ?>"
                    </span>
                  </li>
                  <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                      Thru: "<?php echo $LatestPayoutRequest[0]['TransactionType'] ?>"
                    </span>
                  </li>
                  <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                      Email: "<?php echo $LatestPayoutRequest[0]['Email'] ?>"
                    </span>
                  </li>
                  <?php if (strlen($LatestPayoutRequest[0]['AccountNumber']) != 0): ?>
                    <li class="mdl-list__item">
                      <span class="mdl-list__item-primary-content">
                        Account Number: "<?php echo $LatestPayoutRequest[0]['AccountNumber'] ?>"
                      </span>
                    </li>
                    <li class="mdl-list__item">
                      <span class="mdl-list__item-primary-content">
                        Account Name: "<?php echo $LatestPayoutRequest[0]['AccountName'] ?>"
                      </span>
                    </li>
                  <?php endif ?>
                  <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                      Amount: "<?php echo $LatestPayoutRequest[0]['Amount'] ?>"
                    </span>
                  </li>
                  <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                      Address: "<?php echo $LatestPayoutRequest[0]['Address'] ?>"
                    </span>
                  </li>
                  <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                      Contact: "<?php echo $LatestPayoutRequest[0]['Contact'] ?>"
                    </span>
                  </li>
                  <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                      <?php if ($LatestPayoutRequest[0]['IsApproved'] == 1): ?>
                        Approved: "Yes"
                      <?php else: ?>
                        Approved: "No"
                      <?php endif ?>
                    </span>
                  </li>
                  <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                      <?php if ($LatestPayoutRequest[0]['IsActive'] == 1): ?>
                        Cancelled: "No"
                      <?php else: ?>
                        Cancelled: "Yes"
                      <?php endif ?>
                    </span>
                  </li>
                  <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                      Note from Admin: "<?php echo $LatestPayoutRequest[0]['Message'] ?>"
                    </span>
                  </li>
                </ul>
              </div>
          </div>
        <?php endif ?>
        
        <footer class="android-footer mdl-mega-footer">
          

        </footer>
      </div>
    </div>
    
<script>
  $('#btnRefreshMatchSales').click(function(){
    $.ajax({
      type: 'ajax',
      method: 'POST',
      url: '<?php echo base_url() ?>Users/earnFromMatchSales',
      async: true,
      dataType: 'json',
      success: function(response){
        window.location = "<?php echo base_url() ?>users/dashboard";
      },
      error: function(){
        error('Error');
      }

    });
  });

  
  $(function(){

    var dtTable = $('#table').DataTable( {
        "processing": true,
      "oLanguage": {
        "sProcessing": '<div id="p2" style="width:100%" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>'  
      },
          "serverSide": true,
      "ajax": 
      { 
        url:'<?php echo base_url() ?>Users/getUserEarningLogs',
        type: 'POST'
      },
      "fnServerParams": function ( aoData ) {
        // var data = aoData;
            // data['param'] = { 
            //  "IsUsed": $('#isused').val()
            // };
            //console.log(data);
        },
        "columns": [
        { "data": "EarnId" },
        {
                "mdata": null,
                "mRender": function(data,type,d){
            
                  return money(d['Debit']);
                },
                "className": 'unnowrap text-left'
              },
        {
                "mdata": null,
                "mRender": function(data,type,d){
            
                  return money(d['Credit']);
                },
                "className": 'unnowrap text-left'
        },
        {
                "mdata": null,
                "mRender": function(data,type,d){
            
                  return d['Description'];
                },
                "className": 'unnowrap text-left'
              },
          ],
      "ordering": false,
        "order": [[ 0, "asc" ]],
      "pageLength": 10,
      "deferRender": true,
      "drawCallback": function(settings, json) {
        addDialog('.payout-dialog','.payout-button');
      }
    });

  });
  
</script>
