@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<form method="POST" action="{{ route('gradeLevels.store') }}">
					@csrf
					<div class="row">
						<div class="col-md-6 mb-5">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" value={{ old('name') }}>
							</div>
						</div>
						<div class="col-md-6 mb-5">
							<div class="form-group">
								<label for="key">Key</label>
								<input type="text" name="key" class="form-control" value={{ old('key') }}>
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