<div class="col-md-4">
	<div class="list-group">
		
		@foreach(App\model\Category::where('parent_id',null)->get() as $category)

		<p>
			<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample{{$category->id}}" aria-expanded="false" aria-controls="multiCollapseExample{{$category->id}}">{{$category->name}}
			</button>
		</p>

		<div class="row">
			<div class="col">
				<div class="collapse multi-collapse" id="multiCollapseExample{{$category->id}}">
					<div class="card card-body">
						
						@php
						$i = 0;
						@endphp

						@foreach ($category->getChild($category->id) as $child)

						@php
						$i++;
						@endphp
						@if ($i == 1)
						@foreach ($category->brands as $brand)
						Brand - <a href="{{ route('product.brandSearch',$brand->id) }}"><button class="btn btn-info">{{$brand->name}}</button></a></br>
						@endforeach
						@endif

						<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample{{$child->id}}" aria-expanded="false" aria-controls="multiCollapseExample{{$child->id}}">{{$child->name}}<a style="color:red" href="{{route('product.categorySearch',$child->id)}}">--></a></button></br>
						
						

						<div class="col">
							<div class="collapse multi-collapse" id="multiCollapseExample{{$child->id}}">
								<div class="card card-body">
									
									@foreach ($child->getChild($child->id) as $dChild)
									@if ($i == 3)
									@foreach ($child->brands as $brand)
									Brand - <a href="{{ route('product.brandSearch',$brand->id) }}"><button class="btn btn-info">{{$brand->name}}</button></a></br>
									@endforeach
									@endif
									@php
									$i++;
									@endphp
									<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample{{$dChild->id}}" aria-expanded="false" aria-controls="multiCollapseExample{{$dChild->id}}">{{$dChild->name}}<a style="color:red" href="{{route('product.categorySearch',$dChild->id)}}">--></a></button></br>


									<div class="collapse multi-collapse" id="multiCollapseExample{{$dChild->id}}">
										@foreach ($dChild->getChild($dChild->id) as $tChild)

										
										<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample{{$tChild->id}}" aria-expanded="false" aria-controls="multiCollapseExample{{$tChild->id}}">{{$tChild->name}}<a style="color:red" href="{{route('product.categorySearch',$tChild->id)}}">--></a></button></br>
										
										@foreach ($tChild->brands as $brand)

										Brand - <a href="{{ route('product.brandSearch',$brand->id) }}"><button class="btn btn-info">{{$brand->name}}</button></a></br>
										@endforeach
										
										@endforeach

										@foreach ($dChild->brands as $brand)
										Brand - <a href="{{ route('product.brandSearch',$brand->id) }}"><button class="btn btn-info">{{$brand->name}}</button></a></br>
										@endforeach
									</div>





									@endforeach
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>

		</div>
		@endforeach



	</div>
</div>