{% extends "test/weui.volt" %}
{% block content %}
    <div class="weui-cells__title">日志信息</div>
    <div class="weui-cells" id="logs">
    </div>
{% endblock %}
{% block js %}
    <script>
        function push(msg) {
            var item = '        <div class="weui-cell">\
                <div class="weui-cell__bd">\
                <p>' + msg + '</p>\
                </div>\
                </div>';
            $("#logs").append(item);
        }

        document.addEventListener('AlipayJSBridgeReady', function () {
//            push(typeof AlipayJSBridge);
            push("AlipayJSBridgeReady");
        }, false);

        AlipayJSBridge.call('openAPDeviceLib', {'connType': 'blue'}, function (res) {
            console.log('openAPDeviceLib', JSON.stringify(res));
            push("openAPDeviceLib");
            push(JSON.stringify(res));
        });
    </script>
{% endblock %}