			<div class="progress-content">
				<h1 class="page-title">Current Progress</h1>
				<select id="progress-range-select">
					<option>Week/Month/Year</option>
				</select>
				<div class="progress-table-and-buttons clearfix">
				<table class="progress-table">
					<tr>
						<td></td>
						<th scope="col">Chores Complete</th>
						<th scope="col">Amount Earned ($)</th>
					</tr>
					<tr>
						<th scope="row">Completed</th>
						<td class="completed-chores"><?=$total_completed_chores; ?></td>
						<td class="earned-chore-value"><?=$total_earned_value; ?></td>
					</tr>
					<tr>
						<th scope="row">Pending</th>
						<td class="pending-chores"><?=$total_chores - $total_completed_chores; ?></td>
						<td class="pending-chore-value"><?=$total_value - $total_earned_value; ?></td>
					</tr>
				</table>
				<div class="progress-buttons">
					<a href="#" class="button">Share It!</a>
					<a href="#" class="button">Awards</a>
				</div>
				</div>
			</div>