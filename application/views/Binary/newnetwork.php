
    <?php 
    $otherAccountId = null;

     ?>

    <link rel="stylesheet" href="<?php echo base_url('assets/lib/treant-js-master/vendor/perfect-scrollbar/perfect-scrollbar.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/treant-js-master/Treant.css') ?>">
	<script src="<?php echo base_url('assets/lib/treant-js-master/vendor/raphael.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/treant-js-master/Treant.js'); ?>"></script>
	<!-- <script src="<?php echo base_url('assets/lib/treant-js-master/vendor/jquery.min.js'); ?>"></script> -->
	<script src="<?php echo base_url('assets/lib/treant-js-master/vendor/jquery.easing.js'); ?>"></script>

	<style type="text/css">
		.node img{
			width: 64px;
		    border-radius: 50px;
		}
		.Treant {
			margin: auto;
		}

		.Treant .collapse-switch {
		    width: 100%;
		    height: 55%;
		    border: none;
		}
		.Treant .collapse-switch {
		    display: block;
		    position: absolute;
		    top: 1px;
		    right: 1px;
		    cursor: pointer;
            z-index: 1;
		}
		.Treant .collapsed .collapse-switch {
            background-color: transparent;
        }
        .Treant .node.collapsed {
            /*border: 3px solid #3F51B5;
            border-radius: 40px;*/
        }
        .mdl-card__actions.mdl-card--border.text-grey.text-center {
            padding: 0px;
        }

.collapse-switch:hover {
	color: rgb(255,64,129) !important;
}
	</style>

    <style>
.tree-card-square.mdl-card {
    width: 115px;
    height: 115px;
    min-height: 115px;
    z-index: unset;
}
.tree-card-square > .mdl-card__title {
  color: #fff;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    padding: 0px;
}
.mdl-card__actions.mdl-card--border.text-grey {
    color: #607D8B;
}
.mdl-card__title-text.tree-title {
    font-size: 9px;
    margin: 0px;
    background-color: #000000b3;
    display: block;
    text-align: center;
    width: 100%;
}

</style>
    <div class="android-be-together-section mdl-typography--text-center">
    <div class="logo-font android-slogan">Your Binary</div>
    <div class="logo-font android-sub-slogan">Note: You can earn thru matching</div>
    <br>
    <br>
    </div>
	<div class="chart" id="collapsable-example">
     
    </div>


      <dialog class="mdl-dialog dialog-assign-member" style="width: 400px;">
        <h4 class="mdl-dialog__title modal-title">Assign Member</h4>
          <div class="mdl-dialog__content">
            <form action="<?php echo base_url() ?>Binary/update" id="assignNewMemberForm">
              <input type="text" name="token" id="token" class="hide" value="<?php echo $_SESSION['token'] ?>">
              
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select width-auto margin-left-15" style="width: 85%;">
                    <input type="text" value="" class="mdl-textfield__input" id="member" readonly>
                    <input type="hidden" value="" name="member">
                    <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                    <label for="member" class="mdl-textfield__label">New members</label>
                    <ul for="member" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                        <?php if ($newmembers != false): ?>
                            <?php foreach ($newmembers as $m): ?>
                                <li class="mdl-menu__item" style="text-transform: uppercase;font-size: 12px;" data-val="<?php echo $m['NetworkId'] ?>"><?php echo $m['Fullname'] ?></li>
                            <?php endforeach ?>
                        <?php endif ?>
                    </ul>
                </div>
                <br>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select width-auto margin-left-15" style="width: 85%;">
                    <input type="text" value="" class="mdl-textfield__input" id="position" readonly>
                    <input type="hidden" value="" name="position">
                    <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                    <label for="position" class="mdl-textfield__label">Position</label>
                    <ul for="position" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                        <li class="mdl-menu__item" style="font-size: 12px;" data-val="1" data-selected="true">Right</li>
                        <li class="mdl-menu__item" style="font-size: 12px;" data-val="2">Left</li>
                    </ul>
                </div>

            </form>
          </div>
          <div class="mdl-dialog__actions">
            <button type="button" class="mdl-button close">Cancel</button>
            <button type="button" class="mdl-button" id="btnAssignNewMember">Assign</button>
          </div>
        </dialog>


	<script>
    var config = {
        container: "#collapsable-example",
        
        node: {
            collapsable: true
        },
        animation: {
            nodeAnimation: "easeOut",
            nodeSpeed: 200,
            connectorsAnimation: "easein",
            connectorsSpeed: 200
        }
    },
        
    <?php if ($network != false) { $i = 1 ?>
        <?php foreach ($network as $net): ?>
            <?php echo $net['AccountName']; ?> = {
                image: "<?php echo $net['Picture'] ?>",
                text: {'data-accountname': "<?php echo $net['AccountName']; ?>"},
                <?php if (count($network) == 1 || $i == 1): ?>
                    <?php 
                    $i++; 
                    $otherAccountId = $net['AccountId']; 

                 ?>
                 <?php else: ?>
                     parent: <?php echo $net['ParentName'] ?>
                 <?php endif ?>
            },
        <?php endforeach ?>

        chart_config = [
            config,
         <?php foreach ($network as $net): ?>
            <?php echo $net['AccountName'] ?>,
        <?php endforeach ?>
        ];
    <?php } ?>

var otree = new Treant( chart_config );

$('.node').each(function(){
    // $(this).clicked();
    // $(this).addClass('collapsed');
});

setTimeout(function(){ 
    $.ajax({
        type: 'ajax',
        method: 'POST',
        url: "<?php echo base_url() ?>binary/getnetworklist/<?php echo $otherAccountId ?>",
        data: {
            'token' : '<?php echo $_SESSION['token']; ?>',
        },
        dataType: 'json',
        success: function(response){
            var networkData = response;
            var network = [];
            var acc = {};
            var rootaccount = '<?php echo $accountname ?>';
            for (var i = 0; i <= networkData.length - 1; i++) {

                acc = networkData[i];
                accountname = networkData[i].AccountName;
                
                $('.node[data-accountname='+accountname+']').find('.tree-title').text(networkData[i].AccountName);

                if (networkData[i].PackageId == 1) {
                    ApplyCss(accountname, '#607d8b', '#fff');
                }
                else if (networkData[i].PackageId == 2) {
                    ApplyCss(accountname, '#795548', '#fff');
                }
                else if (networkData[i].PackageId == 3) {
                    ApplyCss(accountname, '#E5E4E2', '#464646');
                }
                else if (networkData[i].PackageId == 4) {
                    ApplyCss(accountname, '#9e9e9e', '#fff');
                }
                else if (networkData[i].PackageId == 5) {
                    ApplyCss(accountname, '#E0115F', '#fff');
                }
                else if (networkData[i].PackageId == 6) {
                    ApplyCss(accountname, '#ff00ff', '#fff');
                }
                else if (networkData[i].PackageId == 7) {
                    ApplyCss(accountname, '#b9f2ff', '#4a626f');
                }
                var newURL = window.location.protocol + "//" + window.location.host + '/Binary/Network/' + rootaccount + '/' + networkData[i].AccountName;
                var pos = "";
                if (networkData[i].Position == 1) {
                    pos = "R";
                }
                else if (networkData[i].Position == 2) {
                    pos = "L";
                }
                $('.node[data-accountname='+accountname+']').find('[id=treeAdd'+accountname+']').attr('url', '<?php echo base_url() ?>binary/update/'+networkData[i].AccountId);
                $('.node[data-accountname='+accountname+']').find('#treeView'+accountname).attr('href', newURL);
                $('.node[data-accountname='+accountname+']').find('[for=tree'+accountname+']').html(pos + ' - ' + networkData[i].Fullname + ' <br /> ' + networkData[i].PackageName);
                
            }

            //delete all assign icon if no new members to be added
            if (<?php echo $membersCnt ?> == 0) 
            {
                $('.assignNewMember').remove();
            }


        },
        error: function(e){
          error(e);
          console.log(e);
        }
    });
}, 250);

function ApplyCss(accountname, color, textcolor){
    $('.node[data-accountname='+accountname+']').find('[id=tree'+accountname+']').parent().css('color', '#fff');
    $('.node[data-accountname='+accountname+']').find('[id=tree'+accountname+']').parent().css('background-color', color);
    $('.node[data-accountname='+accountname+']').find('[id=tree'+accountname+']').parent().parent().find('h6').css('background-color', color);
    $('.node[data-accountname='+accountname+']').find('[id=tree'+accountname+']').parent().parent().find('h6').css('color', textcolor);
}

setTimeout(function(){
  addDialog('.dialog-assign-member','.assignNewMember');
},500);

$('.assignNewMember').click(function(){
    

    $('.dialog-assign-member').find('form').attr('action',$(this).attr('url'));
});


    $('#btnAssignNewMember').click(function(){
        var form = $('#assignNewMemberForm');
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
                success('Successfully Added!');
                $('.close').trigger('click');

                setTimeout("location.reload(true);",1000);
              }
              else{
                error(response.message);
              }
            },
            error: function(){
              error('Error!');
            }
          });

        }
        else{
        }

      });

</script>

