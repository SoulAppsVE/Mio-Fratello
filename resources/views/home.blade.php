@extends('app')

@section('htmlheader_title')
    Home
@endsection

@section('loader')
<div id="loading" style="top: -250px !important;">
  <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
  </div>
</div>
@stop

@section('main-content')

<div class="panel-body">
  
  <!--homepage design 1 (Chart Boxes)-->
  @if(settings('dashboard') == 'chart-box')
  <div class="row">
    <div class="col-md-4" >
        <div class="dashboard-box dashboard-box-chart bg-white content-box">
            <div class="content-wrapper">
                <div class="header" style="font-size: 20px !important;">
                    {{settings('currency_code')}}
                    {{bangla_digit($todays_stats['total_selling_price'] )}}

                    / Bs {{  number_format(($todays_stats['total_selling_price'] * $dolar),2,",","." ) }}
                    <small style="font-size: 12px !important;">
                      ({{trans('core.today')}})
                    </small>
                    <span>Ventas<b> ultimos 7 días</b></span>
                </div>
                <!--<div class="bs-label bg-primary">Ventas</div>-->
                <div class="center-div sparkline-big-alt">{{ $lastSevenDaySells}}</div>
                <div class="row list-grade">
                  @foreach($daynames as $dayname)
                    <div class="col-md-2" 
                      @if($dayname == Carbon\Carbon::now()->format('D'))
                        style="font-weight: bolder; color: blue;"  
                      @endif
                    >
                        {{$dayname}}
                    </div>
                  @endforeach
                    
                </div>
            </div>
            <div class="button-pane" style="background-color: #1b2f4c;">
                <div class="size-md float-left">
                  @if(auth()->user()->can('sell.manage'))
                    <a href="{{route('invoice.today')}}" style="color: white;">
                        Ver ordenes de hoy
                    </a>
                   @endif
                </div>
                @if(auth()->user()->can('sell.manage'))
                  <a class="btn btn-default float-right tooltip-button"  href="{{route('invoice.today')}}" class="tooltip-button" data-placement="bottom" title="Ver ordenes de hoy">
                      <i class="glyph-icon icon-caret-right"></i>
                  </a>
                @endif
            </div>
        </div>
    </div>
<!--
    <div class="col-md-4">
      <div class="dashboard-box dashboard-box-chart bg-white content-box">
          <div class="content-wrapper">
              <div class="header" style="font-size: 20px !important;">
                  {{settings('currency_code')}}
                  {{bangla_digit($todays_stats['total_purchasing_price'])}}

                  / Bs {{  number_format(($todays_stats['total_purchasing_price'] * $dolar),2,",","." ) }}
                  <small style="font-size: 12px !important;">
                    ({{trans('core.today')}})
                  </small>
                  <span>Compras<b> ultimos 7 días</b></span>
              </div>
              <div class="bs-label bg-purple">Compras</div>
              <div class="center-div sparkline-big-alt">{{$lastSevenDayPurchases}}</div>
              <div class="row list-grade">
                  @foreach($daynames as $dayname)
                    <div class="col-md-2" 
                      @if($dayname == Carbon\Carbon::now()->format('D'))
                        style="font-weight: bolder; color: blue;"  
                      @endif
                    >
                      {{$dayname}}
                    </div>
                  @endforeach
              </div>
          </div>
          <div class="button-pane" style="background-color: #1b2f4c;">
              <div class="size-md float-left">
                @if(auth()->user()->can('admins.manage'))
                  <a href="{{route('bill.today')}}" style="color: #FFF;">
                      Ver Facturas de Compras
                  </a>
                @endif 
              </div>
              @if(auth()->user()->can('admins.manage'))
                <a href="{{route('bill.today')}}" class="btn btn-default float-right tooltip-button" data-placement="top" title="" data-original-title="Ver facturas">
                    <i class="glyph-icon icon-caret-right"></i>
                </a>
              @endif
          </div>
      </div>
    </div>

    <div class="col-md-4">
        <div class="dashboard-box dashboard-box-chart bg-white content-box">
            <div class="content-wrapper">
                <div class="header" style="font-size: 20px !important;">
                    {{settings('currency_code')}}
                    {{bangla_digit($todays_stats['total_transactions_today'])}}

                    / Bs {{  number_format(($todays_stats['total_transactions_today'] * $dolar),2,",","." ) }}
                    <small style="font-size: 12px !important;">
                      ({{trans('core.today')}})
                    </small>
                    <span>Transacciones <b> ultimos 7 días </b></span>
                </div>-->
                <!--<div class="bs-label bg-green">Transacciones</div>
                <div class="center-div sparkline-big-alt">{{$lastSevenDayTransactions}}</div>
                <div class="row list-grade">
                    @foreach($daynames as $dayname)
                      <div class="col-md-2" 
                        @if($dayname == Carbon\Carbon::now()->format('D'))
                          style="font-weight: bolder; color: blue;"  
                        @endif
                      >
                        {{$dayname}}
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="button-pane" style="background-color: #1b2f4c;">
                <div class="size-md float-left">
                  @if(auth()->user()->can('sell.manage'))
                    <a href="{{route('transactions.today')}}" style="color: white;" >
                        Ver Transacciones Hoy
                    </a>
                   @endif 
                </div>
                @if(auth()->user()->can('sell.manage'))
                  <a href="{{route('transactions.today')}}" class="btn btn-default float-right tooltip-button" data-placement="bottom" title="Ver transacciones">
                      <i class="glyph-icon icon-caret-right"></i>
                  </a>
                @endif
            </div>
        </div>-->
    </div>
  </div>
  @endif
  <!-- Home design 1 ends -->

  <!-- Home design 2 (Tile box)-->
  @if(settings('dashboard') == 'tile-box')
  <div class="row ">
    
    <!--Total invoices today-->
    <div class="col-md-4 col-sm-6 col-xs-12 animated headShake">

      <div class="tile-box tile-box-alt {{settings('theme')}} font-white">
          <div class="tile-header">
              {{trans('core.today_sells')}}
          </div>
          <div class="tile-content-wrapper">
              <i class="glyph-icon fa fa-shopping-cart"></i>
              <div class="tile-content">
                <span>
                  {{bangla_digit($todays_stats['total_selling_quantity'])}}
                  {{trans('core.product')}}
                  <small>
                  (
                    {{settings('currency_code')}}
                    {{bangla_digit($todays_stats['total_selling_price'])}}
                  )
                  </small>
                </span>
              </div>
          </div>
          <a href="{{route('invoice.today')}}" class="tile-footer tooltip-button" data-placement="bottom" title="Mirar la factura">
              View Invoices
              <i class="glyph-icon icon-arrow-right"></i>
          </a>
      </div>

    </div> <!-- /.col -->
    <!--Ends-->


    <!--Total bills for today-->
    <div class="col-md-4 col-sm-6 col-xs-12 animated headShake">

      <div class="tile-box tile-box-alt bg-blue font-white">
          <div class="tile-header">
              {{trans('core.today_purchases')}}
          </div>
          <div class="tile-content-wrapper">
              <i class="glyph-icon fa fa-ship"></i>
              <div class="tile-content">
                <span>
                  {{bangla_digit($todays_stats['total_purchasing_quantity'])}}
                  {{trans('core.product')}}
                  <small>
                  (
                    {{settings('currency_code')}}
                    {{bangla_digit($todays_stats['total_purchasing_price'])}}
                  )</small>
                </span>
              </div>
          </div>
          <a href="{{route('bill.today')}}" class="tile-footer tooltip-button" data-placement="bottom" title="Ver facturas">
              Ver Facturas
              <i class="glyph-icon icon-arrow-right"></i>
          </a>
      </div>

   <!-- </div>  /.col -->
    <!--Total bill for today ends-->


    <!--Total cash received today
    <div class="col-md-4 col-sm-6 col-xs-12 animated headShake">
    
      <div class="tile-box tile-box-alt {{settings('theme')}} font-white">
          <div class="tile-header">
              {{trans('core.total_transactions_today')}}
          </div>
          <div class="tile-content-wrapper">
              <i class="glyph-icon fa fa-money"></i>
              <div class="tile-content">
                <span>
                  {!! settings('currency_code')!!} 
                  @if($todays_stats['total_transactions_today'] != null)
                    {{bangla_digit($todays_stats['total_transactions_today'])}}
                  @else
                    {{bangla_digit(0)}}
                  @endif
                </span>
                <small>&nbsp;</small>
              </div>
          </div>
          <a href="{{route('transactions.today')}}" class="tile-footer tooltip-button" data-placement="bottom" title="{{trans('core.view_details')}}">
              {{trans('core.view_details')}}
              <i class="glyph-icon icon-arrow-right"></i>
          </a>
      </div>
    </div> --><!-- /.col -->

    <!--Ends-->
  </div>
  @endif

  <!-- Home design 2 ends -->

  <hr />


  <!-- Chart -->
  <div class="row">
    <div class="col-md-6 col-xs-12" >
         @if(auth()->user()->can('admins.manage'))
        <div class="dashboard-box dashboard-box-chart bg-white content-box">
            <div class="content-wrapper">
                <div class="header">Ventas</div>
                <canvas id="sellsvspurchase"></canvas>
            </div>
        </div>
        @endif
    </div>
    <div class="col-md-6 col-xs-12" >
      @if(auth()->user()->can('admins.manage'))
      <div class="dashboard-box dashboard-box-chart bg-white content-box">
          <div class="content-wrapper">
            <div class="header">Valor de inventario</div>
            <canvas id="stockChart" ></canvas>
          </div>
      </div>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 col-xs-12">
      @if(auth()->user()->can('sell.manage'))
      <div class="dashboard-box dashboard-box-chart bg-white content-box">
          <div class="content-wrapper">
            <div class="header">Productos más vendidos</div>
            <canvas id="productChart"></canvas>
          </div>
      </div>
      @endif
    </div>
    
    <div class="col-md-6 col-xs-12">
      @if(auth()->user()->can('profit.graph'))
      <div class="dashboard-box dashboard-box-chart bg-white content-box">
          <div class="content-wrapper">
            <div class="header">Ganancias</div>
            <canvas id="profit"></canvas>
          </div>
      </div>
      @endif
    </div>

  </div>
  <!-- CHART ENDS--> 

  </div>

@endsection


@section('js')
  @parent
  <script type="text/javascript" src="/assets/js-core/sparklines.js"></script>
  <script type="text/javascript" src="/assets/js-core/sparklines-demo.js"></script>
  <script src="/assets/js-core/Chart.min.js"></script>
  <script src="/assets/js-core/chartjs-tooltip-show.js"></script>
  <script>
    
  /*Hot Products*/
    var ctx = document.getElementById("productChart");
    var obj = <?php echo json_encode($top_product_name); ?>;
    var obj2 = <?php echo json_encode($selling_quantity); ?>;
    var productChart = new Chart(ctx, {
        type: 'bar',
        data: {         
            labels: obj,
            datasets: [{
                label: 'Total Ventas',
                data: obj2,
                backgroundColor: [
                    'rgba(27, 47, 76, 0.4)',
                    'rgba(255, 208, 13, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    
                ],
                borderColor: [
                    'rgba(27, 47, 76, 1)',
                    'rgba(255, 208, 13, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            /*showAllTooltips: true,*/
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
            tooltips: {
              enabled: true,
                callbacks: {
                    label: function(tooltipItems, data) { 
                        return tooltipItems.yLabel + '';
                    }
                }
            }
        }
    });
    /* Hot Products ends */


    /*Pie chart for stock*/
    var ctx2 = document.getElementById("stockChart");
    var stock = <?php echo json_encode($stock); ?>;
    var stockChart = new Chart(ctx2, {
        type: 'pie',
        options: {
          /*showAllTooltips: true,*/
        },
        data: {         
            labels: [
                "Por Costo",
                "Por Precio",
                "Ganancia Estimada",
            ],
            datasets: [{
                data: stock,
                backgroundColor: [
                    "#1b2f4c",
                    "#5499C7",
                    '#FFD00D'
                ],
                hoverBackgroundColor: [
                    "#1b2f4c",
                    "#1A5276",
                    "#FFD00D"
                ]
            }]
        },
    });
    /*stock pie chart ends*/


    // Sell vs Purchase Chart
    var ctx3 = document.getElementById("sellsvspurchase");
    var months = <?php echo json_encode(array_reverse($months)); ?>;
    var sells = <?php echo json_encode(array_reverse($sells)); ?>;
    var chart = new Chart(ctx3, {
      type: 'bar',
      data: {
        labels: months,
        datasets: [{
          label: ["Ventas"],
          backgroundColor: "#1b2f4c",
          data: sells
        }]
      },

      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
        tooltips: {
          enabled: true,
            callbacks: {
                label: function(tooltipItems, data) { 
                    return '{{settings('currency_code')}} ' + tooltipItems.yLabel;
                }
            }
        },

        legend:{
          enabled:true
        },
      }
    });
    //ends

    //profit graph chart
    var profitChart = document.getElementById("profit");
    var profits = <?php echo json_encode(array_reverse($last_six_months_profit)); ?>;
    var chart = new Chart(profitChart, {
      type: 'line',
      data: {
          labels: months,
          datasets: [{
              label: "{{trans('core.profit')}}",
              data: profits,
              borderColor: 'rgba(102,165,226, 0.2)',
              backgroundColor: 'rgba(27,47,76, 0.7)',
              pointBorderColor: 'rgba(102,165,226, 0.5)',
              pointBackgroundColor: 'rgba(102,165,226, 0.2)',
              pointBorderWidth: 1
          }]
      },
      options: {
          responsive: true,
          legend: false,
          
      }
    });
  </script>


@stop
