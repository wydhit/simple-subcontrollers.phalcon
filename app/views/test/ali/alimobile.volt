{% extends "test/weui.volt" %}
{% block content %}
    <div id="state"></div>
{% endblock %}
{% block js %}
    <script>
        document.write(1);
        document.addEventListener('AlipayJSBridgeReady', function () {
            document.write(typeof AlipayJSBridge);
            document.write("AlipayJSBridgeReady");
        }, false);

        AlipayJSBridge.call('openAPDeviceLib', {'connType': 'blue'}, function (res) {
            console.log('openAPDeviceLib', JSON.stringify(res));
            document.write("openAPDeviceLib----");
            document.write(JSON.stringify(res));
        });
    </script>
{% endblock %}