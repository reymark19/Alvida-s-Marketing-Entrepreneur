

<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-grid demo-content">
  <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
  	<div class="demo-charts mdl-color--white mdl-cell mdl-cell--12-col mdl-grid">
  		<button id="mytooltip" type="button" class="show-dialog mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" data-title="Add Report" data-url="<?php echo base_url() ?>Report/Insert">Add Report</button>

    <div class="mdl-tooltip" for="mytooltip">
   Create a new document
    </div>
		<dialog class="mdl-dialog">
		<h4 class="mdl-dialog__title modal-title">Create Report</h4>
			<div class="mdl-dialog__content">
				<form action="#" id="reportForm">
					<input class="hide mdl-textfield__input" type="text" id="id" name="id">
				  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				    <input class="mdl-textfield__input" type="text" id="reportname" name="reportname" pattern="[A-Z,a-z,0-9, ]*" maxlength="60" required="">
				    <label class="mdl-textfield__label" for="reportname">Report Name</label>
				    <span class="mdl-textfield__error">Letters, numbers and spaces only</span>
				  </div>
				  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				    <input class="mdl-textfield__input" type="text" id="description" name="description" pattern="[A-Z,a-z,0-9, ]*" required="">
				    <label class="mdl-textfield__label" for="description">Description</label>
				    <span class="mdl-textfield__error">alphanumeric characters only</span>
				  </div>
				  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				  	<input id="file" name="file" type="file" onchange="readURL(this)" data-show-preview="false">
				    <span class="mdl-textfield__error">Required</span>
				  </div>
				</form>
			</div>
			<div class="mdl-dialog__actions">
			  <button type="button" class="mdl-button close">Cancel</button>
			  <button type="button" class="mdl-button" id="btnSaveReport">Save</button>
			</div>
		</dialog>
		
  	</div>

	<table id="table" class="mdl-data-table unnowrap dataTable" cellspacing="0" width="100%" style="">
		<thead>
			<tr>
				<th>ID</th>
				<th>NAME</th>
				<th>FILE/SIZE</th>
				<th>DATE CREATED</th>
				<th>CREATED BY</th>
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

<script src="<?php echo base_url() ?>js/Report/index.js"></script>