$(document).ready(function() {
	$('#id_fichier').AjaxSelect({
		file : $("#ajax_file").val(),
		input : '#debut_fichier'
	}).change(function(event) {
		load();
	});
	function load() {
		$("#image").html("<img src='../_images/loader-input.gif'/>");
		$('#image').html($.ajax({
			async : false,
			data : "id=" + $('#id_fichier').val(),
			type : 'post',
			url : $("#ajax_file_image").val()
		}).responseText);
	}
});