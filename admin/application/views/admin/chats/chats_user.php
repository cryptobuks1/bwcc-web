<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<a href="<?= $back_link ?>" title="Back"><i class="fa fa-angle-left"></i></a>
				</div>
				<div class="page-title">
					<h5>Chats</h5>
					<h6 class="sub-heading">List Chats</h6>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
				<div class="right-actions">
					
				</div>
			</div>
		</div>
	</div>
</header>
<!-- END: .main-heading -->

<!-- BEGIN .main-content -->
<div class="main-content">
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header"><?= ucwords($user_chat->name_user) ?></div>
				<div class="customScroll">
					<div class="card-body">
						<ul class="chats" id="list_chats">
						<?php 
							foreach ($chats_user as $value) {
						?>
							<li class="<?php ($value->type_user == 1) ? print_r("chats-right") : print_r("chats-left") ?>">
								<div class="chats-avatar">
									<i class="fa fa-user fa-lg"></i>
									<div class="chats-name"><?php ($value->type_user == 1) ? print_r("Admin") : print_r(ucwords($value->name_user)) ?></div>
								</div>
								<div class="chats-text info"><?= $value->text ?></div>
								<div class="chats-hour"><?= date("d M Y H:i", $value->timestamp) ?> <span class="icon-done_all"></span></div>
							</li>
						<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<form method="post" id="user_form">
						<div class="row">
							<div class="col-md-10">
								<input type="hidden" name="chat_code" id="chat_code" class="form-control" value="<?= encrypt_decrypt("encrypt", $user_chat->id) ?>">
								<textarea name="message" id="message" class="form-control block" rows="3"></textarea>
							</div>
							<div class="col-md-2">
								<input type="submit" name="action" class="btn btn-info btn-lg btn-block" value="Kirim" />  
							</div>
						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
// Reload list chats per 1 min
setInterval(function(){ 
	console.log('reload');
	$("#list_chats").load(" #list_chats");
}, 100000);

// Send Message
$(document).on('submit', '#user_form', function(event){  
       event.preventDefault();  
       var chat_code = $('#chat_code').val();  
       var message = $('#message').val();  

       if(message !='' && chat_code !='')  
       {  
            $.ajax({  
                 url:"<?php echo base_url().'cms/chats/sendmessage'?>",  
                 method:'POST',  
                 data:new FormData(this),  
                 contentType:false,  
                 processData:false,  
                 success:function(data)  
                 {  
                      // alert(data);  
                      $('#user_form')[0].reset();  
                      $("#list_chats").load(" #list_chats");
                 }  
            });  
       }  
       else  
       {  
            alert("Bother Fields are Required");  
       }  
  });
</script>