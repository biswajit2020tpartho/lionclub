@extends('admin::layouts.admin_template')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
            <div class="card-header card-primary">
                <i class="fa fa-cog"></i> {{ $page_title }}
            </div>
            <div class="card-body">
                <form method="post" id="form" enctype="multipart/form-data" action="{{ route('postSaveHomeSettings') }}">
                    @csrf
                    <div class="box-body">
                        <div class="row  mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Banner Text</label>
                                    <input type="text" class="form-control" name="title" value="{{ (old('title'))?old('title'):$row->title }}" placeholder="You Choose We Move" required>
                                    @error('title')
                                        <div class="text-danger mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">                                
                                <div class="form-group mb-3">
                                    <label>Banner Image</label>
                                    <input type="file" name="title_image" accept="image/*" class="form-control">
                                    <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                                    @error('title_image')
                                        <div class="text-danger mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror   
                                    @if(!empty($row->title_image) && (Storage::exists($row->title_image) || file_exists(public_path($row->title_image))))
                                    <div class="prev-img-thumb"><img src="{{ asset($row->title_image) }}"></div>
                                    <!-- <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p> -->
                                    <p><a class="btn btn-danger btn-primary btn-sm" href="{{AdminHelper::adminpath()}}/download-file?image={{$row->title_image}}"><i class="fa fa-download"></i> Download </a>
                                    <!-- <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{AdminHelper::adminpath()}}/delete-image?image={{$row->title_image}}&&id={{$row->id}}&&column=title_image&table=homepage_settings"><i class="fa fa-ban"></i> Delete </a> -->
                                    </p>                                    
                                    @endif                   
                                </div>
                            </div>
                        </div>
                        <div class="row  mb-3">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <input type="text" name="title_1" class="form-control" placeholder="How it Works" value="{{ (old('title_1'))?old('title_1'):$row->title_1 }}" required>
                                    @error('title_1')
                                        <div class="text-danger mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <input type="text" name="title_1_1" class="form-control" placeholder="Find the Best Quote" value="{{ (old('title_1_1'))?old('title_1_1'):$row->title_1_1 }}" required>
                                    @error('title_1_1')
                                        <div class="text-danger mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <input type="text" name="title_1_2" class="form-control" placeholder="Pay Securely in Advance" value="{{ (old('title_1_2'))?old('title_1_2'):$row->title_1_2 }}" required>
                                    @error('title_1_2')
                                        <div class="text-danger mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <input type="text" name="title_1_3" class="form-control" placeholder="Let the Man & Van Go to Work" value="{{ (old('title_1_3'))?old('title_1_3'):$row->title_1_3 }}" required>
                                    @error('title_1_3')
                                        <div class="text-danger mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row  mb-3">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" name="title_2" value="{{ (old('title_2'))?old('title_2'):$row->title_2 }}" placeholder="Join Us as a Driver" required>
                                    @error('title_2')
                                        <div class="text-danger mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">                                
                                <div class="form-group mb-3">
                                    <input type="file" name="title_2_image" accept="image/*" class="form-control">
                                    <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                                    @error('title_2_image')
                                        <div class="text-danger mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror 
                                    @if(!empty($row->title_2_image) && (Storage::exists($row->title_2_image) || file_exists(public_path($row->title_2_image))))
                                    <div class="prev-img-thumb"><img src="{{ asset($row->title_2_image) }}"></div>
                                    <!-- <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p> -->
                                    <p><a class="btn btn-danger btn-primary btn-sm" href="{{AdminHelper::adminpath()}}/download-file?image={{$row->title_2_image}}"><i class="fa fa-download"></i> Download </a>
                                    <!-- <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{AdminHelper::adminpath()}}/delete-image?image={{$row->title_2_image}}&&id={{$row->id}}&&column=title_2_image&table=homepage_settings"><i class="fa fa-ban"></i> Delete </a> -->
                                    </p>                                    
                                    @endif                   
                                </div>
                            </div>
                            <div class="col-md-4">                                
                                <div class="form-group mb-3">
                                    <input type="file" name="title_2_bg_image" accept="image/*" class="form-control">
                                    <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                                    @error('title_2_bg_image')
                                        <div class="text-danger mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    @if(!empty($row->title_2_bg_image) && (Storage::exists($row->title_2_bg_image) || file_exists(public_path($row->title_2_bg_image))))
                                    <div class="prev-img-thumb"><img src="{{ asset($row->title_2_bg_image) }}"></div>
                                    <!-- <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p> -->
                                    <p><a class="btn btn-danger btn-primary btn-sm" href="{{AdminHelper::adminpath()}}/download-file?image={{$row->title_2_bg_image}}"><i class="fa fa-download"></i> Download </a>
                                    <!-- <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{AdminHelper::adminpath()}}/delete-image?image={{$row->title_2_bg_image}}&&id={{$row->id}}&&column=title_2_bg_image&table=homepage_settings"><i class="fa fa-ban"></i> Delete </a> -->
                                    </p>
                                    @endif                   
                                </div>
                            </div>
                        </div>
                        <div class="row  mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" name="title_3" value="{{ (old('title_3'))?old('title_3'):$row->title_3 }}" placeholder="Why Us?" required>
                                    @error('title_3')
                                        <div class="text-danger mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <input type="file" name="title_3_image" accept="image/*" class="form-control">
                                    <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                                    @error('title_3_image')
                                        <div class="text-danger mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror    
                                    @if(!empty($row->title_3_image) && (Storage::exists($row->title_3_image) || file_exists(public_path($row->title_3_image))))
                                    <div class="prev-img-thumb"><img src="{{ asset($row->title_3_image) }}"></div>
                                    <!-- <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p> -->
                                    <p><a class="btn btn-danger btn-primary btn-sm" href="{{AdminHelper::adminpath()}}/download-file?image={{$row->title_3_image}}"><i class="fa fa-download"></i> Download </a>
                                    <!-- <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{AdminHelper::adminpath()}}/delete-image?image={{$row->title_3_image}}&&id={{$row->id}}&&column=title_3_image&table=homepage_settings"><i class="fa fa-ban"></i> Delete </a> -->
                                    </p>                                    
                                    @endif                   
                                </div>                     
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <textarea name="title_3_description" class="form-control description" id="description" rows="3" required>{{ (old('title_3_description'))?old('title_3_description'):$row->title_3_description }}</textarea>
                                    @error('title_3_description')
                                        <div class="text-danger mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>                                
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="card-footer">
                        <div class="form-group">                            
                            <input type="submit" name="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div><!-- /.box-footer-->
                </form>
            </div>
        </div>
	</div>
</div>
@endsection
@push('bottom')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      /*$('#description').summernote({
        height: 300,
        placeholder: 'Type here...'
      });*/

        $("form").validate({
            messages: {
               title: 'This field is required',
               title_image: 'This field is required',
               title_1: 'Please enter a valid email',
               title_1_1: 'This field is required',
               title_1_2: 'This field is required',
               title_1_3: 'This field is required',
               title_2: 'This field is required',
               title_3: 'This field is required',
               title_3_description: 'This field is required',
            }
        });

      CKEDITOR.replace( 'description',{
        allowedContent : true,
        toolbar: [
            { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },
            [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
            ['para', ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull']],
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
        ]
      });


      /*ClassicEditor
        .create( document.querySelector( '#description' ) )
    .catch( error => {
        console.error( error );
    } );*/

    });
</script>
@endpush