@include('components.header')


<div class="container" style="margin-top: 10px;">
	<form method="post" action="">
		@csrf
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-2">
						<input type="text" name="keyword" value="{{app('request')->input('keyword')}}" placeholder="Search Keyword" >
					</div>
					<div class="col-md-4 header-btn">
						<button type="submit" class="btn btn-md"><img src="/images/search.png" style="width: 25px;" /></button>
						<a href="/" class="btn btn-md"><img src="/images/reset.png" style="width: 25px;" /></a>
						<a href="/product/add" class="btn btn-md btn-success">Add Product</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
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
				  	 @php $j = $i; @endphp
				  	@foreach($products as $row)
				    <tr>
				      <th scope="row">{{$j++}}</th>
				      <td>{{$row->product_name}}</td>
				      <td>{{$row->product_price}}</td>
				      <td>{{$row->product_description}}</td>
				      <td>
				      	<a href="/product/edit/<?php echo $row->id;?>"><img src="/images/edit1.png" style="margin-top: 4px; width: 25px;" /></a>
				      	<a href="/product/destroy/<?php echo $row->id;?>"><img src="/images/trash-bin.png" style="margin-top: 4px; width: 25px;" /></a>
				      </td>
				    </tr>
				    @endforeach
				  </tbody>
				</table>		
			</div>	
		</div>
		<div align="right">{!!$products->render()!!}</div>
	</form>
</div>


@include('components.footer')

<style type="text/css">
	@media only screen and (max-width: 768px) {
  .header-btn {
  	margin-top: 10px;
  	margin-bottom: 10px;
  }
}
</style>