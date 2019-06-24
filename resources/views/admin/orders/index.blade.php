@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="page-title">@lang('global.orders.title')</h4>
        </div>

        <div class="panel-body table-responsive">
            <table id="order_data" class="table table-bordered table-striped  ">
                <thead>
                    <tr>
                        <th>@lang('global.orders.fields.sno')</th>
                        <th>Order Date</th>
                        <th>@lang('global.orders.fields.customer_name')</th>
                        <th>@lang('global.orders.fields.total_amount')</th>
                        <th>@lang('global.orders.fields.status')</th>
                        <th>@lang('global.orders.fields.action')</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#order_data').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('getOrdersData') }}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',"searchable": false,"orderable":false},
            {data: 'order_date', name: 'order_date'},
            {data: 'name', name: 'name',searchable: true},
            {data: 'total_amount', name: 'total_amount'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
        ]
    });
});
</script>
@endsection
