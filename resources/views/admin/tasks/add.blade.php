@extends('layouts.admin.app')

@section('title', $main_title)

@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
  {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
  
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">{{ $title }}</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> {{ $title }} </li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h4 class="card-title">Add Tasks Details</h4>
                        @if(!empty($details))
                            <form class="forms-sample" method="POST" action="{{ route('tasks.update', ['task' => $details->id]) }}">
                                @csrf
                                @method('PUT')
                        @else
                            <form class="forms-sample" method="POST" action="{{ route('tasks.store') }}">
                                @csrf
                        @endif
                            
                            <div class="form-group">
                                <label for="title">Task Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Task Title" value="{{ $details->title ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter Description">{{ $details->description ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="account_number">Assigned User ID</label>
                                @if($user_details->isNotEmpty())
                                    <select name="assigned_to" id="assigned_to" class="form-control">
                                        <option value="" selected>Please Select</option>
                                        @foreach($user_details as $user)
                                            <option value="{{ $user->id }}" @if(isset($details) && $details->assigned_to == $user->id) selected @endif>{{ $user->email }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <p>No users available</p>   
                                @endif    
                            </div>

                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <select name="priority" id="priority" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="High" @if(isset($details) && $details->priority == "High") selected @endif>High</option>
                                    <option value="Medium" @if(isset($details) && $details->priority == "Medium") selected @endif>Medium</option>
                                    <option value="Low" @if(isset($details) && $details->priority == "Low") selected @endif>Low</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="Pending" @if(isset($details) && $details->status == "Pending") selected @endif>Pending</option>
                                    <option value="In Progress" @if(isset($details) && $details->status == "In Progress") selected @endif>In Progress</option>
                                    <option value="Completed" @if(isset($details) && $details->status == "Completed") selected @endif>Completed</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="due_date">Date</label>
                                <input type="text" class="form-control" id="due_date" name="due_date" placeholder="Enter Due Date" value="{{ $details->due_date ?? '' }}"/>
                            </div>

                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $details->id ?? ''}}">
                            <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $( "#due_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
    
    </script>
@endpush
