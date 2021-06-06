@extends('layouts.app')
@section('title', 'View Student Details')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('View Student Details') }}
                	<a href="{{ route('student-list')}}" class="btn btn-primary btn-sm float-right">Back</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('save-student') }}" id="addStudent" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Student Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $studentData->studentName }}"  autocomplete="name" readonly="">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="grade" class="col-md-4 col-form-label text-md-right">{{ __('Grade') }}</label>

                            <div class="col-md-6">
                                <input id="text" type="grade" class="form-control @error('grade') is-invalid @enderror" name="grade" value="{{ $studentData->grade }}"  readonly="">

                                @error('grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                            	@if(file_exists(public_path("/storage/images/studentImages/".$studentData->image)))
			                        <img src='{{ asset("/storage/images/studentImages/".$studentData->image) }}' alt="{{$studentData->studentName}}" border="0" width="50" height="50" class="img-rounded" align="center" />';
			                    @else
			                    	@php
			                        	$imageName = explode("/", $studentData->image);
			                        	$newPath = asset("/storage/images/studentImages/".end($imageName));
			                        @endphp
			                        <img src='{{$newPath}}' border="0" width="50" height="50" class="img-rounded" alt="$studentData->studentName" align="center" />
			                    @endif
                            	<img src="{{-- $studentData->image --}}">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date Of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="text" readonly="" class="form-control @error('dob') is-invalid @enderror" value="{{$studentData->dateOfBirth}}" name="dob"  autocomplete="dob">
                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea id="address" readonly="" class="form-control @error('address') is-invalid @enderror" name="address"  autocomplete="address">{{$studentData->address}}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <select id="country" class="form-control @error('country') is-invalid @enderror" readonly disabled="" name="country"  autocomplete="country">
                                	<option value="">Slect Country</option>
                                	@foreach($countryList as $countryKey => $countryData)
                                		<option value="{{ $countryData->id}}" {{$studentData->country == $countryData->id || $studentData->country == $countryData->name ? "Selected='selected'" : '' }}>{{ $countryData->name}}</option>
                                	@endforeach
                                </select>
                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <select id="state" class="form-control @error('state') is-invalid @enderror" readonly disabled="" name="state"  autocomplete="state">
                                	<option value="">Slect State</option>
                                	@foreach($stateList as $stateKey => $stateData)
                                		<option value="{{ $stateData->id}}" {{$studentData->state == $stateData->id || $studentData->state == $stateData->stateName ? "Selected='selected'" : '' }}>{{ $stateData->stateName}}</option>
                                	@endforeach
                                </select>
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <select id="city" type="date" class="form-control @error('city') is-invalid @enderror" readonly disabled="" name="city"  autocomplete="city">
                                	<option value="">Slect City</option>
                                	@foreach($cityList as $cityKey => $cityData)
                                		<option value="{{ $cityData->id}}" {{$studentData->city == $cityData->id || $studentData->city == $cityData->cityName ? "Selected='selected'" : '' }}>{{ $cityData->cityName}}</option>
                                	@endforeach
                                </select>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection