<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> 
    Login :: {{settings('site_name')}}  
  </title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="{!! asset('img/favicon.ico') !!}" rel="icon" type="image/gif" sizes="16x16">
  <script src="/assets/js-core/modernizr.js"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="{{ elixir('base.css') }}">
  <script src="/assets/js-core/wow.js"></script>

  <script type="text/javascript">
      wow = new WOW({
          animateClass: 'animated',
          offset: 100
      });
      wow.init();
  </script>

  <style type="text/css">

      html,body {
          height: 100%;
          background: #fff;
          overflow: hidden;
          background-color: #ffd00d;
      }

  </style>

</head>
<body>

    <!--<img src="/assets/image-resources/blurred-bg/blurred-bg-10.jpg" class="login-img wow fadeIn" alt="">-->

    <div class="center-vertical">
        <div class="center-content row">

            <div>
            <center>
                  @if(settings('site_logo'))
                  <img src="{!! asset('img/logo.png') !!}" style="height: 84px; width: 190px;">
                  @else
                  <img src="/img/logo.png" style="height: 84px; width: 190px;" class="wow fadeIn">
                  @endif
                </center>
                <br>
              <!--<center>
              		<img src="{{asset('uploads/site/'.settings('site_logo')) }}">
              </center>-->
                <form role="form" method="POST" action="{{ route('login') }}" class="center-margin col-xs-11 col-sm-4">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="content-box wow bounceInDown modal-content">
                        <!--<h3 class="content-box-header content-box-header-alt bg-default">
                            <span class="icon-separator">
                                <i class="glyph-icon icon-cog"></i>
                            </span>
                            <span class="header-wrapper">
                                {{settings('site_name')}}
                                <small>Ingrese a su cuenta.</small>
                            </span>
                        </h3>-->

                        @if($errors->any())
                        <div class="alert alert-close alert-danger">
                            <a href="#" title="Close" class="glyph-icon alert-close-btn icon-remove"></a>
                            <div class="bg-red alert-icon">
                                <i class="glyph-icon fa fa-times fa-2x"></i>
                            </div>
                            <div class="alert-content">
                                <p>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                </p>
                            </div>
                        </div>
                        @endif
                        
                        <div class="content-box-wrapper">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Correo Electrónico:</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon addon-inside bg-white font-primary">
                                        <i class="glyph-icon icon-envelope-o"></i>
                                    </span>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Correo Electrónico" name="email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Contraseña:</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon addon-inside bg-white font-primary">
                                        <i class="glyph-icon icon-unlock-alt"></i>
                                    </span>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" name="password">
                                </div>
                            </div>

                            <button class="btn btn-success btn-block" style="background-color: #1b2f4c;border-color:#1b2f4c ">Entrar</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>
</html>
