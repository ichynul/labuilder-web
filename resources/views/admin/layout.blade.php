<!DOCTYPE html>
<html lang="zh">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no" />
  <title>{{$admin_page_position??'后台'}} - {{$admin_page_title??'后台'}}</title>
  <link rel="icon" href="{{$admin_favicon??''}}" type="image/ico">
  <meta name="description" content="{{$admin_page_description??''}}">
  <meta name="csrf-token" content="{{$__token__??''}}">
  @if(isset($admin_css) && $admin_css)
  @foreach($admin_css as $item)
  <link href="{{$item}}" rel="stylesheet">
  @endforeach
  @endif
  @yield('style')
  <style>
    .lyear-layout-content {
      padding-left: 0;
      padding-top: 0;
    }

    .lyear-layout-content .container-fluid {
      height: 100%;
      padding-left: 8px;
      padding-right: 8px;
      padding-top: 5px;
    }

    .container-fluid .content {
      min-height: 100%;
      margin-bottom: 0;
    }
  </style>
</head>

<body>
  <!--页面主要内容-->
  <main class="lyear-layout-content">
    <div class="container-fluid">
      @yield('content')
    </div>
  </main>
  <!--End 页面主要内容-->
  @if(isset($admin_js) && $admin_js)
  @foreach($admin_js as $item)
  <script type="text/javascript" src="{{$item}}" charset="utf-8"></script>
  @endforeach
  @endif
  <script>
    window.__token__ = "{{$__token__??''}}";
  </script>
  @yield('script')
</body>

</html>
