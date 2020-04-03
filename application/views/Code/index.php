<main class="mdl-layout__content mdl-color--grey-100">
	<div class="mdl-grid demo-content">
		<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
			<div class="demo-charts mdl-color--white mdl-cell mdl-cell--12-col mdl-grid">
				<button id="btnForSaveCode" type="button" class="show-dialog mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" data-title="Add Code" data-url="<?php echo base_url() ?>Code/Insert">Add Code</button>
				<div class="mdl-tooltip" for="btnForSaveCode">
					Create a Codes
				</div>
				<dialog class="mdl-dialog">
					<h4 class="mdl-dialog__title modal-title">Create Codes</h4>
					<div class="mdl-dialog__content">
						<form action="#" id="codeForm">
							<input class="hide mdl-textfield__input" type="text" id="id" name="id">
							<input class="hide mdl-textfield__input" type="text" id="isadmin" name="isadmin" value="1">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
								<input type="text" value="" class="mdl-textfield__input" id="packagename" readonly>
								<input type="hidden" value="" name="packagename" required="" minlength="1">
								<label for="packagename" class="mdl-textfield__label">Package</label>
								<ul for="packagename" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
									<?php foreach ($packages as $package) { ?>
										<li class="mdl-menu__item" data-val="<?php echo $package['PackageName'] ?>"><?php echo $package['PackageName'] ?></li>
									<?php } ?>
								</ul>
							</div>
						</form>
					</div>
					<div class="mdl-dialog__actions">
						<button type="button" class="mdl-button close">Cancel</button>
						<button type="button" class="mdl-button" id="btnSaveCode">Save</button>
					</div>
				</dialog>

			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select width-auto margin-left-15">
				<input type="text" value="" class="mdl-textfield__input" id="isused" readonly>
				<input type="hidden" value="" name="isused">
				<i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
				<label for="isused" class="mdl-textfield__label">Filter</label>
				<ul for="isused" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
					<li class="mdl-menu__item" data-val="" data-selected="true">All</li>
					<li class="mdl-menu__item" data-val="Used">Used</li>
					<li class="mdl-menu__item" data-val="Not Used">Not Used</li>
				</ul>
			</div>
			<table id="table" class="mdl-data-table unnowrap dataTable" cellspacing="0" width="100%" style="">
				<thead>
					<tr>
						<th>ID</th>
						<th>CODE</th>
						<th>PACKAGE</th>
						<th>IS USED</th>
						<th>IS ACTIVE?</th>
						<th>EDIT</th>
					</tr>
				</thead>
				<tbody id="showData">
				</tbody>
			</table>

		</div>
	</div>
</main>

<script src="<?php echo base_url() ?>js/Code/index.js"></script>