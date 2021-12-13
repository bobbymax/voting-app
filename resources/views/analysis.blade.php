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

                    @php
                        $voters = [];
                    @endphp

                    @foreach($staff as $voter)
                        @if($voter->castedVotes->count() <= 30)
                            @php
                                $voters[] = $voter->name;
                            @endphp
                            <h3>{{ $voter->name . " - " . $voter->castedVotes->count() }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Criteria</th>
                                        <th>Weight</th>
                                        <th>Nominated</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($voter->castedVotes as $vote)
                                        <tr>
                                            <td>{{ $vote->category->name }}</td>
                                            <td>{{ $vote->criteria->name }}</td>
                                            <td>{{ $vote->weight }}</td>
                                            <td>{{ $vote->voteable->name }}</td>
                                            <td>{{ $vote->created_at->format('d F') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    @endforeach

                </div>

                <div class="alert alert-success" role="alert">
                    Number of Staff that Voted: {{ count($voters) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
