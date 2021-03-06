<!DOCTYPE html>
<html lang="zh">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,
      maximum-scale=1, user-scalable=no" />
  <title>首页 - 首页</title>
  <link rel="icon" href="" type="image/ico">
  <meta name="description" content="description">
  <link href="/vendor/ichynul/labuilder/lightyearadmin/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendor/ichynul/labuilder/lightyearadmin/css/materialdesignicons.min.css"
    rel="stylesheet">
  <link href="/vendor/ichynul/labuilder/lightyearadmin/js/bootstrap-multitabs/multitabs.min.css"
    rel="stylesheet">
  <link href="/vendor/ichynul/labuilder/lightyearadmin/css/style.min.css" rel="stylesheet">
  <link href="/vendor/ichynul/labuilder/lightyearadmin/js/jconfirm/jquery-confirm.min.css" rel="stylesheet">
  <style>
    .lyear-layout-header .navbar {
      min-height: 50px;
    }

    .topbar-right>li>a {
      padding: 2px 0px 2px 15px;
    }

    .icon-palette {
      height: 50px;
      line-height: 50px;
    }

    .topbar {
      min-height: 50px;
    }

    .img-avatar-44 {
      width: 44px;
      height: 44px;
      line-height: 44px;
    }

    .lyear-layout-content {
      padding-top: 50px;
      padding-left: 210px;
    }

    .lyear-layout-header {
      padding-left: 210px;
    }

    .nav-tabs.nav>li>a {
      padding: 5px 10px;
    }

    .mt-nav-tools-right .dropdown-toggle {
      padding-right: 40px;
    }

    .mt-dropdown .caret {
      top: 17px;
    }

    .nav-drawer>li>a {
      padding-bottom: 10px;
      padding-top: 10px;
    }

    .lyear-layout-sidebar {
      width: 210px;
    }

    .sidebar-header a img {
      margin: 0;
      min-height: 50px;
    }

    .mt-close-tab {
      top: 11px;
    }

    .lyear-layout-sidebar-scroll {
      height: calc(100% - 50px);
    }

    .topbar-right>li>a.link {
      display: block;
      height: 50px;
      line-height: 50px;
      font-size: 1.5em;
      cursor: pointer;
      text-align: center;
      padding: 0 5px;
    }
  </style>
</head>

<body>
  <div class="lyear-layout-web">
    <div class="lyear-layout-container">
      <!--左侧导航-->
      <aside class="lyear-layout-sidebar">

        <!-- logo -->
        <div id="logo" class="sidebar-header">
          <a href="#">
            <img src="/vendor/ichynul/labuilder/lightyearadmin/images/logo.png" >
          </a>
        </div>
        <div class="lyear-layout-sidebar-scroll">

          <nav class="sidebar-main"></nav>

          <div class="sidebar-footer">

          </div>
        </div>

      </aside>
      <!--End 左侧导航-->

      <!--头部信息-->
      <header class="lyear-layout-header">

        <nav class="navbar navbar-default">
          <div class="topbar">

            <div class="topbar-left">
              <div class="lyear-aside-toggler">
                <span class="lyear-toggler-bar"></span>
                <span class="lyear-toggler-bar"></span>
                <span class="lyear-toggler-bar"></span>
              </div>
              <span class="navbar-page-title">Admin</span>
            </div>

            <ul class="topbar-right">
              <li class="dropdown dropdown-profile">
                <a href="javascript:void(0)" data-toggle="dropdown">
                  <img class="img-avatar img-avatar-44 m-r-10"
                    src="/vendor/ichynul/labuilder/lightyearadmin/images/no-avatar.jpg"
                    alt="Admin" />
                  <span>Admin<span class="caret"></span></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li> <a class="open-tab" href="{{url('/admin/index/profile')}}"><i class="mdi
                          mdi-account"></i> 个人信息</a>
                  </li>
                  <li> <a class="open-tab" href="{{url('/admin/index/changepwd')}}"><i class="mdi
                          mdi-lock-outline"></i>
                      修改密码</a> </li>
                  <li> <a class="open-tab" href="{{url('/admin/index/clearcache')}}"><i class="mdi
                    mdi-delete"></i>清空缓存</a>
                  </li>
                  <li class="divider"></li>
                  <li> <a href="#" onclick="logout();"><i class="mdi
                          mdi-logout-variant"></i>注销登录</a> </li>
                </ul>
              </li>
              <!--切换主题配色-->
              <li class="dropdown dropdown-skin">
                <span data-toggle="dropdown" class="icon-palette"><i class="mdi mdi-palette"></i></span>
                <ul class="dropdown-menu dropdown-menu-right" data-stopPropagation="true">
                  <li class="drop-title">
                    <p>LOGO</p>
                  </li>
                  <li class="drop-skin-li clearfix">
                    <span class="inverse">
                      <input type="radio" name="logo_bg" value="default" id="logo_bg_1">
                      <label for="logo_bg_1"></label>
                    </span>
                    <span>
                      <input type="radio" name="logo_bg" value="color_2" id="logo_bg_2">
                      <label for="logo_bg_2"></label>
                    </span>
                    <span>
                      <input type="radio" name="logo_bg" value="color_3" id="logo_bg_3">
                      <label for="logo_bg_3"></label>
                    </span>
                    <span>
                      <input type="radio" name="logo_bg" value="color_4" id="logo_bg_4">
                      <label for="logo_bg_4"></label>
                    </span>
                    <span>
                      <input type="radio" name="logo_bg" value="color_5" id="logo_bg_5">
                      <label for="logo_bg_5"></label>
                    </span>
                    <span>
                      <input type="radio" name="logo_bg" value="color_6" id="logo_bg_6">
                      <label for="logo_bg_6"></label>
                    </span>
                    <span>
                      <input type="radio" name="logo_bg" value="color_7" id="logo_bg_7">
                      <label for="logo_bg_7"></label>
                    </span>
                    <span>
                      <input type="radio" name="logo_bg" value="color_8" id="logo_bg_8" checked>
                      <label for="logo_bg_8"></label>
                    </span>
                  </li>
                  <li class="drop-title">
                    <p>头部</p>
                  </li>
                  <li class="drop-skin-li clearfix">
                    <span class="inverse">
                      <input type="radio" name="header_bg" value="default" id="header_bg_1">
                      <label for="header_bg_1"></label>
                    </span>
                    <span>
                      <input type="radio" name="header_bg" value="color_2" id="header_bg_2">
                      <label for="header_bg_2"></label>
                    </span>
                    <span>
                      <input type="radio" name="header_bg" value="color_3" id="header_bg_3">
                      <label for="header_bg_3"></label>
                    </span>
                    <span>
                      <input type="radio" name="header_bg" value="color_4" id="header_bg_4">
                      <label for="header_bg_4"></label>
                    </span>
                    <span>
                      <input type="radio" name="header_bg" value="color_5" id="header_bg_5">
                      <label for="header_bg_5"></label>
                    </span>
                    <span>
                      <input type="radio" name="header_bg" value="color_6" id="header_bg_6">
                      <label for="header_bg_6"></label>
                    </span>
                    <span>
                      <input type="radio" name="header_bg" value="color_7" id="header_bg_7">
                      <label for="header_bg_7"></label>
                    </span>
                    <span>
                      <input type="radio" name="header_bg" value="color_8" id="header_bg_8" checked>
                      <label for="header_bg_8"></label>
                    </span>
                  </li>
                  <li class="drop-title">
                    <p>侧边栏</p>
                  </li>
                  <li class="drop-skin-li clearfix">
                    <span class="inverse">
                      <input type="radio" name="sidebar_bg" value="default" id="sidebar_bg_1">
                      <label for="sidebar_bg_1"></label>
                    </span>
                    <span>
                      <input type="radio" name="sidebar_bg" value="color_2" id="sidebar_bg_2">
                      <label for="sidebar_bg_2"></label>
                    </span>
                    <span>
                      <input type="radio" name="sidebar_bg" value="color_3" id="sidebar_bg_3">
                      <label for="sidebar_bg_3"></label>
                    </span>
                    <span>
                      <input type="radio" name="sidebar_bg" value="color_4" id="sidebar_bg_4">
                      <label for="sidebar_bg_4"></label>
                    </span>
                    <span>
                      <input type="radio" name="sidebar_bg" value="color_5" id="sidebar_bg_5">
                      <label for="sidebar_bg_5"></label>
                    </span>
                    <span>
                      <input type="radio" name="sidebar_bg" value="color_6" id="sidebar_bg_6">
                      <label for="sidebar_bg_6"></label>
                    </span>
                    <span>
                      <input type="radio" name="sidebar_bg" value="color_7" id="sidebar_bg_7">
                      <label for="sidebar_bg_7"></label>
                    </span>
                    <span>
                      <input type="radio" name="sidebar_bg" value="color_8" id="sidebar_bg_8" checked>
                      <label for="sidebar_bg_8"></label>
                    </span>
                  </li>
                </ul>
              </li>
              <li>
                <a title="打开首页" class="link" href="/" target="_blank"><i class="mdi mdi-home"></i></a>
              </li>
            </ul>

          </div>
        </nav>

      </header>
      <!--End 头部信息-->

      <!--页面主要内容-->
      <main class="lyear-layout-content">

        <div id="iframe-content"></div>

      </main>
      <!--End 页面主要内容-->
    </div>
  </div>
  <script type="text/javascript" src="/vendor/ichynul/labuilder/lightyearadmin/js/jquery.min.js"
    charset="utf-8"></script>
  <script type="text/javascript" src="/vendor/ichynul/labuilder/lightyearadmin/js/bootstrap.min.js"
    charset="utf-8"></script>
  <script type="text/javascript"
    src="/vendor/ichynul/labuilder/lightyearadmin/js/perfect-scrollbar.min.js" charset="utf-8">
    </script>
  <script type="text/javascript"
    src="/vendor/ichynul/labuilder/lightyearadmin/js/bootstrap-multitabs/multitabs.js"
    charset="utf-8">
    </script>
  <script type="text/javascript" src="/vendor/ichynul/labuilder/builder/js/layer/layer.js"
    charset="utf-8"></script>
  <script type="text/javascript"
    src="/vendor/ichynul/labuilder/lightyearadmin/js/bootstrap-notify.min.js"
    charset="utf-8"></script>
  <script type="text/javascript"
    src="/vendor/ichynul/labuilder/lightyearadmin/js/jconfirm/jquery-confirm.min.js" charset="utf-8"></script>
  <script type="text/javascript"
    src="/vendor/ichynul/labuilder/lightyearadmin/js/jquery.lyear.loading.js"
    charset="utf-8"></script>
  <script type="text/javascript" src="/vendor/ichynul/labuilder/lightyearadmin/js/lightyear.js"
    charset="utf-8"></script>
  <script type="text/javascript" src="/vendor/ichynul/labuilder/lightyearadmin/js/index.min.js"
    charset="utf-8"></script>

  <script>
    // 选项卡
    $('#iframe-content').multitabs({
      iframe: true,
      nav: {
        backgroundColor: '#ffffff',
        maxTabs: 35, // 选项卡最大值
      },
      init: [{
        type: 'main',
        title: 'Home',
        url: "{{url('/admin/index/welcome')}}"
      }]
    });
    /**
     * 菜单
     * @param data 菜单JSON数据
     *        id 菜单唯一ID
     *        name 菜单名称
     *        url 菜单链接地址
     *        icon 图标
     *        pid  父级ID
     *        is_out 是否外链0否|1是,外链a标签没有class='multitabs'
     *        is_home 是否首页
     */
    var setSidebar = function (data) {
      if (data.length == 0) {
        return false;
      }
      var treeObj = treeData(data, 'id', 'pid', 'children');
      html = createMenu(treeObj, true);
      $('.sidebar-main').append(html);
    }

    var createMenu = function (data, is_frist) {
      var menu_body = is_frist ? '<ul class="nav nav-drawer">' : '<ul class="nav nav-subnav">';

      for (var i = 0; i < data.length; i++) {
        iframe_class = data[i].is_out == 1 ? '' : 'class="multitabs"';
        //icon_div = data[i].pid == 0 ? '<i class="' + data[i].icon + '"></i>' : '';
        icon_div = data[i].pid == 0 ? '<i class="' + data[i].icon + '"></i>' : '<i class="' + data[i].icon +
          '"></i>&nbsp;';
        selected = (data[i].pid == 0) && (data[i].is_home == 1) ? 'active' : '';
        menuName = data[i].pid == 0 ? '<span>' + data[i].name + '</span>' : '<span>' + data[i].name + '</span>';
        if (data[i].children && data[i].children.length > 0) {
          menu_body += '<li class="nav-item' + (data[i].is_hidden == 1 ? ' hidden' : '') +
            ' nav-item-has-subnav"><a href="javascript:void(0)">' + icon_div +
            menuName + '</a>';
          menu_body += createMenu(data[i].children);
        } else {
          menu_body += '<li class="nav-item ' + selected + (data[i].is_hidden == 1 ? ' hidden' : '') + '"><a href="' +
            data[i].url + '" ' + iframe_class + '>' +
            icon_div + '<span>' + data[i].name + '</span>' + '</a>';
        }
        menu_body += '</li>';
      }

      menu_body += '</ul>';
      return menu_body;
    };

    window.logout = function () {
      layer.msg('确定要注销登录？', {
        time: 4000,
        btn: ['确定', '取消'],
        yes: function (params) {
          location.replace("{{url('/admin/login')}}");
        }
      });
    };

    /**
     * @author CSDN 蔚莱先森
     * @param source json数据源
     * @param id 主键ID
     * @param parendId 父级ID名称
     * @param children 子级名称
     */
    var treeData = function (source, id, parentId, children) {
      let cloneData = (typeof source == 'object') ? source : JSON.parse(source);
      return cloneData.filter(father => {
        let branchArr = cloneData.filter(child => father[id] == child[parentId]);
        branchArr.length > 0 ? father[children] = branchArr : ''
        return father[parentId] == 0
      })
    }
    // 使用

    var json_str = '@json($menus)';

    setSidebar(json_str);

    $('a.open-tab').click(function () {

      $.fn.multitabs().create(this, true);

      if ($(this).parents('.dropdown').size() && (toggle = $(this).parents('.dropdown').find('a:first'))) {
        $(this).parents('.dropdown .dropdown-menu li.active').removeClass('active');
        toggle.trigger('click');
      }

      return false;
    });
  </script>
</body>

</html>
