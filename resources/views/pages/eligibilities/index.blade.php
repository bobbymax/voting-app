@extends('layouts.app')


@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<a href="{{ route('eligibilities.create') }}" class="btn btn-primary mb-3">Add Eligibility</a>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Category</th>
							<th>Grade Level</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($eligibilities as $eligibility)

							<tr>
								<td>{{ $eligibility->category->name }}</td>
								<td>{{ $eligibility->gradeLevel->key }}</td>
								<td>
									<a href="{{ route('eligibilities.edit', $eligibility->id) }}" class="btn btn-warning">Edit</a>
								</td>
							</tr>

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection