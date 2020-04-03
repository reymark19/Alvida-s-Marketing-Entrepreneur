<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-grid demo-content">
  <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
  	<div class="demo-charts mdl-color--white mdl-cell mdl-cell--12-col mdl-grid">
  		<button id="mytooltip" type="button" class="show-dialog mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" data-title="Add Package" data-url="<?php echo base_url() ?>Package/Insert">Add Package</button>

    <div class="mdl-tooltip" for="mytooltip">
   Create a new package
    </div>
		<dialog class="mdl-dialog">
		<h4 class="mdl-dialog__title modal-title"></h4>
			<div class="mdl-dialog__content">
				<form action="#" id="packageForm">
                    <input class="hide mdl-textfield__input" type="text" id="id" name="id">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="packagename" name="packagename" maxlength="60" required>
                        <label class="mdl-textfield__label" for="packagename">Package Name</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" id="mvp" name="mvp" required>
                        <label class="mdl-textfield__label" for="mvp">MVP</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" id="cost" name="cost" required>
                        <label class="mdl-textfield__label" for="cost">Cost</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" id="maxprofitsharing" name="maxprofitsharing" required>
                        <label class="mdl-textfield__label" for="maxprofitsharing">Max Profit Sharing</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" id="maxprofitsharingweekly" name="maxprofitsharingweekly" required>
                        <label class="mdl-textfield__label" for="maxprofitsharingweekly">Max Profit Sharing Bi-Weekly</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" id="directsalesbonus" name="directsalesbonus" required>
                        <label class="mdl-textfield__label" for="directsalesbonus">Direct Sales Bonus</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" id="matchsalesbonus" name="matchsalesbonus" required>
                        <label class="mdl-textfield__label" for="matchsalesbonus">Match Sales Bonus</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" id="matchsalesbonusdailyincome" name="matchsalesbonusdailyincome" required>
                        <label class="mdl-textfield__label" for="matchsalesbonusdailyincome">Match Sales Bonus Daily Income</label>
                    </div>
				
				</form>
			</div>
			<div class="mdl-dialog__actions">
			  <button type="button" class="mdl-button close">Cancel</button>
			  <button type="button" class="mdl-button" id="btnSavePackage">Save</button>
			</div>
		</dialog>
      </div>
      
  	<!-- <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select width-auto margin-left-15">
        <input type="text" value="" class="mdl-textfield__input" id="isactive" readonly>
        <input type="hidden" value="" name="isactive">
        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
        <label for="isactive" class="mdl-textfield__label">Filter</label>
        <ul for="isactive" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
            <li class="mdl-menu__item" data-val="" data-selected="true">All</li>
            <li class="mdl-menu__item" data-val="active">Active</li>
            <li class="mdl-menu__item" data-val="notactive">Not Active</li>
        </ul>
    </div> -->

	<table id="table" class="mdl-data-table unnowrap dataTable" cellspacing="0" width="100%" style="">
		<thead>
			<tr>
				<th>NAME</th>
				<th>MVP</th>
				<th>COST</th>
				<th>MPS</th>
				<th>MPSW</th>
				<th>DSB</th>
				<th>MSB</th>
                <th>MSBDI</th>
                <th></th>
			</tr>
		</thead>
		<tbody id="showData">
		</tbody>
	</table>

  </div>
</div>
</main>

<script src="<?php echo base_url() ?>js/Package/index.js"></script>