@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<form method="POST" action="{{ route('categories.store') }}">
					@csrf
					<div class="row">
						<div class="col-md-12 mb-5">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" value={{ old('name') }}>
							</div>
						</div>

						<div class="col-md-12">
							<button type="submit" class="btn btn-primary">
								Submit
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection