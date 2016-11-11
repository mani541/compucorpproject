@extends('layout.master')
@section('content')
	<div class="well">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		@if(Session('message')) 
			<div class="alert alert-success"> 
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{Session('message')}} 
			</div> 
		@endif
		{!! Form::open(['url' => '/store', 'class' => 'form-horizontal']) !!}
		<fieldset>
			<legend>Add Address</legend>
			<div class="form-group">
				{!! Form::label('name', 'Name:', ['class' => 'col-lg-4 col-md-4 col-sm-4 control-label required-field']) !!}
				<div class="col-lg-6 col-md-6 col-sm-6">
					{!! Form::text('name', $value = null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('phone', 'Phone:', ['class' => 'col-lg-4 col-md-4 col-sm-4 control-label']) !!}
				<div class="col-lg-6 col-md-6 col-sm-6">
					{!! Form::number('phone', $value = null, ['class' => 'form-control', 'placeholder' => 'Number']) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('email', 'Email:', ['class' => 'col-lg-4 col-md-4 col-sm-4 control-label']) !!}
				<div class="col-lg-6 col-md-6 col-sm-6">
					{!! Form::email('email', $value = null, ['class' => 'form-control', 'placeholder' => 'email']) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('address', 'Address:', ['class' => 'col-lg-4 col-md-4 col-sm-4 control-label required-field']) !!}
				<div class="col-lg-6 col-md-6 col-sm-6">
					{!! Form::textarea('address', $value = null, ['class' => 'form-control', 'rows' => 3]) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('select', 'Select Preferred Communication', ['class' => 'col-lg-4 col-md-4 col-sm-4 control-label'] )  !!}
				<div class="col-lg-6 col-md-6 col-sm-6">
					{!!  Form::select('modecom', ['phone' => 'Phone', 'email' => 'Email'],  'email', ['class' => 'form-control' ]) !!}
				</div>
			</div>
			<div class="form-group">
				<div class="text-center">
					{!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info'] ) !!}
				</div>
			</div>
		{!! Form::close()  !!}
		</fieldset>
	</div>
	@if(isset($address))
		<div class="well">
			<fieldset>
				<legend>Added Addresses</legend>
				<div class="table-responsive"> 
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Id</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Address</th>
							</tr>
						</thead>
						<tbody>
							@foreach($address as $addr)
								<tr>
									<td>{{$addr['_id']}}</td>
									<td>{{$addr['_source']['name']}}</td>
									<td>{{$addr['_source']['phone']}}</td>
									<td>{{$addr['_source']['email']}}</td>
									<td>{{$addr['_source']['address']}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</fieldset>
		</div>
	@endif