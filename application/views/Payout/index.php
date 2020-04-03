<main class="mdl-layout__content mdl-color--grey-100">
	<div class="mdl-grid demo-content">
		<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
			<div class="demo-charts mdl-color--white mdl-cell mdl-cell--12-col mdl-grid">
				<dialog class="mdl-dialog">
					<h4 class="mdl-dialog__title modal-title">Add Message</h4>
					<div class="mdl-dialog__content">
						<form action="<?php echo base_url() ?>Payout/insert" id="payoutForm">
							<input class="hide mdl-textfield__input" type="text" id="id" name="id">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		                        <input class="mdl-textfield__input" type="text" id="message" name="message" maxlength="60" required>
		                        <label class="mdl-textfield__label" for="message">Message</label>
		                    </div>
						</form>
					</div>
					<div class="mdl-dialog__actions">
						<button type="button" class="mdl-button close">Cancel</button>
						<button type="button" class="mdl-button" id="btnSavePayout">Save</button>
					</div>
				</dialog>

				<dialog class="mdl-dialog dialog-approved">
					<h4 class="mdl-dialog__title modal-title">Approve?</h4>
					<div class="mdl-dialog__actions">
						<button type="button" class="mdl-button close">Cancel</button>
						<button type="button" class="mdl-button" id="btnSetApproved">Approve</button>
					</div>
				</dialog>

				<dialog class="mdl-dialog dialog-deleted">
					<h4 class="mdl-dialog__title modal-title">Are you sure to delete this?</h4>
					<form></form>
					<div class="mdl-dialog__actions">
						<button type="button" class="mdl-button close">Cancel</button>
						<button type="button" class="mdl-button" id="btnDeleted">Delete</button>
					</div>
				</dialog>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select width-auto margin-left-15">
				<input type="text" value="" class="mdl-textfield__input" id="isapproved" readonly>
				<input type="hidden" value="" name="isapproved">
				<i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
				<label for="isapproved" class="mdl-textfield__label">Filter</label>
				<ul for="isapproved" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
					<li class="mdl-menu__item" data-val="" data-selected="true">All</li>
					<li class="mdl-menu__item" data-val="Approved">Approved</li>
					<li class="mdl-menu__item" data-val="Not Approved">Not Approved</li>
				</ul>
			</div>
			<table id="table" class="mdl-data-table unnowrap dataTable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>FULLNAME</th>
						<th>AMOUNT</th>
						<th>TYPE</th>
						<th>ACCOUNT NUMBER</th>
						<th>ACCOUNT NAME</th>
						<th>ADDRESS</th>
						<th>CONTACT</th>
						<th>EMAIL</th>
						<th>MESSAGE</th>
						<th>DATE CREATED</th>
						<th>DATE APPROVED</th>
						<th>A</th>
						<th>D</th>
						<th>E</th>
					</tr>
				</thead>
				<tbody id="showData">
				</tbody>
			</table>

		</div>
	</div>
</main>

<script src="<?php echo base_url() ?>js/Payout/index.js"></script>