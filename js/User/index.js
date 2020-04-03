	$(function() {


		//Editing user details

		$('#showData').on('click', '.Edit', function(){
			var id = $(this).attr('data');
			$('dialog').find('.modal-title').text('Edit User');
			$('#userForm').attr('action','User/update');
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: 'User/get/'+id+'',
				async: false,
				dataType: 'json',
				success: function(response){
					//display the fetch data to form
					var data = (response['data'][0]);
					$('#id').val(data.UserId); //must have don't erase
					displayInForm(data, '#userForm');
				},
				error: function(){
					error('Error in displaying User details.');
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
				url: 'User/updateStatus',
				data: {'id':id, 'checked': checked},
				async: false,
				dataType: 'json',
				success: function(response){
					if(response.success){
						reload('table');
						success('User status is successfully changed.');
					}
					else{
						if(response.message != false){
							reload('table');
							warning(response.message);
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



		//Saving/Updating employee details

		$('#btnSaveUser').click(function(){
			var form = $('#userForm');
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
				url:'User/getListJson',
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
		    	{ "data": "Fullname" },
		    	{ "data": "Username" },
	            {
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		var IsActive = '';
						if(d['IsActive'] == 1){ IsActive = 'checked';}
	            		return '<td class="center">'+
							'<input type="checkbox" class="IsActive filled-in" id="'+d['UserId']+'" '+IsActive+' data="'+ d['IsActive']+'"/>'+
					     	'<label for="'+d['UserId']+'"></label>'+
					    '</td>';
	            	},
	            	"className": ''
	            },
	            { 
	            	"mdata": null,
	            	"mRender": function(data,type,d){
	            		return '<td><a href="#" class="Edit show-dialog" data="'+d['UserId']+'"><i class="material-icons">mode_edit</i></a></td>';
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



		$('#isactive').change(function() {

			dtTable.draw();

		});

});
