	$(function() {


		//Editing user details

		$('#showData').on('click', '.Edit', function(){
			var id = $(this).attr('data');
			// $('dialog').find('.modal-title').text('Edit Report');
			// $('#reportForm').attr('action','Report/update');
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: 'Report/get/'+id+'',
				async: false,
				dataType: 'json',
				success: function(response){
					//display the fetch data to form
					var data = (response['data'][0]);
					$('#id').val(data.ReportId); //must have don't erase
					$('#id').attr("data-ischange",false);
					//$('#file').attr("value",data.ReportName); //must have don't erase
					displayInForm(data, '#reportForm');
				},
				error: function(){
					error('Error in displaying Report details.');
				}

			});

		});

		$("#file").change(function(){
			$('#id').attr("data-ischange",true);
		});




		//Deactivate / activate  

		$('#showData').on('click', '.IsActive', function(){
			var checked = $(this).attr('data');
			var id = $(this).attr('id');
			$.ajax({
				type: 'ajax',
				method: 'POST',
				url: 'Report/updateStatus',
				data: {'id':id, 'checked': checked},
				async: false,
				dataType: 'json',
				success: function(response){
					if(response.success){
						reload('table');
						success('Report status is successfully changed.');
					}
					else{
						if(response.message != false){
							reload('table');
							error(response.message);
						}else{
							error('Error on chaging User status.');
						}
					}
				},
				error: function(){
					error('Error on chaging User status.');
				}

			});

		});

		// $('#showData').on('click', '.download-file', function(){
		// 	var checked = $(this).attr('data-id');
		// 	$.ajax({
		// 		type: 'ajax',
		// 		method: 'POST',
		// 		url: 'Report/updateStatus',
		// 		data: {'id':id, 'checked': checked},
		// 		async: false,
		// 		dataType: 'json',
		// 		success: function(response){
		// 			if(response.success){
		// 				reload('table');
		// 				success('Report status is successfully changed.');
		// 			}
		// 			else{
		// 				if(response.message != false){
		// 					reload('table');
		// 					warning(response.message);
		// 				}else{
		// 					error('Error on chaging User status.');
		// 				}
		// 			}
		// 		},
		// 		error: function(){
		// 			error('Error on chaging User status.');
		// 		}

		// 	});

		// });


		//Saving/Updating employee details

		$('#btnSaveReport').click(function(){
			var form = $('#reportForm');
			var url = form.attr('action');
			var data = form.serialize();
			var ischange = $('#id').attr('data-ischange');
			//return 'true' if validate successful
			//console.log(form);
			//console.log(form.valid());
			if(form.valid() == true){

				var file = $('#file').val();
				if ($('#id').val() != "")//edit here 
				{
					var newdata = new FormData($('#reportForm')[0]);
					newdata.append('ischange', ischange);
					//console.log(newdata);
					$.ajax({
						type: 'ajax',
						method: 'POST',
						url: url,
						fileElementId:'file',
						data: newdata,
						cache: false,
						contentType: false,
						processData: false,
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
					$.ajax({
						type: 'ajax',
						method: 'POST',
						fileElementId:'file',
						url: 'Report/upload',
						data: new FormData($('#reportForm')[0]),
						cache: false,
						contentType: false,
						processData: false,
						dataType: 'json',
						success: function(response){
							if(response.success){
								file = response['data'][0];
								$.ajax({
									type: 'ajax',
									method: 'POST',
									url: url,
									data: data + "&fileid=" + file.FileId + "&size=" + file.Size,
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
								error(response.error);
							}
						},
						error: function(){
							success('Please refresh and check if the image was uploaded');
						}
					});
				}
				
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
				url:'Report/getListJson',
				type: 'POST'
			},
			"fnServerParams": function ( aoData ) {
				// var data = aoData;
		  //     	data['param'] = { 
		  //     		"IsActive": $('#isactive').val()
	   //    		};
		      	//console.log(data);
		    },
		    "columns": [
		    	{ "data": "ReportId" },
		    	{
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		return '<span type="button" id="namereport'+d['ReportId']+'">'+d['ReportName']+'</span><span class="mdl-tooltip" for="namereport'+d['ReportId']+'">'+d['Description']+'</span>';
	            	},
	            	"className": ''
	            },
		    	{
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		return '<a type="button" target="_blank" href="'+d['Path']+'" id="report'+d['ReportId']+'" data-id="'+d['ReportId']+'" class="download-file mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">VIEW</a><div class="mdl-tooltip" for="report'+d['ReportId']+'">'+bytesToSize(d['Size'])+'</div>';
	            	},
	            	"className": ''
	            },
		    	{ "data": "DateCreated" },
		    	{ "data": "CreatedBy" },
	            {
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		var IsActive = '';
	            		console.log(d['IsActive']);
						if(d['IsActive'] == 1){ IsActive = 'checked';}
	            		return '<td class="center">'+
							'<input type="checkbox" class="IsActive filled-in" id="'+d['ReportId']+'" '+IsActive+' data="'+ d['IsActive']+'"/>'+
					     	'<label for="'+d['ReportId']+'"></label>'+
					    '</td>';
	            	},
	            	"className": ''
	            },
	            { 
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		return '<a href="#" class="Edit show-dialog" id="editreport'+d['ReportId']+'" data="'+d['ReportId']+'" data-title="Edit Report" data-url="Report/Update"><i class="material-icons">mode_edit</i></a><div class="mdl-tooltip" for="editreport'+d['ReportId']+'">Edit this document</div>';
	            	}
	            }
	        ],
			"ordering": false,
		    "order": [[ 0, "asc" ]],
			"pageLength": 10,
			"deferRender": true,
			"drawCallback": function(settings, json) {
				addDialog('dialog','.show-dialog');
				// Expand all new MDL elements
      			componentHandler.upgradeDom();
			}
		});



		$('#isactive').change(function() {

			dtTable.draw();

		});

});
