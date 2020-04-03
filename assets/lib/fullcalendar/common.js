$(document).ready(function() {
		


		var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next',
				center: 'title',
				right: 'today'
			},
			editable: true, //Determines whether the events on the calendar can be modified.
			droppable: true, // this allows things to be dropped onto the calendar
			eventDurationEditable: true, //Allow events' durations to be editable through resizing.
			displayEventTime: true,
			eventRender: function(event, element) {
		        element.attr("address",event.address)
		    },
			drop: function(event, delta ,revertFunc, resourceId) {
		        $(this).parent().parent().remove(); //will remove in pending services area
		        //console.log($(this).text());
		        $('#serviceid').val($(this).attr('data-serviceid'));
		        $('#customerid').val($(this).attr('data-customerid'));
		        $('#dateschedule').val(event.format());
		        $('#datescheduleend').val(event.format());
		        $('#address').val($(this).attr('data-address'));
		        $('#modalCreateSchedule').modal('open');
		        
		        $('#btnCancel').click(function(){
			        $('#calendar').fullCalendar('removeEvents');
			        $('#calendar').fullCalendar('refetchEvents');
			        $('#table').DataTable().draw();
		        });
			},
			eventClick: function(calEvent, jsEvent, view) {
		        console.log('Event: ' + calEvent.resourceId + ' address: ' + calEvent.address);
		        //console.log('View: ' + calEvent.title);
		        $('#map').hide();
		        var end = calEvent.end.format();
		        var start = calEvent.start.format();
		        end = end.substring(0,10);
		        start = start.substring(0,10);
		        address = calEvent.address;
		        $('#modalCreateSchedule').modal('open');
		        $('#dateschedule').val(start);
		        $('#datescheduleend').val(end);
		        $('#pac-input').val(address);


		        //Generate existing Staff assigned
		        $("#scheduleId").val(calEvent.resourceId);
		        $.ajax({
					type: 'ajax',
					method: 'POST',
					url: './scheduler/getScheduleStaffListJson',
					data: {scheduleId: calEvent.resourceId},
					async: false,
					dataType: 'json',
					success: function(response){
						var data = response.data;
						//display info in order info
						$('#staffs').html('');
						if(data.length > 0){
							$('#staffs').append('<li>Assigned Technical Staff List:</li>');
						}
						else{
							$('#staffs').append('<li> <i>No Technical staff Assigned in this Schedule</i></li>');
						}
						for (var i = data.length - 1; i >= 0; i--) {
							$('#staffs').append('<li> <i>'+data[i].tag+'</i></li>');
						};

				        //validate staff
				        $("#dateschedule").trigger('focusout');
				        
						$('.chips-initial').material_chip({
						    data: data
						});
					},
					error: function(){
						Materialize.toast('Error', 3000, 'rounded red');
					}
				});
		        //To dispay Order Info when clicking an Event
				$.ajax({
					type: 'ajax',
					method: 'POST',
					url: './scheduler/getOrderInfo',
					data: {scheduleId: calEvent.resourceId},
					async: false,
					dataType: 'json',
					success: function(response){
						var data = response.data;
						var info = response.data[0];
						$('#TransactionId').text(info.OrderId);
						$('#ServiceId').text(info.ServiceId);
						$('#CustomerName').text(info.CustomerName);
						$('#Address').text(info.Address);
						$('#products').html('');
						$('#products').append('<li>Ordered Products:</li>');
						$('#timestart').val(info.TimeStart);
						$('#timeend').val(info.TimeEnd);
						for (var i = data.length - 1; i >= 0; i--) {
							
							$('#products').append('<li> <i>'+data[i].Quantity+'x '+data[i].ProductName+'</i></li>');
						};
					},
					error: function(){
						error('Error, Order info failed');
					}
				});
		    },
			eventDrop: function(event, delta, revertFunc) {
				
		        //console.log(event.title + " was dropped on " + event.start.format());
		        var scheduleId = event.resourceId;
		        var end = event.end;
		        if(event.end != null){
		        	end = event.end.format();
		        }
		        //console.log(event);
		        //console.log(event.resourceId);
		        //console.log(editEventDrop(scheduleId,event.start.format(),end));
		        var isConflict = editEventDrop(scheduleId,event.start.format(),end);
		        //Find all the events that match the criteria
				//console.log(events);
		        //console.log(isConflict);
		        if (!isConflict) {
		            revertFunc();
		        }
		    },
			eventResize: function(event, delta, revertFunc) {
		        var scheduleId = event.resourceId;
		        var end = event.end;
		        if(event.end != null){
		        	end = event.end.format();
		        }
		        //console.log(event);
		        //console.log(event.resourceId);
		        var isConflict = editEventDrop(scheduleId,event.start.format(),end);
		        //console.log(isConflict);
		        if (!isConflict) {
		            revertFunc();
		        }
		    },
		    events: {
		        url: './scheduler/getCalendarListJson',
		        type: 'POST',

		    }
		});

		$('#btnEditSchedule').click(function(){
			//console.log($('.chips-initial').material_chip('data'));
			var dataStaff = {};
			var staffIds = $('.chips-initial').material_chip('data');
			for (var i = staffIds.length - 1; i >= 0; i--) {
				//console.log(staffIds[i].id);
				dataStaff[i] = staffIds[i].id;
			}
			 $.ajax({
				type: 'ajax',
				method: 'POST',
				url: './scheduler/editSchedule',
				data: $('#scheduleForm').serialize() +"&"+ $.param({ 'staff': dataStaff }),
				async: false,
				dataType: 'json',
				success: function(response){
					if(response.success){
						success(response.message);
						$('#modalCreateSchedule').modal('close');
						$('#calendar').fullCalendar('removeEvents');
			        	$('#calendar').fullCalendar('refetchEvents')
					}
					else{
						error(response.message)
					}
				},
				error: function(){
					Materialize.toast('Error', 3000, 'rounded red');
				}
			});
		});		



		function editEventDrop(scheduleId,start,end){
			var msg = false;

			$.ajax({
				type: 'ajax',
				method: 'POST',
				url: './scheduler/edit',
				data: {scheduleId:scheduleId,start:start,end:end},
				async: false,
				dataType: 'json',
				success: function(response){
					if(response.success){
						success(response.message);
						//$('#calendar').fullCalendar('removeEvents');
			        	//$('#calendar').fullCalendar('refetchEvents');
			        	msg = true;
					}
					else{
						error(response.message)
						return false;
					}
				},
				error: function(){
					error('Error');
					//$('#calendar').fullCalendar('removeEvents');
		        	//$('#calendar').fullCalendar('refetchEvents');
					return false;
				}
			});

			return msg;
		}



	});