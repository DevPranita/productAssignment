<?php echo $__env->make('components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="container">
	<div class="table-responsive">
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Product Name</th>
		      <th scope="col">Product Price</th>
		      <th scope="col">Product Description</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		  	 <?php $j = $i; ?>
		  	<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		    <tr>
		      <th scope="row"><?php echo e($j++); ?></th>
		      <td><?php echo e($row->product_name); ?></td>
		      <td><?php echo e($row->product_price); ?></td>
		      <td><?php echo e($row->product_description); ?></td>
		      <td>
		      	<a href="/product/edit/<?php echo $row->id;?>"><img src="/images/edit1.png" style="margin-top: 4px; width: 25px;" /></a>
		      	<a href="/product/destroy/<?php echo $row->id;?>"><img src="/images/trash-bin.png" style="margin-top: 4px; width: 25px;" /></a>
		      </td>
		    </tr>
		    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  </tbody>
		</table>		
	</div>	
</div>


<?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\example-app\resources\views/index.blade.php ENDPATH**/ ?>