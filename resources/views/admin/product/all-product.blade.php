@include('admin.header')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">All Product</h1>
        <a href="{{url('web-admin/add-new')}}"><button class="btn btn-primary mb-5">Add New</button></a>
        @if (session()->has('updatesuccess'))
            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="close"> <span aria-hidden="true">&times;</span> </button>
                {{session()->get('updatesuccess')}}
            </div>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">product manage</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center"><i class="far fa-1x fa-image"></i></th>
                                <th>Product Name</th>
                                <th>SKU</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center"><i class="far fa-image"></i></th>
                                <th>Product Name</th>
                                <th>SKU</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Date</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($product as $products)
                                <tr class="products-row">
                                    <td class="text-center" style="width: 10%"><img style="width: 50%" src="../upload/{{$products->product_future_image}}" alt=""></td>
                                    <td>
                                        {{\Illuminate\Support\Str::limit($products->product_name, 15, ' ....')}}  
                                        @if ($products->post_status == 'Draft')
                                            <a class="text-danger">({{$products->post_status}})</a>
                                        @endif
                                        <div class="product-action">
                                            <a class="mr-2 text-success" data-toggle="Edit" data-placement="top" title="Edit" href="{{url('web-admin/product-edit', $products->id)}}"><i class="fas fa-pen"></i></a>
                                            <a class="mr-2 text-danger" onclick="return confirm('Are You Sure Delete The Product')" data-toggle="Delete" data-placement="top" title="Delete" href="{{url('web-admin/product-delete', $products->id)}}"><i class="fas fa-trash"></i></a>
                                            <a data-toggle="View" data-placement="top" title="View" href=""><i class="fas fa-eye"></i></a>
                                        </div>
                                    </td>
                                    @if ($products->product_sku)
                                        <td>{{$products->product_sku}}</td>
                                    @else
                                        <td class="text-center"> - </td>
                                    @endif

                                    @if ($products->product_stock == 'InStock')
                                        <td class="text-success font-weight-bold">{{$products->product_stock}}</td>
                                    @else
                                        <td class="text-danger font-weight-bold">{{$products->product_stock}}</td>
                                    @endif
                                    @if ($products->product_regular_price && $products->product_sale_price)
                                        <td>${{$products->product_regular_price}} - ${{$products->product_sale_price}}</td>
                                    @else
                                        <td>${{$products->product_regular_price}}</td>
                                    @endif
                                    <td>{{$products->category->category_name}}</td>
                                    @if ($products->created_at == $products->updated_at)
                                        <td>
                                            Publish Date<br>
                                            {{$products->created_at}}
                                        </td>
                                    @else
                                        <td>
                                            Last Modefied<br>
                                            {{$products->updated_at}}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>

@include('admin.footer')