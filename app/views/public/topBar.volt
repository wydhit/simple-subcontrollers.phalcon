<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">辣椒直播 - API测试系统</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('/index/index') }}">首页</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        菜单 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/config/index') }}">配置信息</a></li>
                        <li><a href="{{ url('/user/index') }}">用户信息</a></li>
                        <li><a href="{{ url('/pet/index') }}">宠物信息</a></li>
                        <li><a href="{{ url('/broadcast/index') }}">直播信息</a></li>
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        设置 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/login/pfnLogout') }}">退出</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-right" action="{{ url('/index/search') }}">
                <input type="search" class="form-control" name="key" placeholder="Search...">
            </form>
        </div>
    </div>
</nav>