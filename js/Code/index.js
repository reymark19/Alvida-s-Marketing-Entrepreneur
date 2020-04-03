	$(function() {


		//Editing user details

		$('#showData').on('click', '.Edit', function(){
			var id = $(this).attr('data');
			$('dialog').find('.modal-title').text('Edit Code');
			$('#codeForm').attr('action','Code/update');
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: 'Code/get/'+id+'',
				async: false,
				dataType: 'json',
				success: function(response){
					//display the fetch data to form
					var data = (response['data'][0]);
					$('#id').val(data.CodeId); //must have don't erase
					displayInForm(data, '#codeForm');
				},
				error: function(){
					error('Error in displaying Code details.');
				}

			});

		});



		//Deactivate / activate  user

		$('#showData').on('click', '.IsActive', function(){
			var checked = $(this).attr('data');
			var id = $(this).attr('id');
			$.ajax({
				type: 'ajax',
				method: 'POST',
				url: 'Code/updateStatus',
				data: {'id':id, 'checked': checked},
				async: false,
				dataType: 'json',
				success: function(response){
					if(response.success){
						reload('table');
						success('Code status is successfully changed.');
					}
					else{
						if(response.message != false){
							reload('table');
							warning(response.message);
						}else{
							error('Error on chaging Code status.');
						}
					}
				},
				error: function(){
					error('Error on chaging Code status.');
				}

			});

		});



		//Saving/Updating employee details

		$('#btnSaveCode').click(function(){
			var form = $('#codeForm');
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
							//btn.parent().parent().close();
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



		//Main table

		var dtTable = $('#table').DataTable( {
		    "processing": true,
			"oLanguage": {
				"sProcessing": '<div id="p2" style="width:100%" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>'	
			},
	        "serverSide": true,
			"ajax": 
			{ 
				url:'Code/getListJson',
				type: 'POST'
			},
			"fnServerParams": function ( aoData ) {
				var data = aoData;
		      	data['param'] = { 
		      		"IsUsed": $('#isused').val()
	      		};
		      	//console.log(data);
		    },
		    "columns": [
				{ "data": "CodeId" },
				{ "data": "Code" },
				{ "data": "PackageName" },
		    	{
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		var IsUsed = 'No';
						if(d['IsUsed'] == 1){ IsUsed = 'Yes';}
	            		return '<span>'+IsUsed+'</span>';
	            	},
	            	"className": ''
	            },
	            {
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		var IsActive = '';
						if(d['IsActive'] == 1){ IsActive = 'checked';}
	            		return '<td class="center">'+
							'<input type="checkbox" class="IsActive filled-in" id="'+d['CodeId']+'" '+IsActive+' data="'+ d['IsActive']+'"/>'+
					     	'<label for="'+d['CodeId']+'"></label>'+
					    '</td>';
	            	},
	            	"className": ''
	            },
	            { 
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		return '<td><a href="#" class="Edit show-dialog" data="'+d['CodeId']+'"><i class="material-icons">mode_edit</i></a></td>';
	            	}
	            }
	        ],
			"ordering": false,
		    "order": [[ 0, "asc" ]],
			"pageLength": 10,
			"deferRender": true,
			"drawCallback": function(settings, json) {
				addDialog('dialog','.show-dialog');
			}
		});



		$('#isused').change(function() {

			dtTable.draw();

		});

});
