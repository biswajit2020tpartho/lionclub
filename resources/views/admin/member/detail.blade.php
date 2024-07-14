@extends('admin::layouts.admin_template')
@section('content')
<p><a title="Main Module" href="{{ url()->previous() }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Member</a></p>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div>

            <div class="card-body">                
                    <div class="row g-3">
                        <div class="table-responsive">
                            <table id="table-detail" class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Member Name</td>
                                        <td>{{ $row->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $row->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Mobile</td>
                                        <td>{{ $row->mobile }}</td>
                                    </tr>
                                    <tr>
                                        <td>Spouse Name</td>
                                        <td>{{ $row->spouse_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date Of Birth</td>
                                        <td>{{ $row->date_of_birth }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date Of Weding</td>
                                        <td>{{ $row->date_of_weding }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Contact Info</td>
                                        <td>{{ $row->contact_info }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Other information</td>
                                        <td>{{ $row->other_information }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Photo</td>
                                        <td>
                                            <div class="prev-img-thumb" style="width: 50px;">
                                                @if(!empty($data->photo) && (Storage::exists($data->photo) || file_exists($data->photo)))
                                                <img src="{{ url($row->photo) }}"/>
                                                @else
                                                <img src="{{ asset('frontend/images/users/user-dummy-img.jpg') }}"/>
                                                @endif   
                                            </div>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td>Status</td>
                                        <td>@if($row->status==1)
                                         <span class="badge bg-success">Active</span>
                                         @else
                                         <span class="badge bg-danger">Inactive</span>
                                         @endif</td>
                                    </tr>                                  
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.box-body -->                  
                    <div class="row g-3">
                        <div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                                <a href="{{ route('getManageMem') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--END AUTO MARGIN-->

</div>
@endsection