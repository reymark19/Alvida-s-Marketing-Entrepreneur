<main class="mdl-layout__content mdl-color--grey-100">
	<div class="mdl-grid demo-content">
		<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
			<div class="demo-charts mdl-color--white mdl-cell mdl-cell--12-col mdl-grid">
				<button id="btnForProfitShare" type="button" class="show-dialog mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" data-title="Add Profit Share" data-url="<?php echo base_url() ?>ProfitShare/Insert">Add Profit Share</button>
				<div class="mdl-tooltip" for="btnForProfitShare">
					Create a Profit Share
				</div>
				<dialog class="mdl-dialog">
					<h4 class="mdl-dialog__title modal-title">Create Profit Share</h4>
					<div class="mdl-dialog__content">
						<form action="<?php echo base_url() ?>ProfitShare/distribute" id="profitShareForm">
							<input class="hide mdl-textfield__input" type="text" id="id" name="id">
							<input class="hide mdl-textfield__input" type="text" id="isadmin" name="isadmin" value="1">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		                        <input class="mdl-textfield__input" type="text" id="share" name="share" min="1" maxlength="60" required>
		                        <label class="mdl-textfield__label" for="share">Profit Share</label>
		                    </div>
						</form>
					</div>
					<div class="mdl-dialog__actions">
						<button type="button" class="mdl-button close">Cancel</button>
						<button type="button" class="mdl-button" id="btnSaveProfitShare">Save</button>
					</div>
				</dialog>
				<dialog class="mdl-dialog distribute-dialog">
					<h4 class="mdl-dialog__title modal-title">Distribute Profit Share</h4>
					<div class="mdl-dialog__content">
						<form action="#" id="distributeprofitShareForm">
							<input class="hide mdl-textfield__input" type="text" id="idps" name="idps">
						</form>

						<div class="text-center">
							<span id="earneachmember" class="hide"></span>
							<span id="earneachmember2"></span>/share<br>
							<span id="donedistribute">0</span>/<span id="maxmembers">0</span> accounts
							<br>
							<br>
							<div id="p1" class="mdl-progress mdl-js-progress"></div>
							<ul id="members" class="hide">
								
							</ul>
						</div>
					</div>
					<div class="mdl-dialog__actions">
						<button type="button" class="mdl-button close">Cancel</button>
						<button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect" id="btnDistributeProfitShare">Distribute</button>
					</div>
				</dialog>

			</div>
			<!-- <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select width-auto margin-left-15">
				<input type="text" value="" class="mdl-textfield__input" id="isused" readonly>
				<input type="hidden" value="" name="isused">
				<i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
				<label for="isused" class="mdl-textfield__label">Filter</label>
				<ul for="isused" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
					<li class="mdl-menu__item" data-val="" data-selected="true">All</li>
					<li class="mdl-menu__item" data-val="Used">Used</li>
					<li class="mdl-menu__item" data-val="Not Used">Not Used</li>
				</ul>
			</div> -->
			<table id="table" class="mdl-data-table unnowrap dataTable" cellspacing="0" width="100%" style="">
				<thead>
					<tr>
						<th>SHARE</th>
						<th>EACH</th>
						<th>MEMBERS</th>
						<th>DATE CREATED</th>
						<th>DATE POSTED</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="showData">
				</tbody>
			</table>

		</div>
	</div>
</main>

<script src="<?php echo base_url() ?>js/ProfitShare/index.js"></script>