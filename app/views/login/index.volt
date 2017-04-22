{% extends "layout.volt" %}
{% block content %}
    <div class="container">
        <div class="jumbotron">
            <h2>PHALCON - 后台管理系统</h2>
            <p>PHALCON - 后台管理系统</p>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <form>
                    <div class="form-group">
                        <label>登录名</label>
                        <input type="text" class="form-control" id="name" placeholder="登录名">
                    </div>
                    <div class="form-group">
                        <label>密码</label>
                        <input type="password" class="form-control" id="password" placeholder="密码">
                    </div>
                    <a onclick="sub()" class="btn btn-default">登录</a>
                </form>
            </div>
        </div>
        {% include "public/bottomBar.volt" %}
    </div>
    <input type="hidden" id="postUrl" value="{{ url('/login/pfnLogin') }}">
    <input type="hidden" id="targetUrl" value="{{ url('/index/index') }}">
{% endblock %}
{% block js %}
    <script>
        function sub() {
            var name = $("#name").val();
            var password = $("#password").val();

            var json = {
                name: name,
                password: password
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