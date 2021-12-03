@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<form method="POST" action="{{ route('gradeLevels.update', $gradeLevel->id) }}">
					@csrf
					@method('PATCH')

					<div class="row">
						<div class="col-md-6 mb-5">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" value={{ $gradeLevel->name ?? old('name') }}>
							</div>
						</div>
						<div class="col-md-6 mb-5">
							<div class="form-group">
								<label for="key">Key</label>
								<input type="text" name="key" class="form-control" value={{ $gradeLevel->key ?? old('key') }}>
							</div>
						</div>

						<div class="col-md-12">
							<button type="submit" class="btn btn-primary">
								Update
							</button>
							<a href="{{ route('gradeLevels.index') }}" class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection