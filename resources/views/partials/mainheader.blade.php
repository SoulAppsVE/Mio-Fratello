<div id="page-header" class="@if(settings('theme')) @else bg-gradient-1 @endif "  style="background-color:#ffd00d;" >
    
    <div id="mobile-navigation">
        <button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target="#page-sidebar"><span></span></button>
        <a href="{{ url('/') }}" class="logo-content-small" title="{{settings('site_name')}}"></a>
    </div>

    <div id="header-logo" class="logo-bg">
        <a href="{{ url('/') }}" class="logo-content-big text-center" style="width: 100%;padding:20px;left:50px" title="{{settings('site_name')}}">
        </a>
        <!--<a href="{{ url('/') }}" >
            <img src="{!! asset('img/logo.png') !!}" style="height: 60px; width: 150px;padding-top:5px ;">
        </a>-->
        <a href="{{ url('/') }}" class="logo-content-small" title="{{settings('site_name')}}">
            {{ settings('site_name') }}
            <!--<span>{{ settings('site_slogan') }}</span>-->
        </a>
        <a id="close-sidebar" href="#" title="Close sidebar">
            <i class="glyph-icon icon-angle-left" style="color:#1b2f4c "></i>
        </a>
    </div>

    <div id="header-nav-left">
        <div class="user-account-btn dropdown">
            <a href="#" title="Mi Cuenta" class="user-profile clearfix" data-toggle="dropdown">
                @if(!user() || !user()->image )
                  <img src="{{asset('img/default.png')}}" class="user-image" alt="" />
                @else
                  <img src="{!! asset('uploads/profiles/'. user()->image)!!}" class="user-image" alt="{{ user()->first_name }}" />
                @endif
                <span style="display: block; height: 20px;color:#000">@if(user()) {{ user()->first_name }} @endif</span>
                <i class="glyph-icon icon-angle-down" style="color:#1b2f4c "></i>
            </a>
            <div class="dropdown-menu float-left">
                <div class="box-sm">
                    <div class="login-box clearfix">
                        <div class="user-img">
                            <a href="#" title="" class="change-img">Cambiar Foto</a>
                            @if(!user() || !user()->image )
                              <img src="{{ asset('img/default.png') }}" class="user-image" alt="" />
                            @else
                              <img src="{!! asset('uploads/profiles/'. user()->image)!!}" class="user-image" alt="{{ user()->first_name }}"/>
                            @endif
                        </div>
                        <div class="user-info">
                            <span>
                              @if(user())
                                  {{ user()->first_name }} 
                                  {{ user()->last_name }}
                              @else
                                  Not logged in
                              @endif
                            </span>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <ul class="reset-ul mrg5B">
                        <li>
                            <a href="{{route('user.profile')}}">
                                <i class="glyph-icon float-right icon-caret-right"></i>
                                Ver detalles de la cuenta
                            </a>
                        </li>
                    </ul>
                    <div class="pad5A button-pane button-pane-alt text-center">
                        <a href="{{ url('logout') }}" class="btn display-block font-normal btn-danger">
                            <i class="glyph-icon icon-power-off"></i>
                            {{ trans('core.sign_out') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- #header-nav-left -->

    <div id="header-nav-right">


        <!--Notification-->
        <?php
            $products = App\Product::orderBy('name', 'asc')->select('name', 'quantity', 'alert_quantity', 'unit')->take(5)->get();
            $alert_products = [];
            foreach($products as $product){
                $alert_quantity = $product->alert_quantity;
                if($alert_quantity >= $product->quantity){
                    $alert_products[] = $product->name." = ".$product->quantity." ".$product->unit;
                }
                continue;
            }
        ?>
        
        <!--<div class="dropdown hidden-xs" id="notifications-btn" >
            <a 
                data-toggle="dropdown" 
                href="#" 
                data-placement="bottom" 
                title="Alerta de Productos" 
                class="tooltip-button" 
                 style="border-color: #000;"
                @if(count($alert_products) > 0) 
                    style="background-color: #FFE941CC !important;" 
                @endif
            >
                <i class="glyph-icon icon-linecons-megaphone" 
                    @if(count($alert_products) > 0) 
                        style="color: red;text-shadow: 1px 1px 1px #ccc;"
                    @endif>
                </i>
            </a>

            <div class="dropdown-menu @if(rtlLocale()) dropdown-menu-right @else float-right @endif box-md">
                <div class="popover-title display-block clearfix pad10A">
                    {{trans('core.alert_title')}}
                    {{count($alert_products)}}
                    {{trans('core.product')}}
                </div>
                   
                <div class="scrollable-content scrollable-slim-box">
                    <ul class="no-border notifications-box">
                        @foreach($alert_products as $product_alert)
                        <li>
                            <ul>
                                <li><span class="bg-danger icon-notification glyph-icon icon-bullhorn"></span> 
                                {{$product_alert}}
                                </li>
                           </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="pad10A button-pane button-pane-alt text-center">
                    <a href="{{route('product.alert')}}" class="btn btn-primary" title="View all notifications">
                        Ver todas las notificaciones
                    </a>
                </div>
            </div>
        </div>-->
        <!--Notification Ends-->
        <!--Notification Ends-->
    </div><!-- #header-nav-right -->
</div><!-- header ends -->



<!-- Modal for cash register, if cash if not opened yet -->
<div class="modal fade" id="myCashStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="{{route('cash_register.post')}}">
        {{csrf_field()}}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
            {{trans('core.cash_is_not_open_yet')}}
        </h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>
                {{trans('core.cash_open_label')}}
            </label>
            <input type="text" class="form-control" name="cash_in_hands" value=0 onkeypress='return event.charCode <= 57 && event.charCode != 32'>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary">
            Save changes
        </button>
        
      </div>
      </form>
    </div>
  </div>
</div>
<!--Modal ends-->


<script>
    function profitCalc() {
        var profit = {{todayProfit()}};
       swal({
          title: {!! json_encode(trans('core.todays_profit')) !!},
          text: "{{settings('currency_code')}} " + profit,
          imageUrl: '/img/profit.jpeg',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Details',
          cancelButtonText: 'Close!',
          buttonsStyling: true
        }).then(function () {
          window.location.href = {!! json_encode(route("profit.details")) !!};
        }, function (dismiss) {
          // dismiss can be 'cancel', 'overlay',
          // 'close', and 'timer'
          if (dismiss === 'close') {
            swal(
              'close',
              'Done',
              'error'
            )
          }
        })
    }

    function cashCalc() {
        var cash = {{cashNow()}};
       swal({
          title: {!! json_encode(trans('core.now_in_cash')) !!},
          text: "{{settings('currency_code')}} "+ cash,
          imageUrl: '/img/cash.jpg',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Details',
          cancelButtonText: 'Close!',
          buttonsStyling: true
        }).then(function () {
          window.location.href = {!! json_encode(route("cash.details")) !!};
        }, function (dismiss) {
          // dismiss can be 'cancel', 'overlay',
          // 'close', and 'timer'
          if (dismiss === 'close') {
            swal(
              'close',
              'Done.',
              'error'
            )
          }
        })
    }
</script>

