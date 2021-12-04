@extends('layouts.blank')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				@if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
			</div>
		</div>
	</div>
	<form action="{{ route('import.data') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="form-group mb-3">
						<label for="entity">Entity</label>
						<select name="entity" id="ent" class="form-control">
							<option value="" disabled selected>Select Entity</option>
							@foreach(['users', 'grades', 'categories', 'criterias'] as $entity)

								<option value="{{ $entity }}">{{ ucfirst($entity) }}</option>

							@endforeach
						</select>
					</div>

					<div class="form-group mb-3">
						<label for="file">Upload file</label>
						<input type="file" name="file" class="form-control">
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary">
							Import
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection