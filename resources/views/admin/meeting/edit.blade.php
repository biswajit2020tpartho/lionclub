@extends('admin::layouts.admin_template')
@push('bottom')
<!-- Bootstrap datepicker CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
	<link href="{{ asset('assets/admin/css/mdtimepicker.min.css') }}" rel="stylesheet">
	<script type="text/javascript" src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
@endpush
@section('content')
<p><a title="Main Module" href="{{ route('getManageMeeting') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Meeting</a></p>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 



            <div class="card-body">
            	<form action="{{ route('postUpdateMeeting', $row->id) }}" method="post" enctype="multipart/form-data">
            	@csrf
            	<input type="hidden" name="return_url" value="{{ route('getManageMeeting') }}">
            	<div class="row">
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Meeting Name<span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="Member name" class="form-control" name="meeting_title" value="{{ (old('meeting_title'))?old('meeting_title'):$row->meeting_title }}" placeholder="Please enter name" required maxlength="50">					        
					        @error('meeting_title')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>  
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Location<span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="Location" class="form-control" name="location" value="{{ (old('location'))?old('location'):$row->location }}" placeholder="Please enter location" required>					        
					        @error('location')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div> 
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Meeting Date<span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="Date Of Birth" class="form-control" id="meeting_date" name="meeting_date" value="{{ (old('meeting_date'))?old('meeting_date'):$row->meeting_date }}" placeholder="Meeting Date" autocomplete="off" required>					        
					        @error('meeting_date')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Meeting Time<span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="Location" class="form-control" name="meeting_time" id="picker1" value="{{ (old('meeting_time'))?old('meeting_time'):$row->meeting_time }}" placeholder="Meeting Time" required autocomplete="off">					        
					        @error('meeting_time')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>            		
            		
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Agenda<span class="text-danger" title="This field is required">*</span></label>
					        <textarea name="agenda" class="form-control" id="">{{ (old('agenda'))?old('agenda'):$row->agenda }}</textarea>				        
					        @error('agenda')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div> 
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Photo</label>
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
					        <label class="form-label">Description <span class="text-danger" title="This field is required">*</span></label>
					        <textarea name="description" class="form-control" id="description">{{ (old('description'))?old('description'):$row->description }}</textarea>				        
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
            				<div class="prev-img-thumb" style="width: 50px;">
                                @if(!empty($row->feature_image	) && (Storage::exists($row->feature_image	) || file_exists($row->feature_image	)))
                                <img src="{{ url($row->feature_image) }}"/>
                                @else
                                <img src="{{ asset('frontend/images/users/user-dummy-img.jpg') }}"/>
                                @endif   
                            </div>
					        <label class="form-label">Photo</label>
					        <input type="file" class="form-control" name="image" accept="image/*">					        
					        @error('image')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted">The image should be JPG/JPEG/PNG/GIF/SVG type and the image size should not above 5MB.</p>
					    </div>            			
            		</div> 
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Status <span class="text-danger" title="This field is required">*</span></label>
					        <select name="status" class="form-control" required>
					        	<option value="1" {{ (old('status')==1)?'selected':(($row->status==1)?'selected':'') }}>Active</option>
					        	<option value="0" {{ (old('status')=='0')?'selected':(($row->status=='0')?'selected':'') }}>Inactive</option>
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
                            	<a href="{{ route('getManageMeeting') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
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
<script type="text/javascript">
	$(document).ready(function() {
	

	CKEDITOR.replace( 'description',{
	  	allowedContent : true,
	});


	

	});
</script>
<script type="text/javascript" src="{{ asset('assets/admin/js/mdtimepicker.min.js') }}"></script>
<script type="text/javascript">
	mdtimepicker.defaults({ theme: 'green', hourPadding: true, clearBtn: true });
	
	window.onload = function () {
		mdtimepicker('#picker1,#picker2', {
			events: {
				timeChanged: function (data) {
					console.log('timeChanged', data);
				}
			}
		})		
	}
</script>
@endpush