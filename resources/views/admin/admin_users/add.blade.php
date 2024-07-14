@extends('admin::layouts.admin_template')
@push('bottom')
<!-- Bootstrap datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
@endpush
@section('content')
<p><a title="Main Module" href="{{ route('getAdminUsers') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data</a></p>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            <form action="{{ route('postAddSaveAdminUser') }}" method="post" enctype="multipart/form-data"> 
        	@csrf
        	<input type="hidden" name="return_url" value="{{ route('getAdminUsers') }}">
            <div class="row">
        	<div class="col-md-6">
                <div class="mb-3 ">
                    <label class="form-label">Name<span class="text-danger" title="This field is required">*</span></label>
                    <input type="text" title="Member name" class="form-control" name="name" value="{{ old('name') }}" placeholder="Please enter name" required maxlength="50">                          
                    @error('name')
                        <div class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p class="text-muted"></p>
                </div>                      
            </div>   
            <div class="col-md-6">
                <div class="mb-3 ">
                    <label class="form-label">Email<span class="text-danger" title="This field is required">*</span></label>
                    <input type="text" title="Email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Please enter email" required maxlength="50">                         
                    @error('email')
                        <div class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p class="text-muted"></p>
                </div>                      
            </div>
            <div class="col-md-6">
                <div class="mb-3 ">
                    <label class="form-label">Mobile<span class="text-danger" title="This field is required">*</span></label>
                    <input type="text" title="Mobile" class="form-control" name="mobile" value="{{ old('mobile') }}" placeholder="Please enter mobile" pattern="[0-9]{10}" required>                            
                    @error('mobile')
                        <div class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p class="text-muted"></p>
                </div>                      
            </div>
            <div class="col-md-6">
                <div class="mb-3 ">
                    <label class="form-label">Spouse Name<span class="text-danger" title="This field is required">*</span></label>
                    <input type="text" title="Spouse Name" class="form-control" name="spouse_name" value="{{ old('spouse_name') }}" placeholder="Spouse Name" required maxlength="50">                          
                    @error('spouse_name')
                        <div class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p class="text-muted"></p>
                </div>                      
            </div>
            <div class="col-md-6">
                <div class="mb-3 ">
                    <label class="form-label">Date Of Birth<span class="text-danger" title="This field is required">*</span></label>
                    <input type="text" title="Date Of Birth" class="form-control" id="dob_datepic" name="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="Date Of Birth" autocomplete="off" required>                         
                    @error('date_of_birth')
                        <div class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p class="text-muted"></p>
                </div>                      
            </div>
            <div class="col-md-6">
                <div class="mb-3 ">
                    <label class="form-label">Date Of Weding<span class="text-danger" title="This field is required">*</span></label>
                    <input type="text" title="Date Of Weding" class="form-control" name="date_of_weding" value="{{ old('date_of_weding') }}" id="datepicker" placeholder="Date Of Birth" required autocomplete="off">                           
                    @error('date_of_weding')
                        <div class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p class="text-muted"></p>
                </div>                      
            </div>
            <div class="col-md-6">
                <div class="mb-3 ">
                    <label class="form-label">Contact Info<span class="text-danger" title="This field is required">*</span></label>
                    <textarea name="contact_info" class="form-control" id="">{{ old('contact_info') }}</textarea>                       
                    @error('contact_info')
                        <div class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p class="text-muted"></p>
                </div>                      
            </div> 
            <div class="col-md-6">
                <div class="mb-3 ">
                    <label class="form-label">Other information</label>
                    <textarea name="other_information" class="form-control" id="">{{ old('other_information') }}</textarea>                     
                    @error('other_information')
                        <div class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p class="text-muted"></p>
                </div>                      
            </div> 
            <div class="col-md-6">
                <div class="mb-3 ">
                    <label for="password" class="form-label">Password <span class="text-danger" title="This field is required">*</span></label>
                    <input type="password" title="Password" class="form-control" name="password" id="password" value="{{ old('email') }}" placeholder="Enter Password" required>                          
                    @error('password')
                        <div class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p class="text-muted"></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 ">
                    <label for="privilege" class="form-label">Privilege <span class="text-danger" title="This field is required">*</span></label>
                    <select name="privilege" id="privilege" class="form-control" required>
                        <option value="">Select a Privilege</option>
                        @if(!empty($privileges))
                        @foreach($privileges as $privilege)
                            <option value="{{$privilege->id}}">{{$privilege->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    @error('privilege')
                        <div class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p class="text-muted"></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 ">
                    <label for="status" class="form-label">User Type <span class="text-danger" title="This field is required">*</span></label>
                    <select name="user_type" class="form-control" required>
                        <option value="">Select a option</option>                    
                        <option value="1">Admin</option>
                        <option value="2">Super Admin</option>
                    </select>
                    @error('status')
                        <div class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p class="text-muted"></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 ">
                    <label for="status" class="form-label">Status <span class="text-danger" title="This field is required">*</span></label>
                    <select name="status" class="form-control" required>
                        <option value="">Select a Status</option>                    
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    @error('status')
                        <div class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p class="text-muted"></p>
                </div>
            </div>
        </div>

                <div class="row g-3">
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('getAdminUsers') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                            <input type="submit" name="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            
        	</form>
            </div>
		</div>
	</div>
</div>
@endsection
@push('bottom')
<!-- Bootstrap datepicker JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(function() {
              $('#dob_datepic').datepicker({                  
                  format: 'yyyy-mm-dd',
                  autoclose: true,
                  todayHighlight: true,
                  showButtonPanel: true,
                  endDate: new Date() 
              });

               $('#datepicker').datepicker({                  
                  format: 'yyyy-mm-dd',
                  autoclose: true,
                  todayHighlight: true,
                  showButtonPanel: true
              });
        });

        CKEDITOR.replace( 'description',{
            allowedContent : true,
        }); 
    });
</script>
@endpush