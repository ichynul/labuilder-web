<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
            maximum-scale=1, user-scalable=no" />
    <title>登录</title>
    <link rel="icon" href="{$admin_favicon|default=''}" type="image/ico">
    <meta name="description" content="登录">
    <link href="/vendor/ichynul/labuilder/lightyearadmin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/ichynul/labuilder/lightyearadmin/css/materialdesignicons.min.css"
        rel="stylesheet">
    <link href="/vendor/ichynul/labuilder/lightyearadmin/css/style.min.css" rel="stylesheet">
    <style>
        .lyear-wrapper {
            position: relative;
        }

        .lyear-login {
            display: flex !important;
            min-height: 100vh;
            align-items: center !important;
            justify-content: center !important;
        }

        .lyear-login:after{
            content:'';
            min-height:inherit;
            font-size:0;
        }


        .login-center {
            background: #fff;
            min-width: 29.25rem;
            padding: 2.14286em 3.57143em;
            border-radius: 5px;
            margin: 2.85714em;
        }

        .login-header {
            margin-bottom: 1.5rem !important;
        }

        .login-center .has-feedback.feedback-left .form-control {
            padding-left: 38px;
            padding-right: 12px;
        }

        .login-center .has-feedback.feedback-left .form-control-feedback {
            left: 0;
            right: auto;
            width: 38px;
            height: 38px;
            line-height: 38px;
            z-index: 4;
            color: #dcdcdc;
        }

        .login-center .has-feedback.feedback-left.row .form-control-feedback {
            left: 15px;
        }

        #captcha {
            width: 120px;
            height: 38px;
        }
    </style>
</head>

<body>

    <div class="row lyear-wrapper" style="background: url(/vendor/ichynul/labuilder/lightyearadmin/images/login-bg.jpg) no-repeat;background-size: 100% 100%;">
        <div class="lyear-login">
            <div class="login-center">
                <div class="login-header text-center">
                    <a> <img alt="logo" src="/vendor/ichynul/labuilder/lightyearadmin/images/logo-ico.png">
                    </a>
                </div>
                <form action="" method="post" id="login-form">
                    <div class="form-group has-feedback feedback-left">
                        <input type="text" placeholder="请输入您的用户名" value="admin" class="form-control" name="username" id="username" />
                        <span class="mdi mdi-account form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback feedback-left">
                        <input type="password" placeholder="请输入密码" value="admin" class="form-control" id="password"
                            autocomplete="new-password" name="password" />
                        <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <!-- <div class="form-group has-feedback feedback-left row">
                        <div class="col-xs-7">
                            <input type="text" name="captcha" class="form-control" placeholder="验证码">
                            <span class="mdi mdi-check-all
                                    form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-xs-5">
                            <img src="{{url('/admin/index/captcha')}}?d=1" class="pull-right" id="captcha"
                                style="cursor: pointer;" onclick="this.src=this.src+'1';"
                                title="点击刷新" alt="captcha">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">立即登录</button>
                    </div>
                </form>
                <hr>
                <footer class="col-sm-12 text-center">
                    Admin copyright
                </footer>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/vendor/ichynul/labuilder/lightyearadmin/js/jquery.min.js">
    </script>
    <script type="text/javascript" src="/vendor/ichynul/labuilder/lightyearadmin/js/bootstrap.min.js">
    </script>
    <script type="text/javascript"
        src="/vendor/ichynul/labuilder/builder/js/jquery-validate/jquery.validate.min.js">
        </script>
    <script type="text/javascript"
        src="/vendor/ichynul/labuilder/builder/js/jquery-validate/messages_zh.min.js"></script>
    <script type="text/javascript"
        src="/vendor/ichynul/labuilder/lightyearadmin/js/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="/vendor/ichynul/labuilder/lightyearadmin/js/lightyear.js">
    </script>

    <script type="text/javascript">
        $('#login-form').validate({
            ignore: ".ignore", // 插件默认不验证隐藏元素,这里可以自定义一个不验证的class,即验证隐藏元素,不验证class为.ignore的元素
            focusInvalid: false, // 禁用无效元素的聚焦
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                },
                captcha: {
                    required: true
                },
            },
            errorPlacement: function errorPlacement(error, element) {
                var parent = $(element).parents('.form-group');
                if (parent.find('.error-label').length) {
                    return;
                }
                parent.addClass('has-error');

                lightyear.notify('输入有误，请检查', 'warning');
            },
            highlight: function (element) {

            },
            unhighlight: function (element) {
                $(element).next('.tagsinput').removeClass('is-invalid');
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function (form) {
                formSubmit();
            }
        });

        function formSubmit() {
            lightyear.loading('hide');

            lightyear.loading('show');

            setTimeout(function(){
                lightyear.loading('hide');
                location.href = "{{url('/admin/index/index')}}";
            },1000);

            return false;

            // var data = $('#login-form').serialize();
            // $.ajax({
            //     url: location.href,
            //     data: data,
            //     type: 'POST',
            //     dataType: 'json',
            //     success: function (data) {
            //         setTimeout(function () {
            //             lightyear.loading('hide');
            //         }, 500);

            //         if (data.code) {
            //             lightyear.notify(data.msg || data.message || '登录成功', 'success');
            //             location.href = data.url;
            //         } else {
            //             lightyear.notify(data.msg || data.message || '登录失败', 'warning');
            //             $('#captcha').attr('src', "{{url('/admin/index/captcha')}}?d=" + Math.random());
            //         }
            //     },
            //     error: function () {
            //         lightyear.loading('hide');
            //         lightyear.notify('网络错误', 'danger');
            //     }
            // });

            // return false;
        }
    </script>
</body>

</html>
