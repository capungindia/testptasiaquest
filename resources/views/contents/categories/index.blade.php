@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categories</div>

                <div class="card-body">
                	<div class="btn btn-group">
	                	<a class="btn btn-sm btn-success" href="{{ route('category.create') }}">
	                        New
	                    </a>

	                    <a class="btn btn-sm btn-danger" href="#" onclick="batchDelete(event)">
	                        Batch Delete
	                    </a>
                    </div>

                    <table class="table table-striped table-hover" id="categories-table" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama</th>
								<th>Deskripsi</th>
								<th>Kelola</th>
							</tr>
						</thead>

						<tbody>
							@if(count($categories) == 0)
								<tr>
									<td colspan='4'>
										Belum ada data kategori tersimpan
									</td>
								</tr>
							@else
								@foreach($categories as $category)
									<tr>
										<td>
											<input type='checkbox' class='categoryids' value='{{ $category->id }}'/>
										</td>
										<td>{{ $category->name }}</td>
										<td>{{ $category->description }}</td>
										<td>
											<div class="btn btn-group">
	                                            <a class="btn btn-sm btn-warning" href="{{ route('category.change') }}?categoryid={{ $category->id }}">
	                                                Edit
	                                            </a>
	                                            <a class="btn btn-sm btn-danger" href="{{ route('category.delete') }}?categoryid={{ $category->id }}">
	                                                Delete
	                                            </a>
	                                        </div>
										</td>
									</tr>
								@endforeach
							@endif
						</tbody>
					</table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	function batchDelete(event){
		event.preventDefault();

		var categoryboxes = $("#categories-table .categoryids");

		$.each(categoryboxes, function(idx, categorybox){
			if($(categorybox).prop('checked')){
				categoryid = $(categorybox).val();

				$.ajax({
	    			url 	: "{{ route('category.delete') }}",
	    			type 	: "GET",
	    			data	: {
	    				_token 		: "{{ csrf_token() }}",
	    				categoryid 	: categoryid,
	    			},
	    			success	: function(result){
	    				$(categorybox).parent().parent().remove();

	    				if(idx == categoryboxes.length - 1){
	    					location.reload();
	    				}
	    			},
	    		});
			}
		});
	}
</script>
@endsection