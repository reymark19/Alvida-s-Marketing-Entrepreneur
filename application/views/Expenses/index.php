
<main class="mdl-layout__content mdl-color--grey-100">
	<div class="mdl-grid demo-content">
		<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
			<div class="demo-charts mdl-color--white mdl-cell mdl-cell--12-col mdl-grid">
				<button id="btnForExpenses" type="button" class="show-dialog mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" data-title="Add Expenses" data-url="<?php echo base_url() ?>Expenses/Insert">Add Expenses</button>
				<div class="mdl-tooltip" for="btnForExpenses">
					Create an Expenses
				</div>
				<dialog class="mdl-dialog">
					<h4 class="mdl-dialog__title modal-title">Create Expenses</h4>
					<div class="mdl-dialog__content">
						<form action="<?php echo base_url() ?>Expenses/insert" id="expensesForm">
							<input class="hide mdl-textfield__input" type="text" id="id" name="id">
							<input class="hide mdl-textfield__input" type="text" id="isadmin" name="isadmin" value="1">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		                        <input class="mdl-textfield__input" type="text" id="description" name="description" maxlength="250" required>
		                        <label class="mdl-textfield__label" for="description">Description</label>
		                    </div>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		                        <input class="mdl-textfield__input" type="text" id="debit" name="debit" min="1" maxlength="60" required>
		                        <label class="mdl-textfield__label" for="debit">Amount</label>
		                    </div>
						</form>
					</div>
					<div class="mdl-dialog__actions">
						<button type="button" class="mdl-button close">Cancel</button>
						<button type="button" class="mdl-button" id="btnSaveExpenses">Save</button>
					</div>
				</dialog>
			</div>
			<table id="table" class="mdl-data-table unnowrap dataTable" cellspacing="0" width="100%" style="">
				<thead>
					<tr>
						<th>ID</th>
						<th>AMOUNT</th>
						<th>DESCRIPTION</th>
						<th>DATE CREATED</th>
					</tr>
				</thead>
				<tbody id="showData">
				</tbody>
			</table>

		</div>
	</div>
</main>

<script src="<?php echo base_url() ?>js/Expenses/index.js"></script>