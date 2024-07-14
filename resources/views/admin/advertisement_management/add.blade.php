@extends('admin::layouts.admin_template')
@push('bottom')
<!-- Bootstrap datepicker CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
@endpush
@section('content')

<!-- <script type="text/javascript" src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script> -->
<script type="text/javascript" src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

<p><a title="Main Module" href="{{ AdminHelper::adminpath() }}/manage-advertisement"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Advertisement</a></p>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            	<form action="{{ route('postAddAdv') }}" method="post" enctype="multipart/form-data">
            	@csrf
            	<input type="hidden" name="return_url" value="{{ route('getManageAdv') }}">
            	<div class="row">
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Advertisement Title<span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="Advertisement Title" class="form-control" name="advertisement_title" value="{{ old('advertisement_title') }}" placeholder="Please enter title" required maxlength="50">					        
					        @error('advertisement_title')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Featured Image</label>
					        <input type="file" class="form-control" name="image" accept="image/*">					        
					        @error('image')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted">The image should be JPG/JPEG/PNG/GIF/SVG type and the image size should not above 5MB.</p>
					    </div>            			
            		</div>
            		<div class="col-md-12">
            			<div class="mb-3 ">
					        <label class="form-label">Short Description<span class="text-danger" title="This field is required">*</span></label>
					        <textarea name="short_description" class="form-control" id="">{{ old('short_description') }}</textarea>				        
					        @error('short_description')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>  
            		<div class="col-md-12">
            			<div class="mb-3 ">
					        <label class="form-label">Description<span class="text-danger" title="This field is required">*</span></label>
					        <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>				        
					        @error('description')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div> 
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Published Date<span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="Date Of Weding" class="form-control" name="published_date" value="{{ old('published_date') }}" id="datepicker" placeholder="Published Date" required autocomplete="off">					        
					        @error('published_date')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Status</label>
					        <select name="status" class="form-control" required>
					        	<option value="1" {{ old('status')=='1'?'selected':'' }}>Active</option>
					        	<option value="0" {{ old('status')=='0'?'selected':'' }}>Inactive</option>
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
                            	<a href="{{ route('getManageAdv') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                            	<!-- <input type="submit" name="submit" value="Save & Add More" class="btn btn-primary"> -->
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
			  $('#datepicker').datepicker({				  
				  format: 'yyyy-mm-dd',
				  autoclose: true,
				  todayHighlight: true,
				  showButtonPanel: true,
				  startDate: new Date() 
			  });
		});

	  	CKEDITOR.replace( 'description',{
	  		allowedContent : true,
	  	});	
	});
</script>
@endpush