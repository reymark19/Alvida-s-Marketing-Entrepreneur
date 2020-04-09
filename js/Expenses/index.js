$(function(){

	$('#btnSaveExpenses').click(function(){
		var form = $('#expensesForm');
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
					error('Error on saving Expense.');
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
			url:'Expenses/getCompanyExpensesList',
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
	    	{ "data": "LedgerId" },
	    	{ 
            	"mdata": null,
            	"mRender": function(data,type,d){
            		return money(d['Debit']);
            	}
            },
			{ "data": "Description" },
			{ "data": "DateCreated" }
        ],
		"ordering": false,
	    "order": [[ 0, "asc" ]],
		"pageLength": 10,
		"deferRender": true,
		"drawCallback": function(settings, json) {
			addDialog('dialog','.show-dialog');
		}
	});

});