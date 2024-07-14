@extends('admin.layouts.admin_template')
@push('bottom')
<!-- Bootstrap datepicker CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
@endpush
@section('content')
<p><a title="Main Module" href="{{ route('getManageQuestion') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Question</a></p>

<div class="row">
	<div class="col-md-12">
		<div class="card">
		   <div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 
					
			<div class="card-body">
			  <form action="{{ route('getAddQuestion') }}" method="post" enctype="multipart/form-data" id="add_question">
				@csrf
				<input type="hidden" name="return_url" value="{{ route('getManageQuestion') }}">
				  <div class="row">
					 <div class="col-md-6">
            			<div class="mb-3 ">
						   <label>Question Type <span class="text-danger" title="This field is required">*</span></label>
						   <select class="form-control" name="question_type" id="question_type">
							  <option value="">Select Type</option>
							  <option value="1" {{ (old('question_type')==1)?"selected":""}}>Single Choice questions</option>
							  <option value="2" {{ (old('question_type')==2)?"selected":""}}>Multiple Choice questions</option>							 
						   </select>
						   @error('question_type')
								<div class="text-danger mt-1" role="alert">
									<strong>{{ $message }}</strong>
								</div>
						   @enderror
						</div>
					 </div>
					 <div class="col-md-6">
            			<div class="mb-3 ">
						   <label>Question <span class="text-danger" title="This field is required">*</span></label>
						   <textarea class="form-control wysiwyg" name="question" id="question">{{ old('question') }}</textarea>
						   @error('question')
								<div class="text-danger mt-1" role="alert">
									<strong>{{ $message }}</strong>
								</div>
							@enderror
						</div>
					 </div>				
					 
					 <div class="col-md-6">
            			<div class="mb-3 ">
						   <label>Option 1 <span class="text-danger" title="This field is required">*</span></label>
						   <textarea class="form-control wysiwyg" name="option_1" id="option_1">{{ old('option_1') }}</textarea>
						   @error('option_1')
								<div class="text-danger mt-1" role="alert">
									<strong>{{ $message }}</strong>
								</div>
							@enderror
						</div>
					 </div>
					 <div class="col-md-6">
            			<div class="mb-3 ">
						   <label>Option 2 <span class="text-danger" title="This field is required">*</span></label>
						   <textarea class="form-control wysiwyg" name="option_2" id="option_2">{{ old('option_2') }}</textarea>
						   @error('option_2')
								<div class="text-danger mt-1" role="alert">
									<strong>{{ $message }}</strong>
								</div>
							@enderror
						</div>
					 </div>
					 <div class="col-md-6">
            			<div class="mb-3 ">
						   <label>Option 3 <span class="text-danger" title="This field is required">*</span></label>
							<textarea class="form-control wysiwyg" name="option_3" id="option_3">{{ old('option_3') }}</textarea>
							@error('option_3')
								<div class="text-danger mt-1" role="alert">
									<strong>{{ $message }}</strong>
								</div>
							@enderror
						</div>
					 </div>
					 <div class="col-md-6">
            			<div class="mb-3 ">
						   <label>Option 4 <span class="text-danger" title="This field is required">*</span></label>
						   <textarea class="form-control wysiwyg" name="option_4" id="option_4">{{ old('option_4') }}</textarea>
							@error('option_4')
								<div class="text-danger mt-1" role="alert">
									<strong>{{ $message }}</strong>
								</div>
							@enderror
						</div>
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
				  <div class="row g-3">
                        <div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                            	<a href="{{ route('getManageQuestion') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
		CKEDITOR.replace( 'description',{
	  		allowedContent : true,
	  	});	
	});
</script>
@endpush
