@extends('layouts.app')


@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<a href="{{ route('canVotes.create') }}" class="btn btn-primary mb-3">Add Votables</a>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Category</th>
							<th>Grade Level</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($canVotes as $vote)

							<tr>
								<td>{{ $vote->category->name }}</td>
								<td>{{ $vote->gradeLevel->key }}</td>
								<td>
									<a href="{{ route('canVotes.edit', $vote->id) }}" class="btn btn-warning">Edit</a>
								</td>
							</tr>

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection