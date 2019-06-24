@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="page-title">@lang('global.customers.title')</h4>
        </div>

        <div class="panel-body table-responsive">
            <table id="customers_data" class="table table-bordered table-striped  ">
                <thead>
                    <tr>
                        <th>@lang('global.customers.fields.sno')</th>
                        <th>@lang('global.customers.fields.name')</th>
                        <th>@lang('global.customers.fields.email')</th>
                        <th>@lang('global.customers.fields.registered_date')</th>
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
    $('#customers_data').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('getCustomersData') }}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',"searchable": false,"orderable":false},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
        ]
    });
});
</script>
@endsection
