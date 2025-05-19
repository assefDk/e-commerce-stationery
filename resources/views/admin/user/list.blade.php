@extends('admin.layouts.app')


 

@section('content')
 
    <div class="card-body">
        @include('admin.message')
        <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
            <div class="datatable-top">
            
            <div class="">
            </div>

            <div class="datatable-search">
                <form action="{{ route('user.index') }}" method="GET">
                    <button type="button" onclick="window.location.href='{{ route("user.index") }}'" class="btn btn-default btn-sm">Reset</button>
                    <input class="datatable-input" value="{{ Request::get('Keyword') }}" placeholder="Search..." type="text" id="Keyword" name="Keyword" title="Search within table">
                    <button type="submit" class="btn btn-success">Search</button>
                </form> 
            </div>
        </div>
        <div class="datatable-container">
            <table class="table datatable datatable-table">
                <thead>
                    <tr>
                        <th data-sortable="true" style="width: 20.86466165413534%;">
                            <button class="datatable-sorter">Name</button>
                        </th>
                        <th data-sortable="true" style="width: 20.86466165413534%;">
                            <button class="datatable-sorter">Email</button>
                        </th> 
                        <th data-sortable="true" class="red" style="width: 22.55639097744361%;">
                            <button class="datatable-sorter">Action</button>
                        </th>   
                    </tr>
                </thead>
             <tbody>
                @if ($users->isNotEmpty())
                @foreach ($users as $user)
                <tr data-index="0">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="#"  onclick="deleteUser({{ $user->id }})" class="text-danger w-4 h-4 mr-1">
                            {{-- <a href="#" class="text-danger w-4 h-4 mr-1"> --}}
                            <svg wire:loading.remove.delay="" style="height: 30px;width: 30px;"  wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
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
    function deleteUser(id) {

        var url = '{{ route('user.destroy',"ID")}}'
        var newUrl = url.replace("ID",id);



        if(confirm("Are you suer you want to delete")){
            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {} ,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },success: function(response) {
                    if(response["status"]){
                        window.location.href = "{{ route("user.index") }}";
                    }

                }

            });
        }

}
</script>

@endsection





