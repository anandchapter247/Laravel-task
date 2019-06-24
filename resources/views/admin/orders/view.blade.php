@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        @if (count($order_data) > 0)
        <div class="panel-heading">
           <h4 class="page-title main_order_detail">@lang('global.order_detail.title')</h4>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                  <p class="main_order_detail">
                    @lang('global.order_detail.fields.customer_name') : {{ $order_data[0]->customer_name or ''}}
                  </p>
                  <p class="main_order_detail"> 
                    @lang('global.order_detail.fields.customer_email') : {{ $order_data[0]->email  or ''}}
                  </p>
                </div>
                <div class="col-sm-4">
                    <p class="main_order_detail">   
                      @lang('global.order_detail.fields.invoice_number') : {{ $order_data[0]->invoice_number  or ''}}
                    </p>
                    <p class="main_order_detail">
                      @lang('global.order_detail.fields.total_amount') : {{ $order_data[0]->total_amount  or ''}}
                    </p>
                </div>
                <div class="col-sm-4">
                    <p class="main_order_detail">
                      @lang('global.order_detail.fields.order_date') : {{ $order_data[0]->order_date  or ''}}
                    </p>
                    <p class="main_order_detail">
                      @lang('global.order_detail.fields.status') : {{ $order_data[0]->status  or ''}}
                    </p>
                </div>
            </div>
        </div>
        <div class="panel-heading">
            <p class="main_order_detail">@lang('global.order_detail.product_title')</p>
        </div>
        <div class="panel-body table-responsive">
            <table id="order_data" class="table table-bordered table-striped  ">
                <thead>
                    <tr>
                        <th>@lang('global.order_detail.fields.product_name')</th>
                        <th>@lang('global.order_detail.fields.price')</th>
                        <th>@lang('global.order_detail.fields.quantity')</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($order_data as $order)
                    <tr>
                        <td>{{ $order->product_name }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->quantity }}</td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
        @else
           <center>
            <h4 class="main_order_detail">
                @lang('global.order_detail.no_record_found')
            </h4>
           </center>
        @endif
    </div>
@stop

