<div class="row">
    <div class="col-sm-3 col-md-2">
        <img src="{{ user['avatar'] }}" class="img-circle" style="width: 100%;">
    </div>
    <div class="col-sm-9  col-md-10">
        <div class="panel panel-primary">
            <div class="panel-heading">用户详情</div>
            <table class="table table-bordered">
                <tr>
                    <td>昵称</td>
                    <td>{{ user['user_nicename'] }}</td>
                    <td>等级</td>
                    <td>{{ user['level'] }}</td>
                </tr>
                <tr>
                    <td>辣票</td>
                    <td>{{ user['votes'] }}/{{ user['votestotal'] }}</td>
                    <td>钻石</td>
                    <td>{{ user['coin'] }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

