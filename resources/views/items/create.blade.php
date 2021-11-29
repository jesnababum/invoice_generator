@extends('items.layout')

  

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add Item</h2>

        </div>

        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('items.index') }}"> View Items</a>
        </div>
    </div>
</div>

   

@if ($errors->any())

    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

   

<form action="{{ route('items.store') }}" method="POST">

    @csrf

  

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Item Name:</strong>
                <input type="text" name="product_name" class="form-control" placeholder="Name">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Quantity:</strong>
                <input type="text" name="quantity" class="form-control" placeholder="Quantity">
            </div>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Unit Price:</strong>
                <input type="text" name="unit_price" class="form-control" placeholder="Unit Price">
            </div>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tax(%):</strong>

                <select name="tax_percentage" class="form-control">
					<option value="0" name="tax_percentage">0%</option>
					<option value="1" name="tax_percentage">1%</option>
					<option value="5" name="tax_percentage">5%</option>
					<option value="10" name="tax_percentage">10%</option>
				</select

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>

   

</form>

@endsection