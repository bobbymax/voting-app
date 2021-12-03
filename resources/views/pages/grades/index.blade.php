@extends('layouts.app')


@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<a href="{{ route('gradeLevels.create') }}" class="btn btn-primary mb-3">Add Grade Level</a>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Name</th>
							<th>Key</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($grades as $grade)

							<tr>
								<td>{{ $grade->name }}</td>
								<td>{{ $grade->key }}</td>
								<td>
									<a href="{{ route('gradeLevels.edit', $grade->id) }}" class="btn btn-warning">Edit</a>
								</td>
							</tr>

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection