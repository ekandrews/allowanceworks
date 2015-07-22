			<div class="chores-content"<?php if ($chores) {?> style="display: none;"<?php } ?>>
				<h1 class="page-title">Select Your Chores</h1>
				<?php /*echo form_open('create_child', array('class' => 'chores-form')) */?>
					<fieldset>
						<div class="chore-checkboxes">
						<input type="checkbox" class="chore-checkbox" id="chore-bed" name="chore-bed" />
						<label class="chore-checkbox-label" id="bed" for="chore-bed"><div class="chore-icon"></div><span class="chore-label">Make Bed</span></label>
						<input type="checkbox" class="chore-checkbox" id="chore-dishes" name="chore-dishes" />
						<label class="chore-checkbox-label" id="dishes" for="chore-dishes"><div class="chore-icon"></div><span class="chore-label">Wash the Dishes</span></label>
						<input type="checkbox" class="chore-checkbox" id="chore-dog" name="chore-dog" />
						<label class="chore-checkbox-label" id="dog" for="chore-dog"><div class="chore-icon"></div><span class="chore-label">Walk the Dog</span></label>
						<input type="checkbox" class="chore-checkbox" id="chore-dust" name="chore-dust" />
						<label class="chore-checkbox-label" id="dust" for="chore-dust"><div class="chore-icon"></div><span class="chore-label">Dust</span></label>
						</div>
						<div class="chore-checkboxes">
						<input type="checkbox" class="chore-checkbox" id="chore-garbage" name="chore-garbage" />
						<label class="chore-checkbox-label" id="garbage" for="chore-garbage"><div class="chore-icon"></div><span class="chore-label">Take Out Trash</span></label>
						<input type="checkbox" class="chore-checkbox" id="chore-horse" name="chore-horse" />
						<label class="chore-checkbox-label" id="horse" for="chore-horse"><div class="chore-icon"></div><span class="chore-label">Put Away Toys</span></label>
						<input type="checkbox" class="chore-checkbox" id="chore-house" name="chore-house" />
						<label class="chore-checkbox-label" id="house" for="chore-house"><div class="chore-icon"></div><span class="chore-label">Clean Room</span></label>
						<input type="checkbox" class="chore-checkbox" id="chore-recycle" name="chore-recycle" />
						<label class="chore-checkbox-label" id="recycle" for="chore-recycle"><div class="chore-icon"></div><span class="chore-label">Recycle</span></label>
						</div>
						<div class="chore-checkboxes">
						<input type="checkbox" class="chore-checkbox" id="chore-soap" name="chore-soap" />
						<label class="chore-checkbox-label" id="soap" for="chore-soap"><div class="chore-icon"></div><span class="chore-label">Laundry</span></label>
						<input type="checkbox" class="chore-checkbox" id="chore-vacuum" name="chore-vacuum" />
						<label class="chore-checkbox-label" id="vacuum" for="chore-vacuum"><div class="chore-icon"></div><span class="chore-label">Vacuum</span></label>
						<input type="checkbox" class="chore-checkbox" id="chore-windows" name="chore-windows" />
						<label class="chore-checkbox-label" id="windows" for="chore-windows"><div class="chore-icon"></div><span class="chore-label">Windows</span></label>
						<input type="checkbox" class="chore-checkbox" id="chore-custom" name="chore-custom" />
						<label class="chore-checkbox-label" id="custom" for="chore-custom"><div class="chore-icon"></div><span class="chore-label">Custom</span></label>
						</div>
					</fieldset>
				<?/*</form>*/?>
				<a class="button goto-chores-list" href="#">Next</a>
			</div>
			<div class="create-account-content chores-list"<?php if ($chores) {?> style="display: block;"<?php } ?>>
			<h1 class="page-title">Welcome, <span class="userparent-firstname"><?=$user['firstname']; ?></span>!</h1>
			<p>Select Your Chores from the List Below</p>
			
			<?php /*echo form_open('select_chores/save_chores', array('class' => 'select-goals-form')) */?>
				<table class="chores-list-table">
					<tr>
						<th>Chore</th>
						<th>Frequency</th>
						<th>Value ($)</th>
					</tr>
					<tbody class="chores-table-body"><?php 
if ($chores) {
	foreach($chores as $chore) { ?>
						<tr class="chore-row">
							<td>
								<select class="chore-dropdown">
									<option>Chore List</option>
									<option <?php if ($chore->name == 'Make the Bed') { ?>selected <?php } ?>value="bed">Make the Bed</option>
									<option <?php if ($chore->name == 'Wash the Dishes') { ?>selected <?php } ?>value="dishes">Wash the Dishes</option>
									<option <?php if ($chore->name == 'Walk the Dog') { ?>selected <?php } ?>value="dog">Walk the Dog</option>
									<option <?php if ($chore->name == 'Dust') { ?>selected <?php } ?>value="dust">Dust</option>
									<option <?php if ($chore->name == 'Take Out Trash') { ?>selected <?php } ?>value="garbage">Take Out Trash</option>
									<option <?php if ($chore->name == 'Pick Up Toys') { ?>selected <?php } ?>value="horse">Pick Up Toys</option>
									<option <?php if ($chore->name == 'Clean Room') { ?>selected <?php } ?>value="house">Clean Room</option>
									<option <?php if ($chore->name == 'Recycle') { ?>selected <?php } ?>value="recycle">Recycle</option>
									<option <?php if ($chore->name == 'Laundry') { ?>selected <?php } ?>value="soap">Laundry</option>
									<option <?php if ($chore->name == 'Vacuum') { ?>selected <?php } ?>value="vacuum">Vacuum</option>
									<option <?php if ($chore->name == 'Windows') { ?>selected <?php } ?>value="windows">Windows</option>
									<option <?php if ($chore->name == 'Make the Bed') { ?>selected <?php } ?>value="custom">Custom</option>
								</select>
							</td>
							<td>
								<select class="frequency-dropdown">
									<option <?php if ($chore->frequency == 'Daily') {?>selected <?php } ?>value="daily">Daily</option>
									<option <?php if ($chore->frequency == 'Weekly') {?>selected <?php } ?>value="weekly">Weekly</option>
									<option <?php if ($chore->frequency == 'Monthly') {?>selected <?php } ?>value="monthly">Monthly</option>
									<option <?php if (gettype($chore->frequency) == 'array') {?>selected <?php } ?>value="custom">Custom</option>
								</select>
							</td>
							<td>
								<input class="chore-value-input" type="text" value="<?=$chore->value;?>" />
							</td>
						</tr><?php 
	}
} ?>
						<tr class="new-chore-row-html" style="display: none">
							<td>
								<select class="chore-dropdown">
									<option>Chore List</option>
									<option value="bed">Make the Bed</option>
									<option value="dishes">Wash the Dishes</option>
									<option value="dog">Walk the Dog</option>
									<option value="dust">Dust</option>
									<option value="garbage">Take Out Trash</option>
									<option value="horse">Pick Up Toys</option>
									<option value="house">Clean Room</option>
									<option value="recycle">Recycle</option>
									<option value="soap">Laundry</option>
									<option value="vacuum">Vacuum</option>
									<option value="windows">Windows</option>
									<option value="custom">Custom</option>
								</select>
							</td>
							<td>
								<select class="frequency-dropdown">
									<option value="daily">Daily</option>
									<option value="weekly">Weekly</option>
									<option value="monthly">Monthly</option>
									<option value="custom">Custom</option>
								</select>
							</td>
							<td>
								<input class="chore-value-input" type="text" />
							</td>
						</tr>
					</tbody>
				</table>
				<!-- <a class="button add-more-button" href="#custom-chore-frequency">Add More</a> -->
				<a class="button add-chore-button" href="#custom-chore-frequency">Add More</a>
				<a class="button next-step" href="set_goals">Next Step</a>
				<?php /*<input type="submit" class="button next-step" value="Next Step" />*/ ?>
			<?php /*</form>*/ ?>
			<div class="custom-chore-frequency">
				<div id="custom-chore-frequency">
					<table>
						<tr>
							<td>
								<label for="new-chore-monday">Monday</label>
								<input type="checkbox" id="new-chore-monday" name="new-chore-monday" />
							</td>
							<td>
								<label for="new-chore-tuesday">Tuesday</label>
								<input type="checkbox" id="new-chore-tuesday" name="new-chore-tuesday" />
							</td>
							<td>
								<label for="new-chore-wednesday">Wednesday</label>
								<input type="checkbox" id="new-chore-wednesday" name="new-chore-wednesday" />
							</td>
							<td>
								<label for="new-chore-thursday">Thursday</label>
								<input type="checkbox" id="new-chore-thursday" name="new-chore-thursday" />
							</td>
							<td>
								<label for="new-chore-friday">Friday</label>
								<input type="checkbox" id="new-chore-friday" name="new-chore-friday" />
							</td>
							<td>
								<label for="new-chore-saturday">Saturday</label>
								<input type="checkbox" id="new-chore-saturday" name="new-chore-saturday" />
							</td>
							<td>
								<label for="new-chore-sunday">Sunday</label>
								<input type="checkbox" id="new-chore-sunday" name="new-chore-sunday" />
							</td>
						</tr>
					</table>
					<a class="button frequency-saver">OK</a>
				</div>
			</div>
		</div>