	$(function() {

		$('#showData').on('click', '.Edit', function(){
			var id = $(this).attr('data');
			$('dialog').find('.modal-title').text('Add Message');
			$('#payoutForm').attr('action','Payout/update');
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: 'Payout/get/'+id+'',
				async: false,
				dataType: 'json',
				success: function(response){
					//display the fetch data to form
					var data = (response['data'][0]);
					$('#id').val(data.PayoutId); //must have don't erase
					displayInForm(data, '#payoutForm');
				},
				error: function(){
					error('Error in displaying Payout request details.');
				}

			});

		});

		$('#showData').on('click', '.IsApproved', function(event){
			var checked = $(this).attr('data');
			var id = $(this).attr('id');
			$('#btnSetApproved').attr('data',checked);
			$('#btnSetApproved').attr('idapproved',id);

			event.preventDefault();
		});

		$('#btnSetApproved').click(function(){
			var checked = $(this).attr('data');
			var id = $(this).attr('idapproved');
			$.ajax({
				type: 'ajax',
				method: 'POST',
				url: 'Payout/updateStatus',
				data: {'id':id, 'checked': checked},
				async: false,
				dataType: 'json',
				success: function(response){
					if(response.success){
						reload('table');
						success('successfully approved');
						$('.close').trigger('click');
					}
					else{
						if(response.message != false){
							reload('table');
							warning(response.message);
						}else{
							error('Error on chaging payout request status.');
						}
					}
				},
				error: function(){
					error('Error on chaging payout request status.');
				}
			});
		});

		$('#showData').on('click', '.isDeleted', function(event){
			var checked = $(this).attr('data');
			var id = $(this).attr('id');
			$('#btnDeleted').attr('data',checked);
			$('#btnDeleted').attr('idactive',id);

			event.preventDefault();
		});

		$('#btnDeleted').click(function(){
			var checked = $(this).attr('data');
			var id = $(this).attr('idactive');
			$.ajax({
				type: 'ajax',
				method: 'POST',
				url: 'Payout/updateStatusActive',
				data: {'id':id, 'checked': checked},
				async: false,
				dataType: 'json',
				success: function(response){
					if(response.success){
						reload('table');
						success('successfully approved');
					}
					else{
						if(response.message != false){
							reload('table');
							warning(response.message);
						}else{
							error('Error on chaging payout request status.');
						}
					}
					$('.close').trigger('click');
				},
				error: function(){
					error('Error on chaging payout request status.');
				}
			});
		});


		$('#btnSavePayout').click(function(){
			var form = $('#payoutForm');
			var url = form.attr('action');
			var data = form.serialize();
			//return 'true' if validate successful
			//console.log(form);
			//console.log(form.valid());
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
							reload('table');
							success('successfully saved!');
							$('.close').trigger('click');
						}
						else{
							error('Nothing Changes');
						}
					},
					error: function(){
						error('Error on saving User.');
					}
				});

			}
			else{
			}

		});



		//Main table

		var dtTable = $('#table').DataTable( {
		    "processing": true,
			"oLanguage": {
				"sProcessing": '<div id="p2" style="width:100%" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>'	
			},
	        "serverSide": true,
			"ajax": 
			{ 
				url:'Payout/getListJson',
				type: 'POST'
			},
			"fnServerParams": function ( aoData ) {
				var data = aoData;
		      	data['param'] = { 
		      		"IsApproved": $('#isapproved').val()
	      		};
		      	//console.log(data);
		    },
		    "columns": [
		    	{
	            	"mdata": null,
	            	"mRender": function(data,type,d){
						
	            		return d['Fullname'];
	            	},
	            	"className": 'unnowrap text-left'
	            },
		    	{
	            	"mdata": null,
	            	"mRender": function(data,type,d){
						
	            		return money(d['Amount']);
	            	},
	            	"className": 'unnowrap text-left'
	            },
	            { "data": "TransactionType" },
	            { "data": "AccountNumber" },
	            { "data": "AccountName" },
	            { "data": "Address" },
	            { "data": "Contact" },
	            { "data": "Email" },
				{
	            	"mdata": null,
	            	"mRender": function(data,type,d){
						
	            		return d['Message'];
	            	},
	            	"className": 'unnowrap text-left'
	            },
	            { "data": "DateCreated" },
	            { "data": "DateApproved" },
	            {
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		var IsApproved = '';
						if(d['IsApproved'] == 1)
						{ 
							return 'Approved';
						}
						else if(d['IsActive'] == 0){
							return 'NA';
						}
						else{
							return '<td class="center">'+
								'<input type="checkbox" class="IsApproved filled-in" id="'+d['PayoutId']+'" '+IsApproved+' data="'+ d['IsApproved']+'"/>'+
						     	'<label for="'+d['PayoutId']+'"></label>'+
						    '</td>';
						}
	            		
	            	},
	            	"className": ''
	            },
	            {
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		var isDeleted = '';
						if(d['IsActive'] == 0)
						{ 
							return 'Deleted';
						}
						else{
							return '<td class="center">'+
								'<input type="checkbox" class="isDeleted filled-in" id="'+d['PayoutId']+'" '+isDeleted+' data="'+ d['IsActive']+'"/>'+
						     	'<label for="'+d['PayoutId']+'"></label>'+
						    '</td>';
						}
	            		
	            	},
	            	"className": ''
	            },
	            { 
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		return '<td><a href="#" class="Edit show-dialog" data="'+d['PayoutId']+'"><i class="material-icons">mode_edit</i></a></td>';
	            	}
	            }
	        ],
			"ordering": false,
		    "order": [[ 0, "asc" ]],
			"pageLength": 10,
			"deferRender": true,
			"drawCallback": function(settings, json) {
				addDialog('dialog','.show-dialog');
				addDialog('.dialog-approved','.IsApproved');
				addDialog('.dialog-deleted','.isDeleted');
			}
		});



		$('#isapproved').change(function() {

			dtTable.draw();

		});

});
