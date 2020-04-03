$(function() {

    $('#btnSavePackage').click(function(){
        var form = $('#packageForm');
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
                    error('Error on saving Package.');
                }
            });

        }
        else{
        }
    });

    $('#showData').on('click', '.Edit', function(){
        var id = $(this).attr('data');
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: 'Package/get/'+id+'',
            async: false,
            dataType: 'json',
            success: function(response){
                //display the fetch data to form
                var data = (response['data'][0]);
                $('#id').val(data.PackageId); //must have don't erase
                //$('#file').attr("value",data.ReportName); //must have don't erase
                displayInForm(data, '#packageForm');
            },
            error: function(){
                error('Error in displaying Package details.');
            }

        });

    });

    $('#showData').on('click', '.IsActive', function(){
        var checked = $(this).attr('data');
        var id = $(this).attr('id');
        $.ajax({
            type: 'ajax',
            method: 'POST',
            url: 'Package/updateStatus',
            data: {'id':id, 'checked': checked},
            async: false,
            dataType: 'json',
            success: function(response){
                if(response.success){
                    reload('table');
                    success('Package status is successfully changed.');
                }
                else{
                    if(response.message != false){
                        reload('table');
                        error(response.message);
                    }else{
                        error('Error on chaging Package status.');
                    }
                }
            },
            error: function(){
                error('Error on chaging Package status.');
            }

        });

    });

    $('#showData').on('click', '.upload', function(){
        var imageid = $(this).attr('data');
        
        $('#imageid').val(imageid);
    });

    $('#btnSaveImage').click(function(){
        var id = $('#imageid').val();
        var data = new FormData($('#imageForm')[0]);
        data.append('imageid', id);
        $.ajax({
            type: 'ajax',
            method: 'POST',
            fileElementId:'file',
            url: 'Package/Upload',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response){
                if(response.success){
                    reload('table');
                    success('successfully uploaded!');
                    $('.close').trigger('click');
                }
                else{
                    error(response.error);
                }
            },
            error: function(){
                warning('Please refresh and check if the image was uploaded');
            }
        });
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
            url:'Package/getListJson',
            type: 'POST'
        },
        "fnServerParams": function ( aoData ) {
            var data = aoData;
            data['param'] = { 
            "IsActive": $('#isactive').val()
            };
              //console.log(data);
        },
        "columns": [
            // {
            //     "mdata": null,
            //     "mRender": function(data,type,d){
            //         if (d['Path'] == "") 
            //         {
            //             return '<a href="#" class="upload show-upload-dialog" id="editPackageimage'+d['PackageId']+'" data="'+d['PackageId']+'" data-title="Upload Image" data-url="Package/Upload"><i class=" mdl-color-text--blue-grey-500 material-icons pointer" role="presentation">broken_image</i></a><div class="mdl-tooltip" for="editPackageimage'+d['PackageId']+'">Upload Image</div>';
            //         }
            //         else{
            //             return '<a href="#" class="upload show-upload-dialog" id="editPackageimage'+d['PackageId']+'" data="'+d['PackageId']+'" data-title="Upload Image" data-url="Package/Upload"><img class="small-img pointer" src="'+d['Path']+'"></a><div class="mdl-tooltip" for="editPackageimage'+d['PackageId']+'">Upload Image</div>';
                        
            //         }
            //     },
            //     "className": ''
            // },
            { "data": "PackageName" },
            { 
                "mdata": null,
                "mRender": function(data,type,d){
                    return d['MVP'] + ' pts';
                }
            },
            { 
                "mdata": null,
                "mRender": function(data,type,d){
                    return money(d['Cost']);
                }
            },
            { 
                "mdata": null,
                "mRender": function(data,type,d){
                    return money(d['MaxProfitSharing']);
                }
            },
            { 
                "mdata": null,
                "mRender": function(data,type,d){
                    return money(d['MaxProfitSharingWeekly']);
                }
            },
            { 
                "mdata": null,
                "mRender": function(data,type,d){
                    return money(d['DirectSalesBonus']);
                }
            },
            { 
                "mdata": null,
                "mRender": function(data,type,d){
                    return money(d['MatchSalesBonus']);
                }
            },
            { 
                "mdata": null,
                "mRender": function(data,type,d){
                    return money(d['MatchSalesBonusDailyIncome']);
                }
            },
            // {
            //     "mdata": null,
            //     "mRender": function(data,type,d){
            //         var IsActive = '';
            //         if(d['IsActive'] == 1){ IsActive = 'checked';}
            //         return '<td class="center">'+
            //             '<input type="checkbox" class="IsActive filled-in" id="'+d['PackageId']+'" '+IsActive+' data="'+ d['IsActive']+'"/>'+
            //              '<label for="'+d['PackageId']+'"></label>'+
            //         '</td>';
            //     },
            //     "className": ''
            // },
            { 
                "mdata": null,
                "mRender": function(data,type,d){
                    return '<a href="#" class="Edit show-dialog" id="editPackage'+d['PackageId']+'" data="'+d['PackageId']+'" data-title="Edit Package" data-url="Package/Update"><i class="material-icons">mode_edit</i></a><div class="mdl-tooltip" for="editPackage'+d['PackageId']+'">Edit this Package</div>';
                }
            }
        ],
        "ordering": false,
        "order": [[ 0, "asc" ]],
        "pageLength": 10,
        "deferRender": true,
        "drawCallback": function(settings, json) {
            addDialog('dialog','.show-dialog');
            //addDialog('#upload-dialog','.show-upload-dialog');
            // Expand all new MDL elements
              componentHandler.upgradeDom();
        }
    });



    $('#isactive').change(function() {

        dtTable.draw();

    });

});
