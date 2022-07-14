	<style>
	.error  { padding:30px;text-align:center;font-size:18px;font-weight:700;background-color:#ffffff;border:4px solid #990000; }
	.success{ text-align:left;font-size:18px;font-weight:400; }
	.success > p { text-align:center;margin-bottom:30px; }
	</style>
	<div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center mt-5">
                <h2>AMP JAM Password Reset</h2>
            </div> <!-- /col-12 -->
        </div> <!-- /row -->
        <div class="row">
            <div class="col-3"></div>  <!-- spacer -->
            <div class="col-6 text-center mt-5">
            <?= $user_message ?>
            </div>  <!-- /col-6 -->
        </div>  <!-- /row -->
    </div>  <!-- /container-fluid -->
</body>
<script type="text/javascript">
$(document).ready(function(){ 
    // Attach a submit handler to the form
    $( "#password_form" ).submit(function( event ) {
        event.preventDefault();
        $.post("<?=site_url()?>/auth/update_password",
            {id:<?= $user_id ?>, password:$("#password").val(), token:'<?= $token ?>'},
            function(data){
                //reset any previous error messages
                $("#password_error").html("");
                $("#password_error").css("display","none");
										
                if(data.status == "success"){
                    if(data.user_message > ' ' ){
                        $("#user_message").html(data.user_message);
                        $("#user_message").css("display","block");
                    }
                }else{
                    if(data.password_error > ' '){
                        $("#password_error").html(data.password_error);
                        $("#password_error").css("display","block");
                    }
                }
            },
            "json"
        ); //post
    }); //submit
}); //ready
</script>
                    
</html>