@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Nomination Form') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(auth()->user()->voted == 0 && auth()->user()->grade_level_id > 0)
                        @php
                            $count = 1;
                        @endphp

                        <form action="{{ route('votes.store') }}" method="POST">
                            @csrf
                            @foreach(auth()->user()->gradeLevel->eligibilities as $eligible)
                                <h5 class="mb-3">{{ $count++ . ". " . $eligible->category->name }}</h5>
                                <input type="hidden" name="fields[{{ $count }}][category]" value="{{ $eligible->category->id }}">
                                @if($eligible->category->group === "staff" || $eligible->category->group === "leader" || $eligible->category->group === "management")
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee1]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $nom)
                                                @if ($nom->type === "staff" && $nom->grade_level_id > 0 && $eligible->category->isEligibleToBeVotedFor($nom->grade_level_id) && $nom->id != auth()->user()->id)
                                                    <option value="{{ $nom->id }}">{{ $nom->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria1]" id="criteriaCheck1{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck1' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck1{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee2]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $nom)
                                                @if ($nom->type === "staff" && $nom->grade_level_id > 0 && $eligible->category->isEligibleToBeVotedFor($nom->grade_level_id) && $nom->id != auth()->user()->id)
                                                    <option value="{{ $nom->id }}">{{ $nom->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria2]" id="criteriaCheck2{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck2' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck2{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee3]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $nom)
                                                @if ($nom->type === "staff" && $nom->grade_level_id > 0 && $eligible->category->isEligibleToBeVotedFor($nom->grade_level_id) && $nom->id != auth()->user()->id)
                                                    <option value="{{ $nom->id }}">{{ $nom->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3 mb-2">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria3]" id="criteriaCheck3{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck3' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck3{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee4]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $nom)
                                                @if ($nom->type === "staff" && $nom->grade_level_id > 0 && $eligible->category->isEligibleToBeVotedFor($nom->grade_level_id) && $nom->id != auth()->user()->id)
                                                    <option value="{{ $nom->id }}">{{ $nom->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria4]" id="criteriaCheck4{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck4' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck4{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee5]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $nom)
                                                @if ($nom->type === "staff" && $nom->grade_level_id > 0 && $eligible->category->isEligibleToBeVotedFor($nom->grade_level_id) && $nom->id != auth()->user()->id)
                                                    <option value="{{ $nom->id }}">{{ $nom->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria5]" id="criteriaCheck5{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck5' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck5{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif($eligible->category->group === "zonal")
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee1]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Zone</option>
                                            @foreach($zonals as $zone)
                                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria1]" id="criteriaCheck1{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck1' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck1{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee2]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Zone</option>
                                            @foreach($zonals as $zone)
                                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria2]" id="criteriaCheck2{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck2' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck2{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee3]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Zone</option>
                                            @foreach($zonals as $zone)
                                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3 mb-2">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria3]" id="criteriaCheck3{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck3' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck3{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee4]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Zone</option>
                                            @foreach($zonals as $zone)
                                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria4]" id="criteriaCheck4{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck4' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck4{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee5]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Zone</option>
                                            @foreach($zonals as $zone)
                                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria5]" id="criteriaCheck5{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck5' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck5{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif($eligible->category->group === "drivers")
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee1]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $driver)
                                                @if ($driver->type === "driver")
                                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria1]" id="criteriaCheck1{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck1' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck1{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee2]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $driver)
                                                @if ($driver->type === "driver")
                                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria2]" id="criteriaCheck2{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck2' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck2{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee3]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $driver)
                                                @if ($driver->type === "driver")
                                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3 mb-2">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria3]" id="criteriaCheck3{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck3' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck3{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee4]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $driver)
                                                @if ($driver->type === "driver")
                                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria4]" id="criteriaCheck4{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck4' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck4{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee5]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $driver)
                                                @if ($driver->type === "driver")
                                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria5]" id="criteriaCheck5{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck5' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck5{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif($eligible->category->group === "security")
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee1]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $security)
                                                @if ($security->type === "security")
                                                    <option value="{{ $security->id }}">{{ $security->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria1]" id="criteriaCheck1{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck1' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck1{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee2]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $security)
                                                @if ($security->type === "security")
                                                    <option value="{{ $security->id }}">{{ $security->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria2]" id="criteriaCheck2{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck2' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck2{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee3]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $security)
                                                @if ($security->type === "security")
                                                    <option value="{{ $security->id }}">{{ $security->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3 mb-2">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria3]" id="criteriaCheck3{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck3' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck3{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee4]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $security)
                                                @if ($security->type === "security")
                                                    <option value="{{ $security->id }}">{{ $security->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria4]" id="criteriaCheck4{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck4' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck4{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="fields[{{ $count }}][{{ $eligible->category->label }}][nominee5]" id="staff{{ $count }}" class="form-control">
                                            <option value="" selected disabled>Select Nominee</option>
                                            @foreach($nominees as $security)
                                                @if ($security->type === "security")
                                                    <option value="{{ $security->id }}">{{ $security->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        @foreach($eligible->category->criterias as $criteria)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                  <input class="form-check-input crits" type="radio" name="fields[{{ $count }}][{{ $eligible->category->label }}][criteria5]" id="criteriaCheck5{{ $count . time() . $eligible->category->group }}" onchange="checkSelection({{ 'criteriaCheck5' . $count . time() . $eligible->category->group }})" value={{ $criteria->label }}>
                                                  <label class="form-check-label" for="criteriaCheck5{{ $count . time() }}">
                                                    {{ $criteria->name }}
                                                  </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <hr>
                            @endforeach
                            <br><br>
                            @if(config('vote.voting'))
                                <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary">Register Vote</button>
                                </div>
                            @else
                                <div class="alert alert-warning" role="alert">
                                    Voting would soon commence!! Stay Tuned!!
                                </div>
                            @endif
                        </form>
                    @elseif(auth()->user()->grade_level_id == 0)
                        <form action="{{ route('update.profile') }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group mb-3">
                                <label for="grade_level_id">Grade Level</label>
                                <select name="grade_level_id" id="grade" class="form-control">
                                    <option value="" selected disabled>Select Grade Level</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->key }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
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

@section('scripts')
    
    <script>
        
        function checkSelection(input) {
            let checkedValues = [];

            let getta = input[0].attributes.id.value;
            let group = getta.substr(25);

            // let inputs = $("input[id*='criteriaCheck']");
            let inputs = $("input[type='radio'][id$='"+group+"']");
            // let checkedInputs = $("input[id*='criteriaCheck']:checked");
            let checkedInputs = $("input[id$='"+group+"']:checked");

            for (i=0; i < checkedInputs.length; i++) {
                checkedValues.push(checkedInputs[i].value);
            }

            for(i=0; i < inputs.length; i++) {

                if (checkedValues.includes(inputs[i].value) && inputs[i].value === input.value && ! inputs[i].checked) {
                    inputs[i].disabled = true;
                } else if(checkedValues.includes(inputs[i].value) && inputs[i].disabled) {
                        inputs[i].disabled = true;
                } else {
                    inputs[i].disabled = false;
                }
            }
            // console.log(inputs);
        }

    </script>

@endsection
