					
			<div class="create-account-content">
				<h1 class="page-title">Awesome!</h1>
<?php echo validation_errors(); ?>

<?php echo form_open('userparent/setup', array('class' => 'create-account-form')) ?>

					<fieldset>
						<legend>Please Add Children</legend>
						<input type="hidden" value="<?php echo($user_id); ?>" />
						<input type="text" name="firstname" id="firstname" class="form-input" placeholder="First Name" />
						<input type="text" name="lastname" id="lastname" class="form-input" placeholder="Last Name" />
						<input type="text" name="email" id="email" class="form-input" placeholder="E-Mail Address" />
						<input type="password" name="password" id="password" class="form-input" placeholder="Password" />
						<input type="password" name="password2" id="password2" class="form-input" placeholder="Confirm Password" />
						<select name="month" id="month" class="form-input">
							<option>Month</option>
							<?php for ($i = 1; $i < 13; $i++) { echo('<option value="' . $i . '">' . $i . '</option>'); } ?>
						</select>
						<select name="date" id="date" class="form-input">
							<option>Date</option>
							<?php for ($i = 1; $i < 32; $i++) { echo('<option value="' . $i . '">' . $i . '</option>'); } ?>
						</select>
						<select name="year" id="year" class="form-input">
							<option>Year</option>
							<?php for ($i = 1995; $i < 2013; $i++) { echo('<option value="' . $i . '">' . $i . '</option>'); } ?>
						</select>
						<input type="submit" name="submit" value="Next" />
					</fieldset>

					

</form>
</div>