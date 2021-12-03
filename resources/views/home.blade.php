@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nomination Form') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(auth()->user()->voted == 0)
                    @php
                        $count = 1;
                    @endphp
                    <form action="{{ route('votes.store') }}" method="POST">
                        @csrf
                        @foreach(auth()->user()->gradeLevel->eligibilities as $eligible)
                            {{-- {{ $eligible->category->name }} <br> --}}
                            <div class="section-lane">
                                <h5>{{ $count++ . "." . " " . $eligible->category->name }}</h5>
                                <input type="hidden" name="fields[{{ $count }}][categories]" value={{ $eligible->category->id }}>
                                <select name="fields[{{ $count }}][nominees]" id="nome" class="form-control">
                                    <option value="" selected disabled>Select Nominee</option>
                                    @foreach($nominees as $user)
                                        @if($user->id != auth()->user()->id)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select><br>

                                <p>Select all that apply!!</p>
                                @foreach($eligible->category->criterias as $criteria)

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fields[{{ $count }}][criterias][]" value="{{ $criteria->id }}" id="flexCheckDefault{{ $criteria->id . \Illuminate\Support\Str::random(8) }}" {{ old('criterias') == $criteria->id ? ' checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault{{ $criteria->id }}">
                                            {{ $criteria->name }}
                                        </label>
                                    </div>

                                @endforeach
                            </div><br>
                        @endforeach
                        <br><br>
                        <div class="form-group pull-right">
                            <button type="submit" class="btn btn-primary">Register Vote</button>
                        </div>
                    </form>
                    @else
                        <div class="alert alert-info" role="alert">
                            Your vote has already been registered
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
