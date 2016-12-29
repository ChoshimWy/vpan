<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="login-bg">
<head>
	<title><?php echo (C("website")); ?>微盘管理系统</title>
    
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
    <!-- bootstrap -->
    <link href="/vpan/Public/Admin/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="/vpan/Public/Admin/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="/vpan/Public/Admin/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="/vpan/Public/Admin/css/layout.css" />
    <link rel="stylesheet" type="text/css" href="/vpan/Public/Admin/css/elements.css" />
    <link rel="stylesheet" type="text/css" href="/vpan/Public/Admin/css/icons.css" />

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="/vpan/Public/Admin/css/lib/font-awesome.css" />
    
    <!-- this page specific styles -->
    <link rel="stylesheet" href="/vpan/Public/Admin/css/compiled/signin.css" type="text/css" media="screen" />

    <!-- open sans font -->
    <!--<link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    [if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>


    <!-- background switcher -->
    <div class="bg-switch visible-desktop">
        <div class="bgs">
            <a href="#" data-img="landscape.jpg" class="bg active">
                <img src="/vpan/Public/Admin/img/bgs/landscape.jpg" />
            </a>
            <a href="#" data-img="blueish.jpg" class="bg">
                <img src="/vpan/Public/Admin/img/bgs/blueish.jpg" />
            </a>            
            <a href="#" data-img="7.jpg" class="bg">
                <img src="/vpan/Public/Admin/img/bgs/7.jpg" />
            </a>
            <a href="#" data-img="8.jpg" class="bg">
                <img src="/vpan/Public/Admin/img/bgs/8.jpg" />
            </a>
            <a href="#" data-img="9.jpg" class="bg">
                <img src="/vpan/Public/Admin/img/bgs/9.jpg" />
            </a>
            <a href="#" data-img="10.jpg" class="bg">
                <img src="/vpan/Public/Admin/img/bgs/10.jpg" />
            </a>
            <a href="#" data-img="11.jpg" class="bg">
                <img src="/vpan/Public/Admin/img/bgs/11.jpg" />
            </a>
        </div>
    </div>


    <div class="row-fluid login-wrapper">
        <a href="index.html">
         <!--   <img class="logo" src="/vpan/Public/Admin/img/logo.png" /> -->
        </a>
		
		<form method="post" action="<?php echo U('User/signin');?>" style="width: 400px;margin: 0 auto;">
	        <div class="span4 box">
	            <div class="content-wrap">
	                <h6>管理员登陆</h6>
	                <input class="span12" type="text" placeholder="管理员账号" name="username" value="<?php echo ($uname); ?>"/>
	                <input class="span12" type="password" placeholder="管理员密码" name="password"/>
	                <!-- <a href="#" class="forgot">忘记密码？</a> -->
	                <div class="remember">
	                    <input id="remember-me" type="checkbox" name="ckrename" />
	                    <label for="remember-me">记住账号</label> 
	                </div>
	                <input type="submit" value="登陆" class="btn-glow primary login" style="margin-left: 220px;"/>	                
	            </div>
	        </div>
		</form>
    </div>

	<!-- scripts -->
    <script src="/vpan/Public/Admin/js/jquery-latest.js"></script>
    <script src="/vpan/Public/Admin/js/bootstrap.min.js"></script>
    <script src="/vpan/Public/Admin/js/theme.js"></script>

    <!-- pre load bg imgs -->
    <script type="text/javascript">
        $(function () {
            // bg switcher
            var $btns = $(".bg-switch .bg");
            $btns.click(function (e) {
                e.preventDefault();
                $btns.removeClass("active");
                $(this).addClass("active");
                var bg = $(this).data("img");

                $("html").css("background-image", "url('/vpan/Public/Admin/img/bgs/" + bg + "')");
            });

        });
    </script>

</body>
</html>