{% extends "test/master.volt" %}
{% block content %}
{% endblock %}
{% block js %}
    <script>
        $(function () {
            var url = "http://demo.phalcon.lmx0536.cn/test/api/api";
            var json = {
                say: "hello world",
                body: {
                    test: 11,
                    test2: 22
                }
            };
            $.post(url, json, function (res) {
                console.log(res);
            });
        })
    </script>
{% endblock %}