//NINO 080317

//description: to get the dropdown list in easy way

//NEW UPDATE: 080517 Dropdown can be initialize through select using data-dropdown="url"

//NEW UPDATE: 082817 Dropdown can accept parameters using data-dropdown-param="input[id]"

$(function(){

    function dropdown(select,url,p1,p2,p3,id){

        //var select = $(select);

        if($("select[data-dropdown='"+select+"']").attr('data-dropdown') != undefined){

          if($("select[data-dropdown='"+select+"']").attr('data-dropdown') != undefined){

            select = $("select[data-dropdown='"+select+"']");

            //for parameter

            p1 = $("#"+$(select).attr('data-dropdown-p1')).val();

            p2 = $("#"+$(select).attr('data-dropdown-p2')).val();

            p3 = $("#"+$(select).attr('data-dropdown-p3')).val();

            p4 = $("#"+$(select).attr('data-dropdown-p4')).val();

            p5 = $("#"+$(select).attr('data-dropdown-p5')).val();



            url = $('#'+id).attr('data-dropdown');

            var IsUndefined = 0;

            if(url == undefined){

                IsUndefined = 1;

                url =  $(select).attr('data-dropdown');

                //console.log(p1);console.log(p2);console.log(p3);

            }

          }

            console.log('dropdown complete in '+id);

            $.ajax({

             url: url,

             data: {p1:p1,p2:p2,p3:p3,p4:p4,p5:p5},

             dataType: "json",

             success: function(data) {

                //Add for the Dynamic name of the option label

                if(data.length > 0) {

                    //added: 082817 by NINO

                    //Modify to avoid error in dropdown so that it will use for dynamic dropdown

                    //Empty the options to avoid error or duplicate if not it will increment the list

                    if(IsUndefined != 1){

                        $("#"+id).html('');

                        //updated: VINCENT 090517

                        //for select that has default option like Select ***

                        //console.log($('#'+id).attr('data-default'));

                        if($('#'+id).attr('data-default') != undefined && $('#'+id).attr('multiple') == undefined){

                            //$('#'+id).append('<option value="" selected>Select '+$('#'+id).attr('data-default')+'</option>');

                            $('#'+id).append('<option value="">Select '+$('#'+id).attr('data-default')+'</option>');

                        }
                        if($('#'+id).attr('data-default') != undefined && $('#'+id).attr('multiple') != undefined){

                            $('#'+id).append('<option value="" disabled>Select '+$('#'+id).attr('data-default')+'</option>');

                        }

                        //updated: VINCENT 090517

                        //for filtering or dropdown that has all option

                        //NOTE: select tag must have data-all="true" attribute

                        //console.log($('#'+id).attr('data-all'));

                        if ($('#'+id).attr('data-all') == 'true') {

                            $("#"+id+"").append('<option value="" selected>All</option>');

                        }



                        for (var i = 0; i < data.length; i++) {

                            $('#'+id).append('<option value="'+data[i]['key']+'" data-img="'+data[i]['imageUrl']+'" >'+data[i]['label']+'</option>');

                        }

                    }else{

                        $(select).html('');

                        if($(select).attr('data-default') != undefined && $(select).attr('multiple') == undefined){

                            //$(select).append('<option value="" selected>Select '+$(select).attr('data-default')+'</option>');

                            $(select).append('<option value="">Select '+$(select).attr('data-default')+'</option>');

                        }
                        else if($(select).attr('multiple') != undefined){
                            $(select).append('<option value="" disabled>Select '+$(select).attr('data-default')+'</option>');
                        }

                        if ($(select).attr('data-all') == 'true') {

                            $(select).append('<option value="" selected>All</option>');

                        }



                        for (var i = 0; i < data.length; i++) {

                            $(select).append('<option value="'+data[i]['key']+'" data-img="'+data[i]['imageUrl']+'" >'+data[i]['label']+'</option>');

                        }

                    }

                    

                }

                else{

                    if(IsUndefined != 1){

                        $(select).html('');

                        $('#'+id).append('<option value="" disabled selected>No list to be selected</option>');

                    }

                    else{

                        $(select).html('');

                        $(select).append('<option value="" disabled selected>No list to be selected</option>');

                    }

                }

                //VINCENT: refresh the material select

                $('.material-select').material_select('destroy');

                $('.material-select').material_select();

             },

             error: function () {

                //response([]);

             }

         });

        }

        else{

            console.log(select + ' not found');

        }

    }

    //Initialize the dropdown to find all the data-dropdown

    $("select[data-dropdown]").each(function(){

        dropdown($(this).attr('data-dropdown'),null,null,null,null,$(this).attr('id'));

    });



});







    //Added 082817 by NINO

    //Reason add select change to those id that has been used for the parameter 

    //so that it will automatically change if the parameter id that is input was change or modify

    $("select[data-dropdown-p1]").each(function(){

        var p1 = $("#"+$(this).attr('data-dropdown-p1'));

        $(p1).focusout(function(){

            dropdown($("select[data-dropdown-p1]").attr('data-dropdown'),null,null,null,null,$(this).attr('id'));

        });

    });

    $("select[data-dropdown-p2]").each(function(){

        var p2 = $("#"+$(this).attr('data-dropdown-p2'));

        $(p2).focusout(function(){

            dropdown($("select[data-dropdown-p2]").attr('data-dropdown'),null,null,null,null,$(this).attr('id'));

        });

    });

    $("select[data-dropdown-p3]").each(function(){

        var p3 = $("#"+$(this).attr('data-dropdown-p3'));

        $(p3).focusout(function(){

            dropdown($("select[data-dropdown-p3]").attr('data-dropdown'),null,null,null,null,$(this).attr('id'));

        });

    });

    $("select[data-dropdown-p4]").each(function(){

        var p4 = $("#"+$(this).attr('data-dropdown-p4'));

        $(p4).change(function(){

            dropdown($("select[data-dropdown-p4]").attr('data-dropdown'),null,null,null,null,$(this).attr('id'));

        });

    });

    $("select[data-dropdown-p5]").each(function(){

        var p5 = $("#"+$(this).attr('data-dropdown-p5'));

        $(p5).change(function(){

            dropdown($("select[data-dropdown-p5]").attr('data-dropdown'),null,null,null,null,$(this).attr('id'));

        });

    });

        