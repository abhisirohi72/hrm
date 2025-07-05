@extends('layouts.admin.app')

@section('title', $main_title)

@section('content')
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
                    <div class="card-body" style="overflow: auto;">
                        <h4 class="card-title">Employee Details</h4>
                        <a href="{{ route('add.emp') }}" class="btn btn-primary btn-icon-text mb-2" style="float: right;">
                            Add
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Emp ID</th>
                                        <th>Image</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>DOB</th>
                                        <th>Address</th>
                                        <th>Department</th>
                                        <th>Branch</th>
                                        <th>Joining Date</th>
                                        <th>Salary</th>
                                        <th>Status</th>
                                        <th>I Card</th>
                                        <th>Joinning Letter</th>
                                        <th>Offer Letter</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($details) > 0)
                                        @foreach ($details as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->emp_id ?? '' }}
                                                </td>
                                                <td>
                                                    @if(!empty($item->image))
                                                    <img src="{{ asset('storage/users').'/'.$item->image }}" alt="">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $item->full_name ?? '' }}</td>
                                                <td>{{ $item->email ?? '' }}</td>
                                                <td>{{ $item->mobile ?? '' }}</td>
                                                <td>{{ $item->dob ?? '' }}</td>
                                                <td>{{ $item->address ?? '' }}</td>
                                                <td>{{ $item->departments->name ?? '' }}</td>
                                                <td>{{ $item->branches->name ?? '' }}</td>
                                                <td>{{ $item->joinning_date ?? '' }}</td>
                                                <td>{{ $item->salary ?? '' }}</td>
                                                <td>
                                                    @if ($item->status == '0')
                                                        <label class="badge badge-danger">Pending</label>
                                                    @else
                                                        <label class="badge badge-success">Active</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary"
                                                        onclick="show_modal('{{ $item->id }}')">Show</button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary"
                                                        onclick="show_joinning_letter('{{ $item->id }}')">Show</button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary"
                                                        onclick="show_offer_letter('{{ $item->id }}')">Show</button>
                                                </td>
                                                <td>
                                                    <a href="{{ route('edit.emp', ['id' => $item->id]) }}"
                                                        class="btn btn-dark btn-icon-text">Edit
                                                        <i class="mdi mdi-file-check btn-icon-append"></i>
                                                    </a>
                                                    <a href="{{ route('delete.emp', ['id' => $item->id]) }}"
                                                        class="btn btn-danger">Delete
                                                        <i class="mdi mdi-delete btn-icon-append"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3 text-center">
                                                <p>No Records Found..</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal" tabindex="-1" id="empModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Modal -->
    <div class="modal fade" id="empModal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="empModalLabel">Employee I-Card</h5>
                    {{-- <a id="downloadBtn" class="btn btn-success btn-sm" target="_blank" href="#">Download PDF</a> --}}
                    <a id="downloadBtn" target="_blank" href="#"><i class="mdi mdi-briefcase-download" id="downloadBtn"></i></a>    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="modal_hide()">X</button>
                </div>
                <div class="modal-body" id="empModalBody">
                    <!-- I-card content will be loaded here -->
                    Loading...
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        let empModal = null;

        function show_modal(emp_id) {
            $("#empModalLabel").html("Employee I-Card");
            // Show the modal
            $('#downloadBtn').attr('href', `/emp_icard_pdf/${emp_id}`);
            const empModal = new bootstrap.Modal(document.getElementById('empModal'));
            empModal.show();

            // Fetch employee data via AJAX
            fetch(`/view_emp_icard/${emp_id}`)
                .then(response => response.json())
                .then(data => {
                    const details = data.details;

                    // Build HTML (adjust as needed)
                    const content = `
                        <div>
                        <img src="/storage/emp/images/${details.image}" style="width:100px;height:100px;position: relative;left: 30%;">
                        <h5>Name: ${details.full_name}</h5>
                        <p>Department: ${details.departments.name}</p>
                        <p>Branch: ${details.branches.name}</p>
                        <p>Email: ${details.email}</p>
                        <p>Mobile: ${details.mobile}</p>
                        <p>Address: ${details.address}</p>
                        <!-- Add more fields if needed -->
                        </div>
                    `;

                    document.getElementById('empModalBody').innerHTML = content;
                })
                .catch(error => {
                    document.getElementById('empModalBody').innerHTML =
                        '<p class="text-danger">Error loading data.</p>';
                    console.error(error);
                });
        }

        function show_joinning_letter(emp_id) {
            // Show the modal
            fetch(`/emp_joinning_letter/${emp_id}`)
                .then(response => response.json())
                .then(data => {
                    const details = data.html;
                    document.getElementById('empModalBody').innerHTML = details;
                    $("#empModalLabel").html("Employee Joinning Letter");
                    $('#downloadBtn').attr('href', `/emp_joinning_letter_pdf/${emp_id}`);
                    const empModal = new bootstrap.Modal(document.getElementById('empModal'));
                    empModal.show();
                })
                .catch(error => {
                    document.getElementById('empModalBody').innerHTML =
                        '<p class="text-danger">Error loading data.</p>';
                    console.error(error);
                });
        }

        function show_offer_letter(emp_id){
            fetch(`/emp_offer_letter/${emp_id}`)
                .then(response => response.json())
                .then(data => { 
                    const details = data.html;
                    document.getElementById('empModalBody').innerHTML = details;
                    $("#empModalLabel").html("Employee Offer Letter");
                    $('#downloadBtn').attr('href', `/emp_offer_letter_pdf/${emp_id}`);
                    const empModal = new bootstrap.Modal(document.getElementById('empModal'));
                    empModal.show();
                })
                .catch(error => {
                    document.getElementById('empModalBody').innerHTML =
                        '<p class="text-danger">Error loading data.</p>';
                    console.error(error);
                });
        }

        function modal_hide(){
            $('#empModal').attr('class','modal fade hide'); 
            $(".modal-backdrop").attr('class', 'modal-backdrop fade hide');
        }
        // $('document').ready(function(){
        //     $(".btn-close").click(function(){

        //     });
        // });
    </script>
@endpush
