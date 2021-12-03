@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<form method="POST" action="{{ route('weights.update', $weight->id) }}">
					@csrf
					@method('PATCH')

					<div class="row">
						<div class="col-md-12 mb-5">
							<div class="form-group">
								<label for="category_id">Category</label>
								<select name="category_id" id="cate" class="form-control">
									<option value="" selected disabled>Select Category</option>
									@foreach ($categories as $category)
										<option value="{{ $category->id }}" {{ $weight->category_id == $category->id ? ' selected' : '' }}>{{ $category->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-md-12 mb-5">
							<div class="form-group">
								<label for="criteria_id">Criteria</label>
								<select name="criteria_id" id="cate" class="form-control">
									<option value="" selected disabled>Select Criteria</option>
									@foreach ($criterias as $criteria)
										<option value="{{ $criteria->id }}" {{ $weight->criteria_id == $criteria->id ? ' selected' : '' }}>{{ $criteria->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-md-12 mb-5">
							<div class="form-group">
								<label for="value">Value</label>
								<input type="number" name="value" class="form-control" value={{ $weight->value }}>
							</div>
						</div>

						<div class="col-md-12">
							<button type="submit" class="btn btn-primary">
								Submit
							</button>
							<a href="{{ route('weights.index') }}" class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection