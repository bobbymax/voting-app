@extends('layouts.app')

@section('styles')

    <style>
        .background-success {
            background-color: #1abc9c;
        }
        .background-runner {
            background-color: #f1c40f;
        }
    </style>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Results') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($categories as $category)
                        @if ($category->votes->count() > 0)
                            <div class="collate-results">
                                <h5 class="mb-3">{{ $category->name }}</h5>
                                <div class="compilation">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="result">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Nominee</th>
                                                            <th>Category</th>
                                                            <th>Criterias</th>
                                                            <th>Weight</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $fetcher = [];
                                                            $nominee = [];
                                                        @endphp
                                                        @foreach ($category->votes as $vote)
                                                            @php
                                                                $total = $category->votes->where('voteable_id', $vote->voteable->id)->sum('weight');
                                                                if(! in_array($total, $fetcher)) $fetcher[] = $total;
                                                                if(! in_array($vote->voteable->name, $nominee)) $nominee[$total] = $vote->voteable->name;
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $vote->voteable->name }}</td>
                                                                <td>{{ $vote->category->name }}</td>
                                                                <td>{{ $vote->criteria->name }}</td>
                                                                <td>{{ $vote->weight }}</td>
                                                            </tr>
                                                        @endforeach

                                                        @php
                                                            asort($fetcher);
                                                            $fetcher = array_reverse($fetcher);
                                                            $results = array_slice($fetcher, 0, 3);
                                                            $secondy = array_slice($fetcher, 1, 3);
                                                        @endphp

                                                        @foreach ($results as $result)
                                                            <tr class="{{ max($results) == $result ? ' background-success' : ' background-runner' }}">
                                                                <td>
                                                                    @php
                                                                        if (max($results) == $result) {
                                                                            echo 'WINNER';
                                                                        } elseif (max($secondy) == $result) {
                                                                            echo 'RUNNER UP';
                                                                        } else {
                                                                            echo 'THIRD PLACE';
                                                                        }
                                                                    @endphp
                                                                </td>
                                                                <td colspan="2"><strong>{{ strtoupper($nominee[$result]) }}</strong></td>
                                                                <td>{{ $result }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection