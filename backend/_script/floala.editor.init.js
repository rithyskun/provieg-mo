$(function() {
	// buttons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'color', 'formatBlock', 'blockStyle', 'align', 'insertOrderedList', 'insertUnorderedList', 'outdent', 'indent', 'selectAll', 'createLink', 'insertImage', 'insertVideo', 'undo', 'removeFormat', 'redo', 'html', 'save', 'insertHorizontalRule', 'table', 'uploadFile']
	$('#desc').editable({
		inlineMode: false,
		imageUpload: false,
		plainPaste: true,
		fontList: {'OpenSans Light': 'OpenSans Light', 'Khmer': 'Khmer', 'Arial,Helvetica': 'Arial, Helvetica', 'Courier,Courier New': 'Courier, Courier New', 'Georgia': 'Georgia', 'Times New Roman,Times': 'Times New Roman, Times', 'Trebuchet MS': 'Trebuchet MS', 'Verdana,Geneva': 'Verdana, Geneva', 'Impact,Charcoal': 'Impact, Charcoal'},
		shortcutsAvailable: ['bold', 'italic', 'underline'],
		blockTags: {'n': 'Normal', 'p': 'Paragraph', /*'pre': 'Code',*/ 'blockquote': 'Quote', 'h1': 'Heading 1', 'h2': 'Heading 2', 'h3': 'Heading 3', 'h4': 'Heading 4', 'h5': 'Heading 5', 'h6': 'Heading 6'},
		withCredentials: true,
		minHeight: 450,
		width: 880,
		buttons : ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'color', 'formatBlock', 'blockStyle', 'align', 'insertOrderedList', 'insertUnorderedList', 'outdent', 'indent', 'createLink', 'insertImage', 'insertVideo', 'undo', 'removeFormat', 'redo', 'html', 'clear'],
		customButtons : {
			clear : {
				title : 'Remove HTML',
				icon : {
					type : 'txt',
					value : 'x'
				},
				callback : function() {
					this.setHTML('');
				}
			}
		}
	});
});