<div class="create-account-content">
				<h1 class="page-title">Parent Set-Up</h1>
				<form class="create-account-form">
					<fieldset>
						<legend>Please Add Children</legend>
						<table class="children-table<?php if ($numchildren == 0) echo(' hidden'); ?>" data-num-children="<?=$numchildren;?>">
							<thead class="children-table-head">
								<tr>
									<th></th>
									<th>Name</th>
									<th>Age</th>
								</tr>
							</thead>
							<tbody class="children-table-body"><?php
							
for ($i = 0; $i < $numchildren; $i++) { ?>
								<tr class="child-row">
									<td><?=($i+1);?></td>
									<td><input type="text" name="child-<?=$i;?>-name" id=""></td>
									<td><input type="text" name="child-<?=$i;?>-age" id="child-<?=$i;?>-age"></td>
								</tr><?php
}?>
							</tbody>
						</table><?php
						
if ($numchildren == 0) { ?>
						<p class="empty-data-prompt">You have not yet created any child accounts.</p><?php
}
						?>
						<button class="button child-adder">Add Child</button>
						<a class="button" href="select_chores">Next</a>
					</fieldset>
				</form>
			</div>