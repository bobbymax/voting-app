@extends('layouts.app')


@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<a href="{{ route('criterias.create') }}" class="btn btn-primary mb-3">Add Criteria</a>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($criterias as $criteria)

							<tr>
								<td>{{ $criteria->name }}</td>
								<td>
									<a href="{{ route('criterias.edit', $criteria->id) }}" class="btn btn-warning">Edit</a>
								</td>
							</tr>

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection