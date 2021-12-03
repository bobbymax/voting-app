@extends('layouts.app')


@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<a href="{{ route('weights.create') }}" class="btn btn-primary mb-3">Add Voting Weight</a>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Category</th>
							<th>Criteria</th>
							<th>Value</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($weights as $weight)

							<tr>
								<td>{{ $weight->category->name }}</td>
								<td>{{ $weight->criteria->name }}</td>
								<td>{{ $weight->value }}</td>
								<td>
									<a href="{{ route('weights.edit', $weight->id) }}" class="btn btn-warning">Edit</a>
								</td>
							</tr>

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection