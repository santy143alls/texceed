@extends('adminlte::page')


@section('content')
<div class="container-fluid content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Admissions') }}
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#newAdmissionModal">
                        New + 
                    </button>
                </div>  
                <div class="card-body">
                    <table id="admissionDtbl">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newAdmissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Admission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" class="form admissionForm">
                <input type="hidden" name="_token" id="csrfToken" value="{{ Session::token() }}" />
                <div class="modal-body">
                    <div class="row p-4">
                        <div class="col-md-4">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="fname" />
                        </div>
                        <div class="col-md-4">
                            <label>Middle Name</label>
                            <input type="text" class="form-control" name="mname" />
                        </div>
                        <div class="col-md-4">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="lname" />
                        </div>
                    </div>
                    <div class="row p-4">
                        <div class="col-md-4">
                            <label>Phone</label>
                            <input type="number" class="form-control" name="phone" />
                        </div>
                        <div class="col-md-4">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" />
                        </div>
                        <div class="col-md-4">
                            <label>Course</label>
                            <input type="text" class="form-control" name="course" />
                        </div>
                    </div>
                    <div class="row p-4">
                        <div class="col-md-4">
                            <label>Fees</label>
                            <input type="number" class="form-control" name="fees" />
                        </div>
                        <div class="col-md-4">
                            <label>Status</label>
                            <select class="form-control" name='status'> 
                                <option value="#">Select</option>
                                <option value="1">Student</option>
                                <option value="2">Jobseeker</option>
                                <option value="3">IT Professional</option>
                                <option value="4">Non IT Professional</option>
                                <option value="5">Others</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Admission Status</label>
                            <select class="form-control"  name='admission_status'> 
                                <option value="#">Select</option>
                                <option value="1">Enquired</option>
                                <option value="2">Intrested</option>
                                <option value="3">Not Intrested</option>
                                <option value="4">Enrolled</option>
                            </select>
                        </div>
                    </div>
                    <div class="row p-4">
                        <div class="col-md-6">
                            <label>Address</label>
                            <textarea name="address" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary save">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<script  src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>


<script src="{{ URL::asset('js/admission/index.js') }}"></script>
<script>
    var config = {};
    config.url = {};
    config.url.create = "{{ route('admissionCreate') }}";
    config.url.getAllAdmissions = "{{ route('allAdmission') }}";
    var admission = new Admission(config);

</script>


@endsection
