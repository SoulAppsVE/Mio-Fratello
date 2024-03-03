@extends('printer')

<style>
    thead tr th,
    tbody tr td {
        text-align: center;
        font-size: 11px !important;
        padding: 1 !important; /* Elimina el padding en todas las celdas */
    }
</style>

@section('main-content')
    <section class="invoice" style="margin-top: -5px;">
        <div class="row">
            <div class="col-sm-4" style="margin-left: 20px; padding-top: 50px;">
                @if(!empty(settings('site_logo')))
                    <!--<img src="{!! asset('img/logo.png') !!}" style="height: 60px; width: 150px;">-->
                @endif
                    <h4>{{settings('site_name')}}</h4>
                    <p>
                        <small>RIF: 123456</br>
                        {{ trans('core.phone') }}: {{ bangla_digit(settings('phone'))}}</br>
                        {{ bangla_digit(settings('address'))}}</br>
                        </small>
                    </p>
            </div>

            <div class="col-sm-3">
                <h3 class="" style="text-align: center;  padding: 10px; font-weight: bolder;font-size: 12px;">
                   <h3 class="" style="text-align: center;  padding: 10px; font-weight: bolder;font-size: 12px;">
                    <img src="{!! asset('img/logo.png') !!}" style="height: 60px; width: 150px;">
                   </h3>
                   <h4 class="" style="text-align: center;  padding: 5px; font-weight: bolder;font-size: 12px;">
                        Orden de Compra
                   </h4> 
                    @if(settings('vat_no'))
                        <small style="font-size: 10px;">{{trans('core.tin')}}: {{settings('vat_no')}}</small>
                    @endif
                </h3>
            </div>

            <div class="col-sm-4" style="margin-left: 20px; padding-top: 20px;">
                <table class="table table-bordered">
                    <tr>
                        <td style="padding: 0px;">Orden de Compra</td>
                        <td style="padding: 0px;">{{$transaction->reference_no}}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0px;">{{trans('core.date')}}</td>
                        <td style="padding: 0px;">
                            {{ date('d/m/Y h:i A', strtotime($transaction->sells->first()->date)) }}
                        </td>
                    </tr>
                </table>
                        <b><small>Cliente: {{$transaction->client->name}}</small></b></br>
                        <b><small>
                                @if($transaction->client->phone)
                                    {{trans('core.phone')}}: {{$transaction->client->phone}} </br>
                                @endif
                                @if($transaction->client->email)
                                    ,{{trans('core.email')}}: {{$transaction->client->email}}
                                @endif
                       </small></b>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 table-responsive" style="margin-left: 0px;">
                <table class="table table-bordered">
                    <thead style="background-color: #FFF !important;color: black !important;">
                    <tr style="font-size: 8px;padding: 0px;">
                        <th width="5%">N°</th>
                        <th width="15%">{{ trans('core.name') }}</th>
                        <th width="15%"> Unidades </th>
                        <th width="15%">{{ trans('core.unit_price') }}</th>
                        <th width="15%"> Total Unidades </th>
                        @if(settings('product_tax'))
                            <th class="text-center" width="15%">{{ trans('core.product_tax') }}</th>
                        @endif
                        <th width="20%">{{ trans('core.sub_total') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($transaction->sells as $sells)
                        <tr style="font-size: 8px;padding: 0px;">
                            <td style="padding: 0px;">{{$loop->iteration}}</td>
                            <td class="text-center" style="padding: 0px;">{{$sells->product->name}}</td>
                            <td class="text-center" style="padding: 0px;">
                                {{ bangla_digit($sells->quantity) }} {{$sells->product->unit}}
                            </td>
                            <td class="text-center" style="padding: 0px;">
                                @if($sells->quantity > 0)
                                    {{ twoPlaceDecimal($sells->sub_total / $sells->quantity) }}
                                @else
                                    0
                                @endif
                            </td>
                            <td class="text-center" style="padding: 0px;">
                                {{ twoPlaceDecimal($sells->sub_total)}}
                            </td>
                            @if(settings('product_tax'))
                                <td class="text-center" style="padding: 0px;">
                                    {{ twoPlaceDecimal($sells->product_tax)}}
                                </td>
                            @endif
                            <td class="text-center" style="padding: 0px;">
                                {{ twoPlaceDecimal($sells->sub_total + $sells->product_tax)}}
                            </td>
                        </tr>
                    @endforeach

                    <tr style="background-color: #F8FCD4;padding: 5px;">
                        <td></td>
                        <td style="padding: 0px;"><b>{{trans('core.total')}}</b></td>
                        <td><b>{{$total_quanity}}</b></td>
                        <td style="padding: 0px;"></td>
                        <td style="padding: 0px;">
                            <b>{{twoPlaceDecimal($transaction->total + $transaction->discount)}}</b>
                        </td>
                        @if(settings('product_tax'))
                            <td style="padding: 0px;">
                                <b>{{twoPlaceDecimal($transaction->total_tax - $transaction->invoice_tax)}}</b>
                            </td>
                        @endif
                        <td style="padding: 0px;">
                            <b>{{twoPlaceDecimal($transaction->total + $transaction->discount + ($transaction->total_tax - $transaction->invoice_tax))}}</b>
                        </td>
                    </tr>

                    @if($transaction->discount > 0)
                        <tr style="padding: 0px;">
                            <td colspan="{{sellDetailsColSpanNumber() + 1}}"
                                style="text-align: right; padding: 0px;">
                                <b>Descuento:</b>
                            </td>
                            <td style="padding: 0px;">
                                {{twoPlaceDecimal($transaction->discount)}}
                            </td>
                        </tr>
                    @endif

                    @if($transaction->invoice_tax > 0)
                        <tr style="padding: 0px;">
                            <td colspan="{{sellDetailsColSpanNumber() + 1}}"
                                style="text-align: right;padding: 0px">
                                <b>
                                    {{trans('core.invoice_tax')}}
                                    ({{orderTax()}}
                                    @if($transaction->return != 1) of {{$transaction->total + $transaction->total_tax - $transaction->invoice_tax}}) @endif
                                </b>
                            </td>
                            <td>
                                {{twoPlaceDecimal($transaction->invoice_tax)}}
                            </td>
                        </tr>
                    @endif

                    <tr style="padding: 0px;">
                        <td colspan="{{sellDetailsColSpanNumber() + 1}}"
                            style="text-align: right; padding: 0px;">
                            <b>{{trans('core.net_total')}}:</b>
                        </td>
                        <td>
                            {{twoPlaceDecimal($transaction->net_total)}}
                        </td>
                    </tr>

                    <tr style="padding: 5px;">
                        <td colspan="{{sellDetailsColSpanNumber() + 1}}"
                            style="text-align: right; padding: 0px;">
                            <b>{{trans('core.paid')}}:</b>
                        </td>
                        <td>
                            {{twoPlaceDecimal($transaction->paid)}}
                        </td>
                    </tr>

                    @if($transaction->net_total - $transaction->paid != 0)
                        <tr style="padding: 5px;">
                            <td colspan="{{sellDetailsColSpanNumber() + 1}}"
                                style="text-align: right; padding: 0px;">
                                <b>{{trans('core.due')}}:</b>
                            </td>
                            <td>
                                {{twoPlaceDecimal($transaction->net_total - $transaction->paid)}}
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" style="margin: 0px;">
                <span class="declaration_header">NOTA :</span>
                <p style="text-align: justify;font-size: 9px;">{{settings('pos_invoice_footer_text')}}</p>
            </div>
        </div>
    </section>
@stop
