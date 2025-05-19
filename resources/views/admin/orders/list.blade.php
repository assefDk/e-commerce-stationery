@extends('admin.layouts.app')


 

@section('content')
 

    <style>
        tr.clickable-row {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        tr.clickable-row:hover {
            background-color: #4b4e51;  
            transform: scale(1.01); 
        }
    </style>

    <div class="card-body">
        
        <!-- Table with stripped rows -->
        @include('admin.message')
        <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
            <div class="datatable-top">
            <div class="datatable-dropdown">
                <button type="button" onclick="window.location.href='{{ route("orders.index") }}'" class="btn btn-default btn-sm btn-primary">Reset</button>
            </div>
            <div class="datatable-search">
                
                <form action="{{ route('orders.index') }}" method="GET">
                    <input class="datatable-input" value="{{ Request::get('Keyword') }}" placeholder="Search..." type="text" id="Keyword" name="Keyword" title="Search within table">
                    <button type="submit" class="btn btn-success">Search</button>
                </form> 
            </div>
        </div>
        <div class="datatable-container">
            <table class="table datatable datatable-table">
                <thead>
                    <tr>
                        <th data-sortable="true" style="width: 15.86466165413534%;">
                            <button class="datatable-sorter">Customer</button>
                        </th>
                        <th data-sortable="true" style="width: 20.86466165413534%;">
                            <button class="datatable-sorter">Email</button>
                        </th>
                        <th data-sortable="true" style="width: 20.86466165413534%;">
                            <button class="datatable-sorter">Phone</button>
                        </th>
                        <th data-sortable="true" class="red" style="width: 22.55639097744361%;">
                            <button class="datatable-sorter">Date Purchased</button>
                        </th>   
                    </tr>
                </thead>
             <tbody>
                @if ($orders->isNotEmpty())
                @foreach ($orders as $order)
                    <tr class="clickable-row" data-index="0" onclick="window.location='{{ route('orders.detail', $order->id) }}'" style="cursor: pointer;">
                            
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->mobile }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}
                        </td>
                    
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="5">Record Not Found</td>
                    </tr>
                @endif
             </tbody>
        </table>
        </div>
            <div class="datatable-bottom">
                
            </div>
        </div>
            <!-- End Table with stripped rows -->

    </div>
@endsection



@section('customJs')
<script>

</script>

@endsection


