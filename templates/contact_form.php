<form id="contactForm" class="form-horizontal">
	<legend>Contact Info</legend>
</form>
	<div class="row contact-form-header">
		<div class="span2">Contact Date</div>
		<div class="span2">Type</div>
		<div class="span6">Summary</div>
		<div class="span2">Added by</div>
	</div>
	<?php
		function contact_form_edit_html ($contact) {
			return 
				"
				<form id='EditContact".$contact['ContactID']."' class='contact-edit-form form-horizontal' hidden>
					<div class='row contact-edit-row'>
						<div class='row'>
							<div class='span6'>
								<div class='control-group'>
									<label class='control-label'>Date: </label>
									<div class='controls'>
										<input type='text' name='ContactDate' value='" . $contact["ContactDate"] ."' />
									</div>
								</div>
								<div class='control-group'>
									<label class='control-label'>Type: </label>
									<div class='controls'>
										<select name='ContactType' >
											". htmlOptions(array("Called, helped by phone", "Added Client"), $contact["ContactType"]) ."
										</select>
									</div>
								</div>
							</div>
							<div class='span6'>
								<textarea class='field span5' rows='6' name='ContactSummary'>".$contact["ContactSummary"]."</textarea>
							</div>
						</div>
						<br />
						<div class='row'>
							<button type='button' id='contact-edit-row-update". $contact["ContactID"] ."' class='btn' onclick='updateContact(".$contact['ContactID'].")'>Update</button>
							<button type='button' id='contact-edit-row-undo" .$contact["ContactID"] ."' class='btn' onclick='undoContact(".$contact['ContactID'].")'>Undo</button>
						</div> 			
					</div>
				</form>
				";  
		}
	?>
	<div class='row contact-form-new' onclick="newContact()" data-title="Add New Contact" data-content="<?php echo random_quote()?>">Add New</div>
	<?php
		foreach($contacts as $contact) {
			echo 
			"<div id='Contact".$contact['ContactID']."' class='row contact-form-row'" . 
					"data-title='Last Edit' 
					data-content='". $contact["UserName"]["Edit"] 
					." on " .$contact["ContactEditDate"] ."'> 
				<div class='span2'>
					". $contact['ContactDate'] ."
				</div>
				<div class='span2'>
					". $contact['ContactType'] ."
				</div>
				<div class='span6 contact-form-summary'>
					". $contact['ContactSummary'] ."
				</div>
				<div class='span2'>
					". $contact["UserName"]["Added"] ."
				</div>
			</div><br />" . contact_form_edit_html($contact); 
		}

	?>
<script>	
	/* LAST EDITED POPOVER */
	// for last edit popovers
	$(function() {
		$(".contact-form-row").popover({trigger: 'hover'}); 
	}); 
	
	$(function() {
		$(".contact-form-new").popover({trigger: 'hover'}); 
	}); 
	
</script>

<script>
	/* EDIT ROW */
	$(".contact-edit-form").hide(); 
	
	function toggle_edit() {
		$(this).hide(); 
		var id = $(this).attr("id"); 
		var selector = "#Edit" + id; 
		$(selector).show(); 
	}

	$(".contact-form-row").bind("click", toggle_edit); 	
	
	// ================================ //
	function undoContact (id) {
		document.getElementById("EditContact" + id).reset(); 
		$("#EditContact" + id).hide(); 		
		$("#Contact" + id).show(); 
	}

	function updateContact() {
	}	
</script>
<br />
<br />
<?php
?>	