

<style type="text/css">

#information-container {
	width: 400px;
	margin: 50px auto;
	padding: 20px;
	border: 1px solid #cccccc;
}

.information {
	margin: 0 0 30px 0;
}

.information label {
	display: inline-block;
	vertical-align: middle;
	width: 150px;
	font-weight: 700;
}

.information span {
	display: inline-block;
	vertical-align: middle;
}

.information img {
	display: inline-block;
	vertical-align: middle;
	width: 100px;
}

</style>

        <div class="demo-charts mdl-color--blue-600 mdl-color-text--blue-grey-50 mdl-shadow--2dp mdl-cell--12-col mdl-grid">
        	<div class="mdl-cell--2-col text-center pb10 mdl-cell--12-col-phone">
        		<img src="<?php echo $_SESSION['Picture'] ?>" class="large-account-icon"><br>
        		<span><?php echo $AccountPackage['PackageName']; ?></span><br>
        		<span><?php echo $AccountRank ?></span>
        	</div>
        	<div class="mdl-cell mdl-cell--2-col pb10 mdl-cell--12-col-phone text-center">
        		<span class="text-m">₱<?php echo $CurrentEarned ?></span><br>
        		<span>Reward Earned</span>
        	</div>
        	<div class="mdl-cell mdl-cell--2-col text-center pb10">
        		<span class="text-m"><?php echo $ReferalsCount ?></span><br>
        		<span>Refferal</span>
        	</div>
        	<div class="mdl-cell mdl-cell--2-col text-center pb10">
        		<span class="text-m"><?php echo $Account['TotalMVP'] ?></span><br>
        		<span>Multilevel Points</span>
        	</div>
        	<div class="mdl-cell mdl-cell--2-col text-center pb10">
        		<span class="text-m"><?php echo $IncentivePoints ?></span><br>
        		<span>Incentive Points</span>
        	</div>
        	<div class="mdl-cell mdl-cell--2-col text-center pb10">
        		<span class="text-m"><?php echo $DaysLeft ?></span><br>
        		<span>Days Left</span>
        		<span id="guide-tips" class="icon material-icons help">help_outline</span>
				<div class="mdl-tooltip" data-mdl-for="guide-tips">
				Note: Profit Shares and Multilevel Master Program will be Inactive of account (your account will be inactive everytime you reach the monthly maintenance . You only have to do is to REPURCHASE PRODUCTS EVERY MONTHLY to enjoy products and benefits.
				</div>
        	</div>
          </div>
          <div class="mdl-cell mdl-shadow--2dp mdl-color--white mdl-cell--12-col">
			<div class="mdl-grid text-center" style="background: #1e88e50d;">
				<div class="mdl-cell mdl-cell--4-col">
          			<button id="btnRefreshMatchSales" class="mdl-button mdl-js-button mdl-js-ripple-effect">
					  <i class="material-icons">refresh</i>
						MATCH SALES
					</button>
          		</div>
          		<div class="mdl-cell mdl-cell--4-col">
          			<button class="mdl-button mdl-js-button mdl-js-ripple-effect payout-button">
					  <i class="material-icons">send</i>
					  REQUEST PAYOUT
					</button>


					<dialog class="mdl-dialog payout-dialog">
						<h4 class="mdl-dialog__title modal-title">Request Payout</h4>
							<div class="mdl-dialog__content">
								<form action="<?php echo base_url() ?>Payout/insert" id="payoutForm">
									
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
				                        <input class="mdl-textfield__input" type="text" id="fullname" name="fullname" maxlength="60" required>
				                        <label class="mdl-textfield__label" for="fullname">Name</label>
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
				                        <input class="mdl-textfield__input" type="number" id="amount" name="amount" min="1" required>
				                        <label class="mdl-textfield__label" for="amount">Amount</label>
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
							</div>
							<div class="mdl-dialog__actions">
							  <button type="button" class="mdl-button close">Cancel</button>
							  <button type="button" class="mdl-button" id="btnSavePayout">Save</button>
							</div>
						</dialog>

          		</div>
			</div>
          	<div class="mdl-grid text-center">
          		<div class="mdl-cell mdl-cell--4-col">
          			<br>
          			<span class="text-s">₱<?php echo $TotalEarned ?></span><br>
        			<span>Total Reward Earned</span>
          		</div>
          		<div class="mdl-cell mdl-cell--4-col">
          			<br>
          			<span class="text-s">₱<?php echo $TotalEncashment ?></span><br>
        			<span>Total Encashment</span>
          		</div>
          		<div class="mdl-cell mdl-cell--4-col">
          			<br>
          			<span class="text-s">₱<?php echo $ReferralEarned ?></span><br>
        			<span>Total Referral Earned</span>
				  </div>
				  <div class="mdl-cell mdl-cell--4-col">
          			<br>
          			<span class="text-s">₱<?php echo $MatchEarned ?></span><br>
        			<span>Total Match Sales Earned</span>
          		</div>
          		<div class="mdl-cell mdl-cell--4-col">
          			<br>
          			<span class="text-s">₱<?php echo $ProfitShareEarned ?></span><br>
        			<span>Total Profit Share Earned</span>
          		</div>
				<div class="mdl-cell mdl-cell--4-col">
          			<br>
          			<span class="text-s"><?php echo $WaitingPoints ?> pts</span><br>
        			<span>Waiting Points</span>
          		</div>
			  </div>
          	<hr>
          	<div class="mdl-grid">
			  	<table id="table" class="mdl-data-table unnowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>DEBIT</th>
							<th>CREDIT</th>
							<th>DESCRIPTION</th>
						</tr>
					</thead>
					<tbody id="showData">
					</tbody>
				</table>
          	</div>


          	<div class="mdl-grid">
			  	<table id="tablePayout" class="mdl-data-table unnowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Fullname</th>
							<th>Amount</th>
							<th>Message</th>
							<th>Date Requested</th>
							<th>Date Approved</th>
						</tr>
					</thead>
					<tbody id="showData">
					</tbody>
				</table>
          	</div>

          </div>
          <!-- <div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-shadow--2dp  mdl-color--white">
	        <ul class="demo-list-icon mdl-list">
          <li class="mdl-list__item post">
            <span class="post-header">Latest News</span>
          </li>
				  <li class="mdl-list__item post">
				    <span class="mdl-list__item-primary-content">
				    <i class="material-icons mdl-list__item-icon">person</i>
				    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				    consequat.
				</span>
				  </li>
				  <li class="mdl-list__item post">
				    <span class="mdl-list__item-primary-content">
				    <i class="material-icons mdl-list__item-icon">person</i>
				    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				    tempor incididunt ut labore et dolore magna aliqua.
				  </span>
				  </li>
				  <li class="mdl-list__item post">
				    <span class="mdl-list__item-primary-content">
				    <i class="material-icons mdl-list__item-icon">person</i>
				    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				    consequat.
				  </span>
				  </li>
				</ul>
        </div> -->
      </main>
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

	$(function(){



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
		      	// 	"IsUsed": $('#isused').val()
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

		var dtTablePayout = $('#tablePayout').DataTable( {
		    "processing": true,
			"oLanguage": {
				"sProcessing": '<div id="p2" style="width:100%" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>'	
			},
	        "serverSide": true,
			"ajax": 
			{ 
				url:'<?php echo base_url() ?>Payout/getListJson/1',
				type: 'POST'
			},
		    "columns": [
				{ "data": "Fullname" },
				{
	            	"mdata": null,
	            	"mRender": function(data,type,d){
						
	            		return money(d['Amount']);
	            	},
	            	"className": 'unnowrap text-left'
	            },
				{
	            	"mdata": null,
	            	"mRender": function(data,type,d){
						
	            		return d['Message'];
	            	},
	            	"className": 'unnowrap text-left'
	            },
	            { "data": "DateCreated" },
	            { "data": "DateApproved" },
	        ],
			"ordering": false,
		    "order": [[ 0, "asc" ]],
			"pageLength": 5,
			"deferRender": true,
			"drawCallback": function(settings, json) {
				
			}
		});
	});
	
</script>
