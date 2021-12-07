@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<form method="POST" action="{{ route('canVotes.update', $canVote->id) }}">
					@csrf
					@method('PATCH')

					<div class="row">
						<div class="col-md-12 mb-5">
							<div class="form-group">
								<label for="category_id">Category</label>
								<select name="category_id" id="cate" class="form-control">
									<option value="" selected disabled>Select Category</option>
									@foreach ($categories as $category)
										<option value="{{ $category->id }}" {{ $canVote->category_id == $category->id ? ' selected' : '' }}>{{ $category->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-md-12 mb-5">
							<div class="form-group">
								<label for="criteria_id">Criteria</label>

								@foreach($gradeLevels as $grade)

									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="grades[]" value="{{ $grade->id }}" id="flexCheckDefault{{ $grade->id }}" {{ $canVote->grade_level_id == $grade->id ? ' checked' : '' }}>
										<label class="form-check-label" for="flexCheckDefault{{ $grade->id }}">
											{{ $grade->key }}
										</label>
									</div>

								@endforeach

							</div>
						</div>

						<div class="col-md-12">
							<button type="submit" class="btn btn-primary">
								Submit
							</button>
							<a href="{{ route('canVotes.index') }}" class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection