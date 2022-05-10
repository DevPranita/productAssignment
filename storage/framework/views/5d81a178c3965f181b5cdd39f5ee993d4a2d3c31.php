<?php echo $__env->make('components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container">
	<form method="post" action="" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>
	  <div class="form-group">
	    <label>Product Name</label>
	    <input type="text" name="product_name" class="form-control" value="<?php echo e($result->product_name); ?>" placeholder="Product name">
	  </div>
	  <div class="form-group">
	    <label>Product Price</label>
	    <input type="text" name="product_price" class="form-control" value="<?php echo e($result->product_price); ?>" placeholder="Product Price">
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

<?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\example-app\resources\views/edit.blade.php ENDPATH**/ ?>