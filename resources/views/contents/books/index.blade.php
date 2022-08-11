@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Books</div>

                <div class="card-body">
                	<div class="btn btn-group">
	                	<a class="btn btn-sm btn-success" href="{{ route('book.create') }}">
	                        New
	                    </a>

	                    <a class="btn btn-sm btn-danger" href="#" onclick="batchDelete(event)">
	                        Batch Delete
	                    </a>
                    </div>

                    <table class="table table-striped table-hover" id="books-table" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Judul</th>
								<th>Deskripsi</th>
								<th>Kategori</th>
								<th>Kata Kunci</th>
								<th>Harga</th>
								<th>Stok</th>
								<th>Penerbit</th>
								<th>Kelola</th>
							</tr>
						</thead>

						<tbody>
							@if(count($books) == 0)
								<tr>
									<td colspan='9'>
										Belum ada data buku tersimpan
									</td>
								</tr>
							@else
								@foreach($books as $book)
									<tr>
										<td>
											<input type='checkbox' class='bookids' value='{{ $book->id }}'/>
										</td>
										<td>{{ $book->title }}</td>
										<td>{{ $book->description }}</td>
										<td>
											@foreach($book->categories as $category)
												{{ $category->category->name }} ,
											@endforeach
										</td>
										<td>
											@foreach($book->keywords as $keyword)
												{{ $keyword->name }} ,
											@endforeach
										</td>
										<td>{{ $book->price }}</td>
										<td>{{ $book->stock }}</td>
										<td>{{ $book->publisher }}</td>
										<td>
											<div class="btn btn-group">
	                                            <a class="btn btn-sm btn-warning" href="{{ route('book.change') }}?bookid={{ $book->id }}">
	                                                Edit
	                                            </a>
	                                            <a class="btn btn-sm btn-danger" href="{{ route('book.delete') }}?bookid={{ $book->id }}">
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


		var bookboxes = $("#books-table .bookids");

		$.each(bookboxes, function(idx, bookbox){
			if($(bookbox).prop('checked')){
				bookid = $(bookbox).val();

				$.ajax({
	    			url 	: "{{ route('book.delete') }}",
	    			type 	: "GET",
	    			data	: {
	    				_token 		: "{{ csrf_token() }}",
	    				bookid 		: bookid,
	    			},
	    			success	: function(result){
	    				$(bookbox).parent().parent().remove();

	    				if(idx == bookboxes.length - 1){
	    					location.reload();
	    				}
	    			},
	    		});
			}
		});
	}
</script>
@endsection