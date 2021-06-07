@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-md-4">
                          <div class="card">
                             <div class="card-body text-center">
                                <p><i class="fa fa-handshake-o fa-2x text-info" aria-hidden="true"></i></p>
                                <a href="{{ route('student-list') }}" style="color: #596377">
                                   <h6>Total Students</h6>
                                </a>
                                <p><b>{{$totalStudent}}</b></p>
                             </div>
                          </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
