{% extends "layout.volt" %}
{% block content %}
    <div class="container">
        <div class="jumbotron">
            <h1>Welcome</h1>
            <p>辣椒直播 - API接口测试</p>
            <p>登录</p>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <form>
                    <div class="form-group">
                        <label>手机号</label>
                        <input type="text" class="form-control" id="mobile" value="{{ mobile }}" placeholder="手机号">
                    </div>
                    <div class="form-group">
                        <label>验证码</label>
                        <input type="text" class="form-control" id="code" placeholder="验证码" value="1313200">
                    </div>
                    <a onclick="sub()" class="btn btn-default">登录</a>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" id="postUrl" value="{{ url('/login/pfnLogin') }}">
    <input type="hidden" id="targetUrl" value="{{ url('/index/index') }}">
{% endblock %}
{% block js %}
    <script>
        function sub() {
            var mobile = $("#mobile").val();
            var code = $("#code").val();

            var json = {
                mobile: mobile,
                code: code
            };
            var url = $("#postUrl").val();

            $.post(url, json, function (jsonData) {
                if (jsonData.status == 1) {
                    var target = $("#targetUrl").val();
                    location = target;
                } else {
                    $.error(jsonData.message);
                }
            }, "json");
        }

    </script>
{% endblock %}