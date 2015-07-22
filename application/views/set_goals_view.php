			<div class="create-account-content" data-user-id="<?=$user['user_id']; ?>">
				<h1 class="page-title">Now Let's Set a Goal!</h1>
				<h2>What are you saving up for?</h2>
				<p>
				<div class="goals clearfix">
					<table class="goals-table <?php if ($numgoals == 0) { ?>hidden<?php } ?>">
						<thead class="goals-table-head">
							<tr>
								<th>#</th>
								<th>Goal</th>
								<th>Value ($)</th>
							</tr>
						</thead>
						<tbody class="goals-table-body"><?php
if (count($goals) > 0) {
	foreach($goals as $i => $goal) { ?>
							<tr class="goal-row">
								<td><?=($i + 1);?><span class="goal-id"></span></td>
								<td><input type="text" class="goal-name" name="goal-name-input" id="goal-name-input" value="<?=$goal->name; ?>" /></td>
								<td><input type="text" class="goal-value" name="goal-value-input" id="goal-value-input" value="<?=$goal->value; ?>" /></td>
							</tr><?php
	}
} ?>

							<tr class="new-goal-row-html hidden">
								<td><span class="goal-id"></span></td>
								<td><input type="text" class="goal-name" name="goal-name-input" id="goal-name-input" /></td>
								<td><input type="text" class="goal-value" name="goal-value-input" id="goal-value-input" /></td>
							</tr>
						</tbody>
					</table><?php 
if ($numgoals == 0) { ?>
					<p class="empty-data-prompt">You currently have no goals.</p><?php
} ?>
					<div class="goals-buttons">
						<input type="text" id="goal-date-input" class="datepicker" placeholder="Start Date" />
						<a class="button add-more-button add-goal-button" href="#add-goal">Add More</a>
					</div>
				</div>
				<ul class="goal-list">
					<li class="goal-list-item"><span class="goal-label">Weekly Allowance</span><span class="value">$<?=$sums->weekly_sum;?></span></li>
					<li class="goal-list-item"><span class="goal-label">Monthly Allowance</span><span class="value">$<?=$sums->monthly_sum;?></span></li>
					<li class="goal-list-item"><span class="goal-label">Goal Value</span><span class="value">$350</span></li>
				</ul>
				<div class="add-goal">
					<div id="add-goal">
						<input type="text" class="form-input" id="new-goal-title" name="new-goal-title" placeholder="New Goal" />
						<input type="text" class="form-input" id="new-goal-value" name="new-goal-value" placeholder="Value ($)" />
						<button class="button goal-saver">OK</button>
					</div>
				</div>
				<a class="button finish-button" href="overview">Finish</a>
			</div>