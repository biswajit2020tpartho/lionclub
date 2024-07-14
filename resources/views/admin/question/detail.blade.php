@extends('admin.layouts.admin_template')
@section('content')
<p><a title="Main Module" href="{{ route('getQuestion') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Question</a></p>

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
                                        <td>Question</td>
                                        <td>{!! $row->question !!}</td>
                                    </tr>
									<tr>
                                        <td>Option 1</td>
                                        <td>{!! $row->option1 !!}</td>
                                    </tr> 
									<tr>
                                        <td>Option 2</td>
                                        <td>{!! $row->option2 !!}</td>
                                    </tr> 
									<tr>
                                        <td>Option 3</td>
                                        <td>{!! $row->option3 !!}</td>
                                    </tr> 
									<tr>
                                        <td>Option 4</td>
                                        <td>{!! $row->option4 !!}</td>
                                    </tr> 
									<tr>
                                        <td>Answer</td>
                                        <td>Option {{ $row->answer }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Status</td>
                                        <td>@if($row->status==1) <span class="badge bg-success">Active</span>@else<span class="badge bg-danger">@endif</td>
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