$(document).ready(function() {
	
	$('#name').focus();
	
	$('#name').keyup(function() {
		var name = $('#name').val();
		fillInfo(name);	
	});

	$('#name').change(function() {
		var name = $('#name').val();
		fillInfo(name);	
	});
	
	$('#name').blur(function() {
		var name = $('#name').val();
		fillInfo(name);	
	});
	
	$('#meta_title').keyup(function() {
		controlTitleCheckbox();
	});
	
	$('#meta_description').keyup(function() {
		controlDescriptionCheckbox();
	});
	
	$(window).load(function() {
		var name = $('#name').val();
		fillInfo(name);
		var meta_title = $('#meta_title').val();
		var meta_description = $('#meta_description').val();
		if(this.meta_title && meta_title) {
			if(this.meta_title!= meta_title) {
				$('#chkTitle').attr('checked', true);
				$('#meta_title').val(this.meta_title);
			}
		}
		if(this.meta_description && meta_description) {
			if(this.meta_description!=meta_description) {
				$('#chkDescription').attr('checked', true);
				$('#meta_description').val(this.meta_description);
			}
		}
	});
	
});
	
function fillInfo(name) {
	if(name == '') {
		$('#url').val('');
		$('#meta_title').val('');
		$('#meta_description').val('');
	}else {
		var url = removeAccents(name) + '-provieg';
		var meta_title = name + ' ProVie G';
		var meta_description = 'buy ' + name + ' ProVie G make yours healthful';
		
		if($('#chkTitle').is(':checked')) meta_title = $('#meta_title').val();
		if($('#chkDescription').is(':checked')) meta_description = $('#meta_description').val();
		
		$('#url').val(url);
		$('#meta_title').val(meta_title);
		$('#meta_description').val(meta_description);
	}
}

function controlTitleCheckbox() {
	var meta_title = $('#meta_title').val();
	if($.trim(this.meta_title)!=$.trim(meta_title)) {
		$('#chkTitle').attr('checked', true);
	}
	else {
		$('#chkTitle').attr('checked', false);
	}
}

function controlDescriptionCheckbox() {
	var meta_description = $('#meta_description').val();
	if($.trim(this.meta_description)!=$.trim(meta_description)) {
		$('#chkDescription').attr('checked', true);
	}
	else {
		$('#chkDescription').attr('checked', false);
	}
}