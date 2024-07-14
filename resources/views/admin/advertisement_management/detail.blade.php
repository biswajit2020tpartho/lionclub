@extends('admin::layouts.admin_template')
@section('content')
<p><a title="Main Module" href="{{ url()->previous() }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Advertisement</a></p>

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
                                        <td>Advertisement Name</td>
                                        <td>{{ $row->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>Short description</td>
                                        <td>{{ $row->short_description }}</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{!! $row->description !!}</td>
                                    </tr>                                
                                    <tr>
                                        <td>Status</td>
                                        <td>@if($row->status==1)
                                         <span class="badge bg-success">Active</span>
                                         @else
                                         <span class="badge bg-danger">Inactive</span>
                                         @endif</td>
                                    </tr>  
                                    <tr>
                                        <td>Banner</td>
                                        <td><div class="prev-img-thumb" style="width: 50px;"><img src="{{ url($row->banner_image) }}"/></div></td>
                                    </tr>                                  
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.box-body -->                  

                </form>

            </div>
        </div>
    </div>
    <!--END AUTO MARGIN-->

</div>
@endsection