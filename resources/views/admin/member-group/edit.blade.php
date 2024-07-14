@extends('admin::layouts.admin_template')
@section('content')
<script type="text/javascript" src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

<p><a title="Main Module" href="{{ route('getManageGroup') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Member Group</a></p>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 



            <div class="card-body">
            	<form action="{{ route('postUpdateGroup', $row->id) }}" method="post" enctype="multipart/form-data">
            	@csrf
            	<input type="hidden" name="return_url" value="{{ route('getManageGroup') }}">
            	<div class="row">
            		<div class="form-group mb-3">
            			<div class="mb-3 ">
					        <label class="form-label">Group Name<span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="Member name" class="form-control" name="name" value="{{ (old('name'))?old('name'):$row->name }}" placeholder="Please enter name" required maxlength="50">					        
					        @error('name')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div> 
            		<div class="form-group mb-3">
            			<div class="mb-3 ">
					        <label class="form-label">Category</label>
					        <select name="category" class="form-control" required>
					        	<option value="">--Select--</option>
					        	@foreach($category as $cat)
					        	<option value="{{ $cat->id}}" {{ (old('category'))?(old('category')==$cat->id?'selected':''):($cat->id == $row->member_category_id?'selected':'') }}> {{ $cat->name }} </option>
					        	@endforeach
					        </select>
					        @error('category')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>                		    		      	
            		<div class="form-group mb-3">
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
                            	<a href="{{ route('getManageGroup') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
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
@endpush