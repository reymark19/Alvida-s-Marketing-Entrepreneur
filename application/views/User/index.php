

<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-grid demo-content">
  <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
  	<div class="demo-charts mdl-color--white mdl-cell mdl-cell--12-col mdl-grid">
  		<button id="btnForSaveUser" type="button" class="show-dialog mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" data-title="Add User" data-url="<?php echo base_url() ?>User/Insert">Add User</button>
	    <div class="mdl-tooltip" for="btnForSaveUser">
	   Create a new user
	    </div>
		<dialog class="mdl-dialog">
		<h4 class="mdl-dialog__title modal-title">Create User</h4>
			<div class="mdl-dialog__content">
				<form action="#" id="userForm">
					<input class="hide mdl-textfield__input" type="text" id="id" name="id">
					<input class="hide mdl-textfield__input" type="text" id="isadmin" name="isadmin" value="1">
				  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				    <input class="mdl-textfield__input" type="text" id="fullname" name="fullname" pattern="[A-Z,a-z, ]*" maxlength="30" required="">
				    <label class="mdl-textfield__label" for="fullname">Fullname</label>
				    <span class="mdl-textfield__error">Letters and spaces only</span>
				  </div>
				  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				    <input class="mdl-textfield__input" type="text" id="username" name="username" pattern="[A-Z,a-z,0-9]*" minlength="5" required="">
				    <label class="mdl-textfield__label" for="username">Username</label>
				    <span class="mdl-textfield__error">Atlest 5 alphanumeric characters</span>
				  </div>
				  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				    <input class="mdl-textfield__input" type="password" id="password" name="password" pattern="[A-Z,a-z,0-9]*" minlength="5" required="">
				    <label class="mdl-textfield__label" for="password">Password</label>
				    <span class="mdl-textfield__error">Atlest 5 alphanumeric characters</span>
				  </div>
				</form>
			</div>
			<div class="mdl-dialog__actions">
			  <button type="button" class="mdl-button close">Cancel</button>
			  <button type="button" class="mdl-button" id="btnSaveUser">Save</button>
			</div>
		</dialog>
		
  	</div>

	<table id="table" class="mdl-data-table unnowrap dataTable" cellspacing="0" width="100%" style="">
		<thead>
			<tr>
				<th>NAME</th>
				<th>USERNAME</th>
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

<script src="<?php echo base_url() ?>js/User/index.js"></script>