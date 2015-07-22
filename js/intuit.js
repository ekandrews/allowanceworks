/**************
/*	chore_object = {
/*		name,
/*		frequency,
/*		value
/*	}
/*
/*	goal_object = {
/*		name,
/*		value
/*	}
/*
/**************/


	/***** Chores checkboxes *****/
	var num_children = 0;
	var children_objects = [];
	
	var chores = [];
	var num_chores = 0;
	var new_chore_html = '';
	var new_goal_html = '';
	
	var chore_objects = [];
	var frequency_objects = [];
	var goal_objects = [];
	
	var completed_chores_array = [];
	
	var current_chore;
	
	var user_firstname = '';
	var user_id;

	function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}
	
$(document).ready(function () {
	num_children = $('.children-table').attr('data-num-children');

	$('.chore-checkbox').customInput();
	
	//$('.add-more-button').fancybox();
	
	$('#chore-start-date-input').kendoDatePicker({
		value: new Date(),
		change: function () {
			var id = $('.completed-chores-content').attr('data-user-id');
			var value = $('#chore-start-date-input').val();
			
			var chore_table = $('.completed-chores-table');
			chore_table.addClass('loading');
			
			$.post('chores/get_chores', {id: id, time: value}, function (data) {
				fillChoreChecklist(data);
				chore_table.removeClass('loading');
			});
		}
	});
	$('#goal-date-input').kendoDatePicker({value: new Date()});
	
	$('.saving-table').visualize({type: 'line'});
	
	$('.submit-button').click(function () {
		user_firstname = $('#aw-firstname').val();
		createCookie('aw_firstname', user_firstname);
	});
	
	$('.setup-next-button').click(function () {
		user_firstname = $('#aw-firstname').val();
		createCookie('aw_firstname', user_firstname);
		
		num_children = $('#aw-num-children option:selected').val();
		createCookie('aw_num_children', num_children);
	});
	
	if ($('.children-table').length > 0) {
		/*num_children = parseInt(readCookie('aw_num_children'));
		for (var i = 0; i < num_children; i++) {
			var new_child = $('<tr class="child-row"><td>' + (i + 1) + '</td><td><input type="text" name="child-' + i + '-name" id="" /></td><td><input type="text" name="child-' + i + '-age" id="child-' + i + '-age" /></td></tr>');
			new_child.appendTo('.children-table-body');
		}*/
	}
	
	$('.child-adder').click(function (e) {
		e.preventDefault();
		e.stopPropagation();
		
		/*var i = num_children;
		var new_child = $('<tr class="child-row"><td>' + (i + 1) + '</td><td><input type="text" name="child-' + i + '-name" id="" /></td><td><input type="text" name="child-' + i + '-age" id="child-' + i + '-age" /></td></tr>');
		new_child.appendTo('.children-table-body');
		num_children++;*/
		
		$.fancybox({
			'href': 'create_child/'
		});
	});
	
	$('body').on('click', '.child-creator', function (e) {
		e.preventDefault();
		e.stopPropagation();
		
		var i = $('.child-row').length;
		
		$.post('create_child', $('#create-child-form').serialize(), function (data) {
			$.fancybox.close();
			
			var children_table_body = $('.children-table-body');
			var children_table = $('.children-table');
			var string = $.parseJSON(data);
			var new_child = $('<tr class="child-row"><td>' + (i + 1) + '</td><td>' + string.name + '</td><td>' + string.dob + '</td></tr>');
			new_child.hide().appendTo(children_table_body);
			$('.empty-data-prompt').hide();
			children_table.removeClass('hidden');
			new_child.fadeIn();
		});
	});
	
	if ($('.userparent-firstname').length > 0) {
		user_firstname = readCookie('aw_firstname');
		//$('.userparent-firstname').html(user_firstname);
	}
	
	$('.chore-checkbox-label').click(function (e) {
		//e.preventDefault();
		//e.stopPropagation();
		
		var i = $(this).parent().index('.custom-checkbox');
		//console.log('i: ' + i);
		if (chores[i] == undefined) {
			chores[i] = $(this).attr('id');
			num_chores++;
		}
		else {
			chores.splice(i, 1);
			num_chores--;
		}
			console.log(chores);
	});
	
	/*$('#custom').click(function () {
		if (!$(this).hasClass('checked')) {
			$.fancybox({
				href: '#custom-chore-name'
			});
		}
	});*/
	$('#custom').fancybox();
	
	if ($('.chores-list-table').length > 0) {
		if (new_chore_html == '') {
			new_chore_html = $('.chores-list-table .chores-table-body .new-chore-row-html').html();
			//console.log(new_chore_html);
			$('.chores-list-table tbody .new-chore-row-html').remove();
		}
	}
	
	$('.goto-chores-list').click(function (e) {
		e.preventDefault();
		e.stopPropagation();
		
		eraseCookie('aw_chores');
		eraseCookie('aw_goals');
		
		for (var i in chores) {
			var new_chore = $('<tr class="chore-row">' + new_chore_html + '</tr>').appendTo('.chores-list-table .chores-table-body');
			console.log('new_chore: ' + new_chore.html());
			console.log('chores[i]: ' + chores[i]);
			new_chore.find('.chore-dropdown').val(chores[i]);
		}
		
		$('.chores-content').hide();
		$('.chores-list').show();
	});
	
	$('.add-chore-button').click(function (e) {
		$('<tr class="chore-row">' + new_chore_html + '</tr>').appendTo('.chores-list-table .chores-table-body').fadeIn();
	});
	
	$('body').on('change', '.frequency-dropdown', function () {
		current_chore = $(this).index();
		
		if ($(this).find('option:selected').val() == 'custom') {
			$('#custom-chore-frequency input').removeAttr('checked');
			$.fancybox({
				'href': '#custom-chore-frequency'			
			});
		}
		else {
			frequency_objects[current_chore] = undefined;
		}
	});
	
	$('body').on('click', '.frequency-saver', function (e) {
		e.preventDefault();
		e.stopPropagation();
		
		frequency_objects[current_chore] = [];
		for (var i = 0; i < 7; i++) {
			frequency_objects[current_chore][i] = $('#custom-chore-frequency input').eq(i).is(':checked') ? 1 : 0;
		}
		console.log('frequency_objects: ' + frequency_objects);
		$.fancybox.close();
	});
	
	$('.next-step').click(function (e) {
		//e.preventDefault();
		//e.stopPropagation();
		
		for (var i = 0; i < num_chores; i++) {
			var chore_row = $('.chore-row').eq(i)
			chore_objects[i] = {
				name: chore_row.find('.chore-dropdown option:selected').html(),
				frequency: (frequency_objects[i] != undefined) ? frequency_objects[i] : chore_row.find('.frequency-dropdown option:selected').html(),
				value: chore_row.find('.chore-value-input').val()
			};
		}
		
		var chore_json = JSON.stringify(chore_objects);
		createCookie('aw_chores', chore_json);
	});
	
	$('body').on('change', '.chore-value', function () {
		console.log('i: ' + $(this).index('.chore-value'));
	});
	
	if ($('.goals-table').length > 0) {
		new_goal_html = $('.goals-table .goals-table-body .new-goal-row-html').html();
		$('.goals-table .goals-table-body .new-goal-row-html').remove();
	}
	
	$('.add-goal-button').click(function (e) {
		$('.empty-data-prompt').hide();
		$('.goals-table').removeClass('hidden');
		
		var new_goal = $('<tr class="goal-row">' + new_goal_html + '</tr>');
		new_goal.hide().appendTo('.goals-table .goals-table-body').fadeIn();
	});
	
	$('.finish-button').click(function (e) {
		e.preventDefault();
		e.stopPropagation();
		
		for (var i = 0; i < $('.goal-row').length; i++) {
			var goal_row = $('.goal-row').eq(i);
			goal_objects[i] = {
				name: goal_row.find('.goal-name').val(),
				value: goal_row.find('.goal-value').val(),
				date: $('#goal-date-input').val()
			};
		}
		
		var goal_json = JSON.stringify(goal_objects);
		createCookie('aw_goals', goal_json);
		
		user_id = $('.create-account-content').attr('data-user-id');
		
		$.post('save_chores_goals', {chores: readCookie('aw_chores'), goals: goal_json, user_id: user_id}, function () {
			window.location = '../intuit';
		});
	});
	
	if ($('.overview-chores-table').length > 0) {
		chores_object = eval(readCookie('aw_chores'));
		goals_object = eval(readCookie('aw_goals'));
		
		var custom_frequency_object = ['M', 'T', 'W', 'Th', 'F', 'Sa', 'Su'];
		
		for (var i = 0; i < chores_object.length; i++) {
			var freq = '';
			
			if (typeof(chores_object[i]['frequency']) == 'object') {
				for (var j = 0; j < 7; j++) {
					freq += chores_object[i]['frequency'][j] != 0 ? (freq != '' ? '/' : '') + custom_frequency_object[j] : '';
				}
			}
			else {
				freq = chores_object[i]['frequency'];
			}
			var new_chore_row = $('<tr class="chore-row"><td>' + chores_object[i]['name'] + '</td><td>' + freq + '</td><td>$' + chores_object[i]['value'] + '</td></tr>');
			new_chore_row.appendTo('.overview-chores-table');
		}
		
		for (var i = 0; i < goals_object.length; i++) {
			var new_goal_row = $('<tr class="goal-row"><td>' + (i + 1) + '</td><td>' + goals_object[i]['name'] + '</td><td>$' + goals_object[i]['value'] + '</td></tr>');
			new_goal_row.appendTo('.overview-goals-table');
			
		}
	}
	
	if ($('.completed-chores-table').length > 0) {
		var parent_id = $('.completed-chores-content').attr('data-user-id');
		$.post('chores/get_chosen_chores/' + parent_id, function (data) {
			chores_object = $.parseJSON(data);
			for (var i = 0; i < chores_object.length; i++) {
				var new_chore_row_html = '<tr class="completed-chores-row"><th>' + chores_object[i]['name'] + '</th>';
				for (var j = 0; j < 7; j++) {
					new_chore_row_html += '<td><input type="checkbox"' + (chores_object[i]['frequency'][j] == 0 ? ' disabled' : '') + ' id="chore-' + i + '-' + j + '" /></td>';
				}
				new_chore_row_html += '<td><input type="checkbox" disabled id="chore-' + i + '-weekly" /></td><td><input type="checkbox" disabled id="chore-' + i + '-monthly" /></td>'
				new_chore_row = $(new_chore_row_html).appendTo('.completed-chores-table-body');
			}
			var id = $('.completed-chores-content').attr('data-user-id');
			var value = $('#chore-start-date-input').val();
			
			var chore_table = $('.completed-chores-table');
			chore_table.addClass('loading');
			
			$.post('chores/get_chores', {id: id, time: value}, function (data) {
				fillChoreChecklist(data);
				chore_table.removeClass('loading');
			});
		});
	}
	
	$('.chores-submitter').click(function (e) {
		e.preventDefault();
		e.stopPropagation();
		
		var parent_id = $('.completed-chores-content').attr('data-user-id');
		
		for (var i = 0; i < chores_object.length; i++) {
			completed_chores_array[i] = [];
			for (var j = 0; j < 7; j++) {
				completed_chores_array[i][j] = $('.completed-chores-row').eq(i).find('input').eq(j).is(':checked') ? 1 : 0;
			}
		}
		var completed_string = JSON.stringify(completed_chores_array);
		
		createCookie('aw_completed_chores', completed_string);
		var chore_date = $('#chore-start-date-input').val();
		$.post('chores/submit_completed_chores', {parent_id: parent_id, chores: completed_string, date: chore_date}, function () {
			console.log('saved!');
		});
	});
	
	if ($('.progress-table').length > 0 ) {
		/*chores_object = eval(readCookie('aw_chores'));
		goals_object = eval(readCookie('aw_goals'));
		completed_chores_array = eval(readCookie('aw_completed_chores'));
		
		var num_completed_chores = 0;
		var total_chores = 0;
		var amount_earned = 0;
		var amount_pending = 0;
		var goal_amount = goals_object[0]['value'];
		
		for (var i = 0; i < completed_chores_array.length; i++) {
			total_chores += completed_chores_array[i].length;
			
			for (var j = 0; j < completed_chores_array[i].length; j++) {
				num_completed_chores += completed_chores_array[i][j];
				amount_earned += completed_chores_array[i][j] * chores_object[i]['value'];
			}
		}
		
		$('.progress-table .completed-chores').html(num_completed_chores);
		$('.progress-table .pending-chores').html(total_chores - num_completed_chores);
		$('.progress-table .earned-chore-value').html(amount_earned);
		$('.progress-table .pending-chore-value').html(goal_amount - amount_earned);*/
		$('.progress-table').visualize();
	}
	
});

function fillChoreChecklist(data) {
	var content = $.parseJSON(data);
	for (var t = 0; t < $('.completed-chores-row').length; t++) {
		for (var i = 0; i < 7; i++) {
			if (content != null && content[t][i] == 1) {
				$('#chore-' + t + '-' + i).attr('checked', 'checked');
			}
			else {
				$('#chore-' + t + '-' + i).removeAttr('checked');
				
			}
		}
	}
}