@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<form method="POST" action="{{ route('categories.update', $category->id) }}">
					@csrf
					@method('PATCH')

					<div class="row">
						<div class="col-md-12 mb-5">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" value={{ $category->name }}>
							</div>
						</div>

						<div class="col-md-12 mb-5">
							<div class="row">
								@foreach($criterias as $criteria)
									<div class="col-md-4">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="criterias[]" value="{{ $criteria->id }}" id="flexCheckDefault{{ $criteria->id }}" {{ $category->hasCriteria($criteria->label) ? ' checked' : '' }}>
											<label class="form-check-label" for="flexCheckDefault{{ $criteria->id }}">
												{{ $criteria->name }}
											</label>
										</div>
									</div>
								@endforeach
							</div>
						</div>

						<div class="col-md-12">
							<button type="submit" class="btn btn-primary">
								Update
							</button>
							<a href="{{ route('categories.index') }}" class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection