			<div class="chores-content completed-chores-content" data-user-id="<?=$user['user_id']; ?>">
				<h1 class="page-title">Welcome, <span class="user-firstname"><?=$user['firstname']; ?></span>!</h1>
				<p class="page-prompt">Mark Complete</p>
				<label for="chore-start-date-input">Start Date</label>
				<input type="text" class="datepicker" id="chore-start-date-input" />
				<a href="#" class="chore-list-button chore-list-prev"><span>Prev</span><i class="icon-angle-left"></i></a>
				<a href="#" class="chore-list-button chore-list-next"><span>Next</span><i class="icon-angle-right"></i></a>
				<table class="completed-chores-table">
					<thead class="completed-chores-table-head">
					<tr>
						<th></th>
						<th>Monday</th>
						<th>Tuesday</th>
						<th>Wednesday</th>
						<th>Thursday</th>
						<th>Friday</th>
						<th>Saturday</th>
						<th>Sunday</th>
						<th>Weekly</th>
						<th>Monthly</th>
					</tr>
					</thead>
					<tbody class="completed-chores-table-body">
					
					</tbody>
				</table>
				<a class="button chores-submitter" href="current-progress.php">Submit</a>
			</div>