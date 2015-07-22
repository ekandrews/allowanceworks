<div class="create-account-content">
				<h1 class="page-title">Parent Set-Up</h1>
				<?php echo form_open('create', array('class' => 'create-account-form')) ?>
					<fieldset>
						<legend>Let's start with the basics</legend>
						<input type="text" name="firstname" id="firstname" class="form-input" placeholder="First Name" />
						<input type="text" name="lastname" id="lastname" class="form-input" placeholder="Last Name" />
						<input type="text" name="email" id="email" class="form-input" placeholder="E-Mail Address" />
						<input type="password" name="password" id="password" class="form-input" placeholder="Password" />
						<input type="password" name="password2" id="password2" class="form-input" placeholder="Confirm Password" />
						<?php /*<select name="numchildren" id="numchildren" class="form-input">
							<option value=""># of Children</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
						*/?><input type="submit" class="button submit-button" value="Next" />
					</fieldset>
				</form>
			</div>