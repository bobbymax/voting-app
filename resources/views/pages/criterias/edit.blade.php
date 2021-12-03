@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<form method="POST" action="{{ route('criterias.update', $criteria->id) }}">
					@csrf
					@method('PATCH')

					<div class="row">
						<div class="col-md-12 mb-3">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" value={{ $criteria->name }}>
							</div>
						</div>

						<div class="col-md-12">
							<button type="submit" class="btn btn-primary">
								Update
							</button>
							<a href="{{ route('criterias.index') }}" class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection