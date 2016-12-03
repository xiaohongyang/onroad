<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>共享通勤_登陆</title>
	<link rel="stylesheet" href="/css/public.css">
	<link rel="stylesheet" href="/css/login.css">
	<link rel="stylesheet" href="/css/xhy.css">
    <!--<script src="/js/jquery-1.7.2.js" type="text/javascript"></script>-->

	<script src="/js/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>


	<div id="bg">

				<div id="head">
					<span>共享通勤</span>
				</div>
				<form action="<?=\yii\helpers\Url::to('/site/login')?>" method="post">
					<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>">
					<div id="content">
						<input type="text" name="mobile" id="mobile" placeholder="<?=$model->mobile?:'请输入手机号'?>" value="<?=$model->mobile?:''?>">
						<span><a href="javascript:void(0)" id="btn-get-code">获取验证码</a></span>
						<div class="fenge"></div>
						<input type="text" name="code" placeholder="请输入短信验证码">
					</div>
					<div id="login">
						<a href="register.html"><input type="submit" value="登陆"></a>
						<p><a href="<?=\yii\helpers\Url::to('/')?>">立即进入</a></p>
					</div>
				</form>

				<?=Yii::$app->view->render('../layouts/bottom.php');?>
        </ul>
	</div>



	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalLabel">提示</h4>
				</div>
				<div class="modal-body" style="color: #000;">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</div>
	</div>
</body>

	<script>
	   var winWidth=$(window).width()>640?640:$(window).width();
        $("html").css("fontSize",(winWidth/640)*40+"px");

         var scr_height=window.innerHeight;
        $("#bg").css("height",scr_height);
    </script>


	<script type="text/javascript" src="/js/xhy_fn.js"></script>
	<script>
		$(function(){

			<?php
				if($message = Yii::$app->session->getFlash('message')) {
					if(!empty($message)) {
			?>
				$('#modal').modal('show')
				$('.modal-body').html('<?=$message?>');
			<?php
					}
				}
			?>

			$('#btn-get-code').click(function(){
				var url = '<?=\yii\helpers\Url::to('/msg/get-mobile-checkcode')?>';
				var mobile = $('#mobile').val();
				var data = {
					_csrf : '<?=Yii::$app->request->getCsrfToken()?>',
					mobile : mobile
				};
				$.ajax({
					url : url,
					data : data,
					dataType : 'json',
					type : 'post',
					success : function (json) {
						var message = json.message;

						$('#modal').modal('show')
						$('.modal-body').html(message);

					}
				})
			})


		})
	</script>

</html>


