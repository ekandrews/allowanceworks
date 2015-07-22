<div class="login-content">
				<?php echo form_open('', array('class' => 'login-form')); ?>
					<fieldset>
						<legend>Log in</legend>
						<input type="text" name="email" id="email" class="form-input" placeholder="Username" />
						<input type="password" name="password" id="password" class="form-input" placeholder="Password" />
						<input type="submit" class="button submit-button" value="Log In" />
					</fieldset>
				</form>
				<a href="create">Create a new account</a>
			</div>