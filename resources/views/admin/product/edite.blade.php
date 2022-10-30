@include('admin.header')


<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800 pb-5">Update Product</h1>
    @if (session()->has('SuccessMessage'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close"> <span aria-hidden="true">&times;</span> </button>
            {{session()->get('SuccessMessage')}}
        </div>
    @endif
    <form action="{{url('update-product')}}" method="post" class="mt-3 form-group" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="hiiden-data">
            <input type="hidden" name="productID" value="{{$product->id}}">
            <input type="hidden" name="old_image1" value="{{$product->product_gallery_img1}}">
            <input type="hidden" name="old_image2" value="{{$product->product_gallery_img2}}">
            <input type="hidden" name="old_image3" value="{{$product->product_gallery_img3}}">
            <input type="hidden" name="old_image4" value="{{$product->product_gallery_img4}}">
            <input type="hidden" name="old_futureImg" value="{{$product->product_future_image}}">
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8">

                <div class="product-title">
                    <input class="form-control" type="text" name="product_name_update" value="{{$product->product_name}}" id="productName" placeholder="Enter Product Name">
                    <small id="productName" class="form-text text-danger font-weight-bold mt-1">
                        @error('product_name_update')
                            {{$message}}
                        @enderror
                    </small>
                </div>

                <div class="product-descripton my-4">
                    <textarea name="product_descripton_update" id="productDescription">{{$product->product_description}}</textarea>
                    <small id="productDescription" class="form-text text-danger font-weight-bold mt-1">
                        @error('product_descripton_update')
                            {{$message}}
                        @enderror
                    </small>
                </div>

                <div class="product-shortDescripton">
                    <div class="card mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#productDes" class="d-block card-header py-3" data-toggle="collapse"
                            role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Product Short Description</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="productDes">
                            <div class="card-body">
                                <textarea name="product_shortdes_update" id="productShortDes">{{$product->product_short_tdescripton}}</textarea>
                                <small id="productShortDes" class="form-text text-danger font-weight-bold mt-1">
                                    @error('product_shortdes_update')
                                        {{$message}}
                                    @enderror
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                                
                <div class="product-shortDescripton">
                    <div class="card mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#productDetails" class="d-block card-header py-3" data-toggle="collapse"
                            role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="productDetails">
                            <div class="card-body ml-3">
                                <div class="product-details">
                                    <div class="product-price">
                                        <div class="regular-price">
                                            <label for="regularPrice">Regular Price($)</label>
                                            <input class="form-control" type="text" name="regular_price_update" value="{{$product->product_regular_price}}">
                                            <small id="regularPrice" class="form-text text-danger font-weight-bold mt-1">
                                                @error('regular_price')
                                                    {{$message}}
                                                @enderror
                                            </small>
                                        </div>
                                        <div class="sale-price">
                                            <label for="salePrice">Sale Peice($)</label>
                                            <input class="form-control" type="text" name="sale_price_update" value="{{$product->product_sale_price}}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="product-sku">
                                        <label for="productSKU">SKU</label>
                                        <input class="form-control" type="text" name="product_sku_update" value="{{$product->product_sku}}">
                                        <small id="productSKU" class="form-text text-danger font-weight-bold mt-1">
                                            @error('product_sku')
                                                {{$message}}
                                            @enderror
                                        </small>
                                    </div>
                                    <hr>
                                    <div class="product-quantity">
                                        <label for="productQuantity">Product Quantiy</label>
                                        <input class="form-control" type="number" name="product_quantity_update" id="productQuantity" value="{{$product->product_quantity}}">
                                    </div>
                                    <hr>
                                    <div class="product-stock">
                                        <label for="productStock">Product Stock: </label>
                                        <select class="selectpicker" name="product_stock_update" id="productStock">
                                            <option value="InStock" {{$product->product_stock == 'InStock' ? 'SELECTED' : ''}}>In Stock</option>
                                            <option value="OutStock" {{$product->product_stock == 'OutStock' ? 'SELECTED' : ''}}>Out Of Stock</option>
                                        </select>
                                        <small id="productStock" class="form-text text-danger font-weight-bold mt-1">
                                            @error('product_stock')
                                                {{$message}}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                
                <div class="product-shortDescripton">
                    <div class="card mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#productImageGallry" class="d-block card-header py-3" data-toggle="collapse"
                            role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Product Gallery Image</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="productImageGallry">
                            <div class="card-body">
                                <div class="product-img-gallery">
                                    <div class="product-first-img">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="pgi1" class="btn btn-success">Upload</label>
                                                <input class="d-none" type="file" name="product_gallery_imgOne_update" id="pgi1" onchange="pgiOnePreview(event)">
                                                <small id="pgi1" class="form-text text-danger font-weight-bold mt-1">
                                                    @error('product_gallery_imgOne_update')
                                                        {{$message}}
                                                    @enderror
                                                </small>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="edit_gallary_preview">
                                                    <img src="{{asset('upload/' . $product->product_gallery_img1)}}" alt="" id="gpi1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="product-second-img">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="pgi2" class="btn btn-success">Upload</label>
                                                <input class="d-none" type="file" name="product_gallery_imgTwo_update" id="pgi2" onchange="pgiTwoPreview(event)">
                                                <small id="pgi2" class="form-text text-danger font-weight-bold mt-1">
                                                    @error('product_gallery_imgTwo_update')
                                                        {{$message}}
                                                    @enderror
                                                </small>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="edit_gallary_preview">
                                                    <img src="{{asset('upload/' . $product->product_gallery_img2)}}" alt="" id="gpi2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="product-three-img">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="pgi3" class="btn btn-success">Upload</label>
                                                <input class="d-none" type="file" name="product_gallery_imgThree_update" id="pgi3" onchange="pgiThreePreview(event)">
                                                <small id="pgi3" class="form-text text-danger font-weight-bold mt-1">
                                                    @error('product_gallery_imgThree_update')
                                                        {{$message}}
                                                    @enderror
                                                </small>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="edit_gallary_preview">
                                                    <img src="{{asset('upload/' . $product->product_gallery_img3)}}" alt="" id="gpi3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="product-four-img">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="pgi4" class="btn btn-success">Upload</label>
                                                <input class="d-none" type="file" name="product_gallery_imgFour_update" id="pgi4" onchange="pgiFourPreview(event)">
                                                <small id="pgi4" class="form-text text-danger font-weight-bold mt-1">
                                                    @error('product_gallery_imgFour_update')
                                                        {{$message}}
                                                    @enderror
                                                </small>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="edit_gallary_preview">
                                                    <img src="{{asset('upload/' . $product->product_gallery_img4)}}" alt="" id="gpi4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Publish</h6>
                    </div>
    
                   <div class="card-body">
                        @if ($product->post_status == 'Draft')
                            <input type="submit" name="publish" value="Publish" class="btn btn-success ml-2">
                        @else
                            <input type="submit" name="publish" value="Update" class="btn btn-success ml-2">
                        @endif
                    </div>
                </div>
                <div class="product-category">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#category" class="d-block card-header py-3" data-toggle="collapse"
                            role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Product Category</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="category">
                            <div class="card-body">
                                <select class="selectpicker" name="productCategory_update" id="product-catgory" style="width: 100%">
                                    <option value="">Nothing select</option>
                                    @foreach ($category as $categoryItem)
                                        <option value="{{$categoryItem->id}}" {{$categoryItem->id == $product->product_category ? "SELECTED" : ''}}>{{$categoryItem->category_name}}</option>
                                    @endforeach
                                </select>
                                <small id="product-catgory" class="form-text text-danger font-weight-bold mt-1">
                                    @error('productCategory_update')
                                        {{$message}}
                                    @enderror
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-category">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#brand" class="d-block card-header py-3" data-toggle="collapse"
                            role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Product Brand</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="brand">
                            <div class="card-body">
                                <select class="selectpicker" name="productBrand_update" id="product-catgory" style="width: 100%">
                                    <option value="">Nothing select</option>
                                    @foreach ($brand as $brandItem)
                                        <option value="{{$brandItem->id}}" {{$brandItem->id == $product->category_brand ? 'SELECTED' : ''}}>{{$brandItem->brand_name}}</option>
                                    @endforeach
                                </select>
                                <small id="product-catgory" class="form-text text-danger font-weight-bold mt-1">
                                    @error('productBrand_update')
                                        {{$message}}
                                    @enderror
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-category">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#futureImage" class="d-block card-header py-3" data-toggle="collapse"
                            role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Product Thumbnail</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="futureImage">
                            <div class="card-body futureImage">
                                <div class="futureImgPreviews">
                                    <img src="{{asset('upload/' . $product->product_future_image)}}" alt="" id="futureImagePreview">
                                </div>
                                <label for="futureImg">upload your future image</label>
                                <input class="d-none" type="file" name="future_image_update" id="futureImg" onchange="showPreview(event)">
                                <small id="futureImg" class="form-text text-danger font-weight-bold mt-1">
                                    @error('future_image')
                                        {{$message}}
                                    @enderror
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@include('admin.footer')