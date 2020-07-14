function alertCustom(type,msg){
	if (type == "success") {
		var html = '<div class="alert alert-success">\
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">\
				<span aria-hidden="true">&times;</span>\
			</button>\
			<i class="icon-tick"></i><strong>Success!</strong> '+msg+'\
		</div>';
	}else if(type == "danger"){
		var html = '<div class="alert alert-danger">\
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">\
				<span aria-hidden="true">&times;</span>\
			</button>\
			<i class="icon-warning2"></i><strong>Failed!</strong> '+msg+'\
		</div>';
	}
	return html;
}