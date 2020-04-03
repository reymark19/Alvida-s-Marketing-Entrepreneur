	$(function() {


		$('#showData').on('click', '.Distribute', function(){
			var id = $(this).attr('data');
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: 'ProfitShare/getMembers/'+id+'',
				async: false,
				dataType: 'json',
				success: function(response){
					$("#btnDistributeProfitShare").attr('disabled',false);
					var data = response;
					var earnEach = data.Earn;
					$('#p1')[0].MaterialProgress.setProgress(0);
					$('#donedistribute').text(0);
					$('#earneachmember').text(earnEach);
					$('#earneachmember2').text(money(earnEach));
					$('#maxmembers').text(data.Count);
					$('#members').html('');
					$('#idps').val(data.ProfitShare[0].ProfitShareId);
					for (var i = data.Members.length - 1; i >= 0; i--) {
						$('#members').append('<li>' + data.Members[i].AccountId + '</li>');
					}
				},
				error: function(){
					error('Error in displaying Code details.');
				}

			});

		});

		//Saving/Updating employee details
		$('#btnSaveProfitShare').click(function(){
			var form = $('#profitShareForm');
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
						error('Error on saving Code.');
					}
				});

			}
			else{
			}

		});

		$('#btnDistributeProfitShare').click(function(){
			$(this).attr('disabled',true);
			var form = $('#distributeprofitShareForm');
			var url = form.attr('action');
			var data = form.serializeArray();
			var Earn = $('#earneachmember').text();
			var totalMembers = $('#maxmembers').text();
			var newData = data.slice();
			console.log(data);
			if(parseFloat(totalMembers) > 0){
				var cnt = 0;
				newData.push({
					'name': 'share',
					'value': Earn
				});
				newData.push({
					'name': 'maxaccount',
					'value': totalMembers
				});
				$.ajax({
					type: 'ajax',
					method: 'POST',
					url: "ProfitShare/updatePS",
					data: newData,
					async: true,
					dataType: 'json',
					success: function(){
					},
					error: function(){
						error('Update Profit Share Failed.');
					}
				});


				$('#members li').each(function(){
					var accountid = $(this).text();
					var newData = data.slice();
					newData.push({
						'name': 'share',
						'value': Earn
					});
					newData.push({
						'name': 'maxaccount',
						'value': totalMembers
					});
					newData.push({
						'name': 'accountid',
						'value': accountid
					});
					$.ajax({
						type: 'ajax',
						method: 'POST',
						url: "ProfitShare/distribute",
						data: newData,
						async: true,
						dataType: 'json',
						success: function(response){
							if(response.success){
								cnt++;
								$('#donedistribute').text(cnt);
								var percentage = (parseFloat($('#donedistribute').text()) / parseFloat(totalMembers)) * 100;
								console.log(percentage);
								$('#p1')[0].MaterialProgress.setProgress(percentage);
								//reload('table');
								//success('successfully saved!');
								//$('.close').trigger('click');
								if (cnt == parseFloat(totalMembers)) 
								{
									reload('table');
									success('successfully distributed!');
									setTimeout(function(){ $('.close').trigger('click'); }, 1000);
									
								}
							}
							else{
								error('Distribute Failed.');
							}
						},
						error: function(){
							error('Distribute Failed.');
						}
					});

					
				});
				

			}
			else{
			}

		});

  		$('#p1').bind('mdl-componentupgraded', function() {
			this.MaterialProgress.setProgress(0);
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
				url:'ProfitShare/getListJson',
				type: 'POST'
			},
			"fnServerParams": function ( aoData ) {
				// var data = aoData;
		  //     	data['param'] = { 
		  //     		"IsUsed": $('#isused').val()
	   //    		};
		      	//console.log(data);
		    },
		    "columns": [
		    	{ 
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		return money(d['Share']);
	            	}
	            },
	            { 
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		return money(d['ShareEachMember']);
	            	}
	            },
				{ "data": "MemberCount" },
				{ "data": "DateCreated" },
				{ "data": "DatePosted" },
	            { 
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		if (d['DatePosted'] == null) 
	            		{
	            			return '<td><a href="#!" class="Distribute show-distribute-dialog" data="'+d['ProfitShareId']+'"><i class="material-icons">refresh</i></a></td>';
	            		}
	            		else{
	            			return '';
	            		}
	            	}
	            }
	        ],
			"ordering": false,
		    "order": [[ 0, "asc" ]],
			"pageLength": 10,
			"deferRender": true,
			"drawCallback": function(settings, json) {
				addDialog('dialog','.show-dialog');
				addDialog('.distribute-dialog', '.show-distribute-dialog');
			}
		});



		// $('#isused').change(function() {

		// 	dtTable.draw();

		// });

});
