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
                                        <td>Meeting Title</td>
                                        <td>{{ $row->meeting_title }}</td>
                                    </tr>
                                    <tr>
                                        <td>Meeting Location</td>
                                        <td>{{ $row->location }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date</td>
                                        <td>{{ $row->meeting_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Time</td>
                                        <td>{{ $row->meeting_time }}</td>
                                    </tr>
                                    <tr>
                                        <td>Agenda</td>
                                        <td>{{ $row->agenda }}</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{!! $row->description !!}</td>
                                    </tr> 
                                   
                                    <tr>
                                        <td>Feature Image</td>
                                        <td>
                                            <div class="prev-img-thumb" style="width: 50px;">
                                                @if(!empty($row->feature_image ) && (Storage::exists($row->feature_image  ) || file_exists($row->feature_image   )))
                                                <img src="{{ url($row->feature_image    ) }}"/>
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
                                <a href="{{ route('getManageMeeting') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
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