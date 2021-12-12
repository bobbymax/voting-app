@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Voting Analysis') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    @foreach($staff as $voter)
                        @if($voter->castedVotes->count() <= 30)
                            <h3>{{ $voter->name . " - " . $voter->castedVotes->count() }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Criteria</th>
                                        <th>Weight</th>
                                        <th>Nominated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($voter->castedVotes as $vote)
                                        <tr>
                                            <td>{{ $vote->category->name }}</td>
                                            <td>{{ $vote->criteria->name }}</td>
                                            <td>{{ $vote->weight }}</td>
                                            <td>{{ $vote->voteable->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
