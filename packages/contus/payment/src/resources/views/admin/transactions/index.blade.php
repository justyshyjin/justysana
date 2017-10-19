@extends('base::layouts.default') @section('header')

@include('base::layouts.headers.dashboard') @endsection

@section('content')

<div data-ng-controller="transactionController as transCtrl">
	<div class="menu_container clearfix">
		<div class="page_menu pull-left">
			<ul class="nav">
				<li><a href="{{url('admin/transactions')}}" class="active">{{
						trans('payment::transaction.transactions') }}</a></li>
				<li><a href="{{url('admin/payments')}}">{{
						trans('payment::transaction.payments') }}</a></li>
			</ul>
		</div>
	</div>
	<div class="contentpanel product order_list">
		@include('base::partials.errors')
		<div class="alert alert-success"
			data-ng-if="transCtrl.showResponseMessage">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<span>@{{transCtrl.responseMessage}}</span>
		</div>
		<div data-grid-view data-rows-per-page="10"
			data-route-name="transactions"
			data-template-route="admin/transactions" data-count="false"></div>
	</div>
</div>

@endsection @section('scripts')
<script src="{{$getBaseAssetsUrl('js/classieSidebarEffects.js')}}"></script>
<script	src="{{$getBaseAssetsUrl('js/classieSidebarEffectsDirective.js')}}"></script>
<script src="{{$getBaseAssetsUrl('js/requestFactory.js')}}"></script>
<script src="{{$getBaseAssetsUrl('js/Validate.js')}}"></script>
<script src="{{$getBaseAssetsUrl('js/validatorDirective.js')}}"></script>
<script src="{{$getBaseAssetsUrl('js/gridView.js')}}"></script>
<script src="{{$getPaymentAssetsUrl('js/transactions/index.js')}}"></script>
<script src="{{$getBaseAssetsUrl('js/grid.js')}}"></script>
@endsection
