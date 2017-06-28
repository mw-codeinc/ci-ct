<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Coalition Technologies</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
	</head>
	<body>
		<div id="success-msg" class="alert alert-info">
			Product has been added to list
		</div>
		<div id="error-msg-cnt"></div>

		{!! Form::open(array('route' => '/', 'method' => 'POST', 'id' => 'productForm', 'class' => 'form-inline')) !!}

		<div class="form-group">
			{!! Form::text('productName', null,
				array('required',
					  'class'=>'form-control',
					  'placeholder'=>'Product Name')) !!}
		</div>

		<div class="form-group">
			{!! Form::text('quantity', null,
				array('required',
					  'class'=>'form-control',
					  'placeholder'=>'Quantity in stock')) !!}
		</div>

		<div class="form-group">
			{!! Form::text('price', null,
				array('required',
					  'class'=>'form-control',
					  'placeholder'=>'Price per item')) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Submit',
			  array('class'=>'btn btn-primary')) !!}
		</div>
		{!! Form::close() !!}

		<table id="product-table" class="table table-striped">
			<thead>
				<tr>
					<th>Product name</th>
					<th>Quantity in stock</th>
					<th>Price per item</th>
					<th>Datetime submitted</th>
					<th>Total value number</th>
				</tr>
			</thead>
			<tbody>
				@if(count($collection) > 0)
					@foreach($collection as $obj)
						<tr>
							<td><?php echo $obj->name; ?></td>
							<td><?php echo $obj->qty; ?></td>
							<td><?php echo sprintf("%0.2f", $obj->price); ?></td>
							<td><?php echo $obj->datetime; ?></td>
							<td><?php echo sprintf("%0.2f", $obj->total); ?></td>
						</tr>
					@endforeach
				@else
					<tr>
						<td colspan="5">No products found</td>
					</tr>
				@endif
			</tbody>
			<tfoot>
				<tr>
					<td colspan="5">Total: <?php echo sprintf("%0.2f", $total); ?></td>
				</tr>
			</tfoot>
		</table>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/product/index.js"></script>
		<script> var url = "{{\URL::to('/')}}"; </script>
	</body>
</html>
