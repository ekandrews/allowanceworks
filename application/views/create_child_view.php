
				<?php echo form_open('create_child', array('class' => 'create-account-form', 'id' => 'create-child-form')) ?>
					<fieldset>
						<legend>Let's start with the basics</legend>
						<input type="hidden" name="parent" value="<?php echo($user['user_id']); ?>" />
						<input type="text" name="firstname" id="firstname" class="form-input" placeholder="First Name" />
						<input type="text" name="lastname" id="lastname" class="form-input" placeholder="Last Name" />
						<input type="text" name="email" id="email" class="form-input" placeholder="E-Mail Address/Username" />
						<input type="password" name="password" id="password" class="form-input" placeholder="Password" />
						<input type="password" name="password2" id="password2" class="form-input" placeholder="Confirm Password" />
						<p>Enter Your Birthday</p>
						<?php /*<div class="dob-inputs">
							<input type="text" name="month" id="month" class="form-input dob-input" placeholder="Month" />
							<input type="text" name="date" id="date" class="form-input dob-input" placeholder="Date" />
							<input type="text" name="year" id="year" class="form-input dob-input" placeholder="Year" />
						</div> */?>
						<div class="dob-selects">
							<select name="month" id="month" class="form-input form-select">
								<option>Month</option>
								<?php for ($i = 1; $i < 13; $i++) { echo('<option value="' . $i . '">' . $i . '</option>'); } ?>
							</select>
							<select name="date" id="date" class="form-input form-select">
								<option>Date</option>
								<?php for ($i = 1; $i < 32; $i++) { echo('<option value="' . $i . '">' . $i . '</option>'); } ?>
							</select>
							<select name="year" id="year" class="form-input form-select">
								<option>Year</option>
								<?php for ($i = 1995; $i < 2013; $i++) { echo('<option value="' . $i . '">' . $i . '</option>'); } ?>
							</select>
						</div>
						<a href="#" class="button submit-button child-creator">Create</a>
					</fieldset>
				</form>