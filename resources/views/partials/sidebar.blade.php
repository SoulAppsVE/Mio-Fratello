<div id="page-sidebar" class="@if(settings('theme')) @else bg-gradient-1 @endif font-inverse"  style="background-color:#1B2F4C;" >
  <div class="scroll-sidebar">
        
    <ul id="sidebar-menu">
          
        <li @if(currentRoute()=="home") class="no-menu active" @else class="no-menu" @endif>
            <a href="{{ route('home') }}">
                <i class='fa fa-th'></i> 
                <span>Inicio</span>
            </a>
        </li>
        @if(auth()->user()->can('category.view'))
        <li @if(currentRoute()=="category.index") class="no-menu active" @else class="no-menu" @endif>
            <a href="{{route('category.index')}}">
                <i class='fa fa-tag'></i>
                <span>{{ trans('core.category')}}</span>
            </a>
        </li>
        @endif
        @if(auth()->user()->can('product.view'))
        <li>
            <a href="#">
                <i class='fa fa-cubes'></i> 
                <span>{{ trans('core.product')}}</span>
            </a>

            <div class="sidebar-submenu">
                <ul>
                    <li>
                        <a href="{{route('product.index')}}">
                            <i class=''></i> 
                            <span>Lista de Productos</span>
                        </a>
                    </li>
       <!--             @if(auth()->user()->can('product.create'))
                    <li>
                        <a href="{{route('product.new')}}">
                            <i class=''></i> 
                            <span>Crear Producto </span>
                        </a>
                    </li>
                    @endif-->
                </ul>
            </div>
        </li>
        @endif
        @if(auth()->user()->can('customer.view'))
        <li>
            <a href="#"><i class='fa fa-users'></i> <span>Usuarios</span></a>

            <div class="sidebar-submenu">
                <ul>
                    @if(auth()->user()->can('customer.view'))
                    <li>
                        <a href="{{route('client.index')}}">
                            <i class=''></i> 
                            <span>{{ trans('core.customer')}}</span>
                        </a>
                    </li>
                    @endif
             <!--       @if(auth()->user()->can('supplier.view'))
                    <li>
                        <a href="{{route('purchaser.index')}}">
                            <i class=''></i> 
                            <span>{{ trans('core.supplier')}} </span>
                        </a>
                    </li>
                    @endif-->
                    @if(auth()->user()->can('user.manage'))
                    <li>
                        <a href="{{route('user.index')}}">
                            <i class=''></i> 
                            <span>{{ trans('core.user')}} </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>
        @endif
 <!--       @if(auth()->user()->can('purchase.view'))
        <li >
            <a href="#"><i class="fa fa-ship"></i> <span>{{ trans('core.purchase')}}</span></a>
            <div class="sidebar-submenu">
                <ul>
                    <li>
                        <a href="{{route('purchase.index')}}">
                            <span>Lista de Compras</span>
                        </a>
                    </li>
                    @if(auth()->user()->can('purchase.create'))
                    <li>
                        <a href="{{route('purchase.item')}}">
                            <span>Crear Compra</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>
        @endif-->
        @if(auth()->user()->can('sell.view'))
        <li>
            <a href="#"><i class="fa fa-shopping-cart"></i> <span>{{ trans('core.sell')}}</span></a>
            <div class="sidebar-submenu">
                <ul>
                    <li>
                        <a href="{{route('sell.index')}}">
                            <span>Lista de Ventas</span>
                        </a>
                    </li>
      <!--              @if(auth()->user()->can('sell.create'))
                    <li>
                        <a href="{{route('sell.form')}}">
                            <span>Crear Venta</span>
                        </a>
                    </li>
                    @endif-->
                </ul>
            </div>
        </li>
         @endif 
         @if(auth()->user()->can('admins.manage'))
        <li>
            <a href="#"><i class="fa fa-cog"></i><span> {{ trans('core.settings')}}</span></a>
            <div class="sidebar-submenu">
                <ul>
                    <li>
                        <a href="{{route('settings.index')}}">
                            <span>Configuración General</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('role.index')}}">
                            <span>Permisos y Roles</span>
                        </a>
                    </li>
         <!--           <li>
                        <a href="{{route('tasa.index')}}">
                            <span>Tasa Dolar</span>
                        </a>
                    </li> -->
                </ul>
            </div>
        </li> 
        @endif

        @if(auth()->user()->can('report.view'))
        <li class="no-menu">
            <a href="{{route('report.index')}}">
               <i class="fa fa-pie-chart"></i>                  
                <span>{{ trans('core.report')}}</span>
            </a>
        </li>
        @endif
    </ul><!-- #sidebar-menu -->
  </div>
</div>
