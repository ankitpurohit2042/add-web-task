@extends('layouts.app')
@section('title', 'Student List')
@section('content')
<div class="row">
	<div class="col-md-10 col-sm-12 mx-1 mx-auto">
		<div class="card">
			<div class="card-header">
				<h5 class="mt-2 float-left">{{ __('All Students') }}</h5>
				<a href="{{ route('add-student') }}" class="btn btn-sm btn-success float-right" title="Add Student">Add Student</i></a>
			</div>
			<div class="card-body table-responsive">
				@if(session()->has('status'))
		            <p class="alert alert-danger">
		              {{session()->get('status')}}
		            </p>
		        @endif
		        @if(session()->has('success'))
		            <p class="alert alert-success">
		              {{session()->get('success')}}
		            </p>
		        @endif
		        <table class="table table-bordered yajra-datatable1">
			        <thead>
			            <tr>
			                <th>No</th>
			                <th>Name</th>
			                <th>Grade</th>
			                <th>Image</th>
			                <th>DOB</th>
			                <th>Address</th>
			                <th>Actions</th>
			            </tr>
			        </thead>
			    </table>
		    </div>
		</div>
	</div>
</div>
@endsection
