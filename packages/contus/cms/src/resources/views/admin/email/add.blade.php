@extends('base::layouts.default') @section('stylesheet')
<link rel="stylesheet"
	href="{{$getBaseAssetsUrl('css/bootstrap-fileupload.min.css')}}" />
<link rel="stylesheet" href="{{$getBaseAssetsUrl('css/uploader.css')}}" />
@endsection @section('content')
<div class="pageheader clearfix">
	<h2 class="pull-left">
		<i class="fa fa-tag"></i> {{trans('cms::emailtemplate.user')}} <span>{{trans('cms::emailtemplate.add_new_email')}}</span>
	</h2>
</div>
<form name="emailtemplateForm" method="POST"
	action="{{url('admin/emails/add')}}" enctype="multipart/form-data">
	{!! csrf_field() !!}
	<div class="contentpanel">
		@include('base::partials.errors')
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="add_form clearfix">
							<div class="form-group"
								data-ng-class="{'has-error': errors.name.has}">
								<label class="control-label">{{trans('cms::emailtemplate.name')}}
									<span class="asterisk">*</span>
								</label> <input type="text" name="name"
									data-ng-model="emailtemplateCtrl.emailtemplate.name"
									class="form-control"
									placeholder="{{trans('cms::emailtemplate.name_placeholder')}}"
									value="{{old('name')}}" />
								<p class="help-block"hide"></p>
							</div>


							<div class="form-group"
								data-ng-class="{'has-error': errors.subject.has}">
								<label class="control-label">{{trans('cms::emailtemplate.subject')}}</label><span
									class="asterisk">*</span> <input type="text" name="subject"
									maxlength="10" class="form-control"
									data-ng-model="emailtemplateCtrl.emailtemplate.subject"
									placeholder="{{trans('cms::emailtemplate.subject_placeholder')}}"
									value="{{old('subject')}}" />
								<p class="help-block"hide"></p>
							</div>

							<div class="form-group"
								data-ng-class="{'has-error': errors.content.has}">
								<label class="control-label">{{trans('cms::emailtemplate.content')}}
									<span class="asterisk">*</span>
								</label>
								<textarea type="text" name="content" class="form-control"
									data-ng-model="emailtemplateCtrl.emailtemplate.content"
									placeholder="{{trans('cms::emailtemplate.content_placeholder')}}"
									value="{{old('content')}}"></textarea>
								<p class="help-block"hide"></p>
							</div>


							<div class="form-group">
								<label class="control-label">{{trans('cms::emailtemplate.status')}}</label>
								<select class="form-control mb10" name="is_active"
									data-ng-model="emailtemplateCtrl.emailtemplate.is_active">
									<option value="1">{{trans('cms::emailtemplate.active')}}</option>
									<option value="0">{{trans('cms::emailtemplate.inactive')}}</option>
								</select>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="padding10">
			<div class="fixed-btm-action">
				<div class="text-right btn-invoice">
					<a class="btn btn-white mr5" href="{{url('admin/emails')}}">{{trans('base::general.cancel')}}</a>
					<button class="btn btn-primary">{{trans('base::general.submit')}}</button>
				</div>
			</div>
		</div>

</form>
@endsection @section('scripts')
<script src="{{$getBaseAssetsUrl('js/jquery-checktree.js')}}"></script>
<script src="{{$getBaseAssetsUrl('js/Validate.js')}}"></script>
<script src="{{$getCmsAssetsUrl('js/email/email.js')}}"></script>
<script type="text/javascript">
    $('#tree').checktree();
        // <![CDATA[
             window.Mara = { 
            		 emailtemplateForm : {
                    rules : {!! json_encode($rules) !!}
                },
                route : {
                    
                },
                locale : {!! json_encode(trans('validation')) !!}     
             };
        // ]]>
    </script>

@endsection
