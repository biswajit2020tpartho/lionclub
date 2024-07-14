@extends('admin.layouts.admin_template')
@section('content')
<p><a title="Main Module" href="{{ route('getQuestion') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Question</a></p>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            	<form action="{{ route('editQuestion', $row->id) }}" method="post" enctype="multipart/form-data">
            	@csrf
            	<input type="hidden" name="return_url" value="{{ route('getQuestion') }}">
            	<div class="row">
					<div class="col-md-6">
						<div class="mb-3 ">
						   <label>Select Chapter <span class="text-danger" title="This field is required">*</span></label>
						   <select class="form-control" name="chapter">
							  <option value="">Select Chapter</option>
							  @foreach($chapter as $data)
							  <option value="{{ $data->id }}" {{ ($row->chapter_id == $data->id)?"selected":"" }}>{{ $data->title }}</option>
							  @endforeach
						   </select>
						   @error('chapter')
								<div class="text-danger mt-1" role="alert">
									<strong>{{ $message }}</strong>
								</div>
						   @enderror
						</div>
					 </div>							 
					 <div class="col-md-6">
						<div class="mb-3 ">
							<label>Question Type <span class="text-danger" title="This field is required">*</span></label>
							<select class="form-control" name="question_type">
								<option value="">Select Type</option>
								<option value="1" {{ ($row->question_type == 1)?"selected":"" }}>Single Choice questions</option>
								<option value="2" {{ ($row->question_type == 2)?"selected":"" }}>Multiple Choice questions</option>
								<option value="3" {{ ($row->question_type == 3)?"selected":"" }}>Single Choice Image questions</option>
							</select>
						   @error('question_type')
								<div class="text-danger mt-1" role="alert">
									<strong>{{ $message }}</strong>
								</div>
						   @enderror
						</div>
					</div>
					<div class="col-md-12">
            			<div class="mb-3 ">
					        <label for="Nameinput" class="form-label">Question <span class="text-danger" title="This field is required">*</span></label>					        
							<textarea class="form-control wysiwyg" name="question" id="question">{{ (!empty(old('question'))?old('question'):$row->question) }}</textarea>
					        @error('question')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>
					<div class="col-md-12">
            			<div class="mb-3 ">
					        <label for="Nameinput" class="form-label">Hints <span class="text-danger" title="This field is required">*</span></label>					        
							<textarea class="form-control wysiwyg" name="hints" id="hints">{{ (!empty(old('hints'))?old('hints'):$row->hints) }}</textarea>
					        @error('hints')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>
            		<div class="col-md-12">
            			<div class="mb-3 ">
					        <label for="Nameinput" class="form-label">Option 1 <span class="text-danger" title="This field is required">*</span></label>					        
							<textarea class="form-control wysiwyg" name="option_1" id="comment">{{ (!empty(old('option_1'))?old('option_1'):$row->option1) }}</textarea>
					        @error('option_1')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>
					<div class="col-md-12">
            			<div class="mb-3 ">
					        <label for="Nameinput" class="form-label">Option 2 <span class="text-danger" title="This field is required">*</span></label>					        
							<textarea class="form-control wysiwyg" name="option_2" id="comment">{{ (!empty(old('option_2'))?old('option_2'):$row->option2) }}</textarea>
					        @error('option_2')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>
            		<div class="col-md-12">
            			<div class="mb-3 ">
					        <label for="Nameinput" class="form-label">Option 3 <span class="text-danger" title="This field is required">*</span></label>					        
							<textarea class="form-control wysiwyg" name="option_3" id="comment">{{ (!empty(old('option_3'))?old('option_3'):$row->option3) }}</textarea>
					        @error('option_3')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>
					<div class="col-md-12">
            			<div class="mb-3 ">
					        <label for="Nameinput" class="form-label">Option 4 <span class="text-danger" title="This field is required">*</span></label>					        
							<textarea class="form-control wysiwyg" name="option_4" id="comment">{{ (!empty(old('option_4'))?old('option_4'):$row->option4) }}</textarea>
					        @error('option_4')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>
					<div class="col-md-12">
            			<div class="mb-3 ">
					        <label for="Nameinput" class="form-label d-block">Correct option <span class="text-danger" title="This field is required">*</span></label>
							
							<div class="radio"><input type="radio" id="html" name="answer" value="1" @if($row->answer == 1) checked @endif ><label for="html">Option 1</label></div>
							<div class="radio"><input type="radio" id="css" name="answer" value="2" @if($row->answer == 2) checked @endif ><label for="css">Option 2</label></div>
							<div class="radio"><input type="radio" id="javascript" name="answer" value="3" @if($row->answer == 3) checked @endif ><label for="javascript">option 3</label></div>
							<div class="radio"><input type="radio" id="javascript" name="answer" value="4" @if($row->answer == 4) checked @endif ><label for="javascript">option 4</label></div>
					    </div>   
						@error('answer')
							<div class="text-danger mt-1" role="alert">
								<strong>{{ $message }}</strong>
							</div>
						@enderror
						<p class="text-muted"></p>
            		</div>
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label for="Nameinput" class="form-label">Marks <span class="text-danger" title="This field is required">*</span></label>
					        <input type="number" title="Marks" class="form-control" name="marks" id="Nameinput" value="{{ (!empty(old('marks'))?old('marks'):$row->marks) }}" placeholder="Marks" required>					        
					        @error('marks')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>
					<div class="col-md-6">
            			<div class="mb-3 ">
					        <label for="Nameinput" class="form-label">Order <span class="text-danger" title="This field is required">*</span></label>
					        <input type="number" title="Marks" class="form-control" name="sort_order" id="sort_order" value="{{ (!empty(old('sort_order'))?old('sort_order'):$row->sort_order) }}" placeholder="Order" required>					        
					        @error('sort_order')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>
            		<div class="col-md-12">
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
                            	<a href="{{ AdminHelper::adminpath() }}/manage-question" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>                            	
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