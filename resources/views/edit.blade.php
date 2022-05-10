@include('components.header')
<div class="container">
	<form method="post" action="" enctype="multipart/form-data">
		@csrf
	  <div class="form-group">
	    <label>Product Name</label>
	    <input type="text" name="product_name" class="form-control" value="{{$result->product_name}}" placeholder="Product name">
	  </div>
	  <div class="form-group">
	    <label>Product Price</label>
	    <input type="text" name="product_price" class="form-control" value="{{$result->product_price}}" placeholder="Product Price">
	  </div>
	  <div class="form-group">
	    <label>Product description</label>
	    <textarea class="form-control" name="product_description" placeholder="Product Description"><?php echo $result->product_description;?></textarea>
	  </div>
	  <div class="form-group">
	    <label>Product images</label>
	    <input type="file" name="images[]" class="form-control" multiple="multiple" accept="image/*">
	  </div>
	  <div class="form-group">
	  	<button type="submit" class="btn btn-md btn-success">Update</button>
	  	<a href="/" class="btn btn-md btn-info">Back</a>
	  </div>
	</form>
</div>

@include('components.footer')