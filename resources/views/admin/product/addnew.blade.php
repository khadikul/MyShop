@include('admin.header')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800 pb-5">Add New Product</h1>
    @if (session()->has('SuccessMessage'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close"> <span aria-hidden="true">&times;</span> </button>
            {{session()->get('SuccessMessage')}}
        </div>
    @endif
    <form action="{{url('insert-product')}}" method="post" class="mt-3 form-group" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-lg-8 col-md-8">

                <div class="product-title">
                    <input class="form-control" type="text" name="product_name" id="productName" placeholder="Enter Product Name">
                    <small id="productName" class="form-text text-danger font-weight-bold mt-1">
                        @error('product_name')
                            {{$message}}
                        @enderror
                    </small>
                </div>

                <div class="product-descripton my-4">
                    <textarea name="product_descripton" id="productDescription"></textarea>
                    <small id="productDescription" class="form-text text-danger font-weight-bold mt-1">
                        @error('product_descripton')
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
                                <textarea name="product_shortdes" id="productShortDes"></textarea>
                                <small id="productShortDes" class="form-text text-danger font-weight-bold mt-1">
                                    @error('product_shortdes')
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
                                            <input class="form-control" type="text" name="regular_price">
                                            <small id="regularPrice" class="form-text text-danger font-weight-bold mt-1">
                                                @error('regular_price')
                                                    {{$message}}
                                                @enderror
                                            </small>
                                        </div>
                                        <div class="sale-price">
                                            <label for="salePrice">Sale Peice($)</label>
                                            <input class="form-control" type="text" name="sale_price">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="product-sku">
                                        <label for="productSKU">SKU</label>
                                        <input class="form-control" type="text" name="product_sku">
                                        <small id="productSKU" class="form-text text-danger font-weight-bold mt-1">
                                            @error('product_sku')
                                                {{$message}}
                                            @enderror
                                        </small>
                                    </div>
                                    <hr>
                                    <div class="product-quantity">
                                        <label for="productQuantity">Product Quantiy</label>
                                        <input class="form-control" type="number" name="product_quantity" id="productQuantity">
                                    </div>
                                    <hr>
                                    <div class="product-stock">
                                        <label for="productStock">Product Stock: </label>
                                        <select class="selectpicker" name="product_stock" id="productStock">
                                            <option value="InStock">In Stock</option>
                                            <option value="OutStock">Out Of Stock</option>
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
                                                <input class="d-none" type="file" name="product_gallery_imgOne" id="pgi1" onchange="pgiOnePreview(event)">
                                                <small id="pgi1" class="form-text text-danger font-weight-bold mt-1">
                                                    @error('product_gallery_imgOne')
                                                        {{$message}}
                                                    @enderror
                                                </small>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="gallary_preview">
                                                    <img src="" alt="" id="gpi1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="product-second-img">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="pgi2" class="btn btn-success">Upload</label>
                                                <input class="d-none" type="file" name="product_gallery_imgTwo" id="pgi2" onchange="pgiTwoPreview(event)">
                                                <small id="pgi2" class="form-text text-danger font-weight-bold mt-1">
                                                    @error('product_gallery_imgTwo')
                                                        {{$message}}
                                                    @enderror
                                                </small>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="gallary_preview">
                                                    <img src="" alt="" id="gpi2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="product-three-img">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="pgi3" class="btn btn-success">Upload</label>
                                                <input class="d-none" type="file" name="product_gallery_imgThree" id="pgi3" onchange="pgiThreePreview(event)">
                                                <small id="pgi3" class="form-text text-danger font-weight-bold mt-1">
                                                    @error('product_gallery_imgThree')
                                                        {{$message}}
                                                    @enderror
                                                </small>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="gallary_preview">
                                                    <img src="" alt="" id="gpi3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="product-four-img">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="pgi4" class="btn btn-success">Upload</label>
                                                <input class="d-none" type="file" name="product_gallery_imgFour" id="pgi4" onchange="pgiFourPreview(event)">
                                                <small id="pgi4" class="form-text text-danger font-weight-bold mt-1">
                                                    @error('product_gallery_imgFour')
                                                        {{$message}}
                                                    @enderror
                                                </small>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="gallary_preview">
                                                    <img src="" alt="" id="gpi4">
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
                        <input type="submit" name="draft" value="Draft" class="btn btn-primary">
                        <input type="submit" name="publish" value="Publish" class="btn btn-success ml-2">
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
                                <select class="selectpicker" name="productCategory" id="product-catgory" style="width: 100%">
                                    <option value="">Nothing select</option>
                                    @foreach ($category as $categoryItem)
                                        <option value="{{$categoryItem->id}}">{{$categoryItem->category_name}}</option>
                                    @endforeach
                                </select>
                                <small id="product-catgory" class="form-text text-danger font-weight-bold mt-1">
                                    @error('productCategory')
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
                                <select class="selectpicker" name="productBrand" id="product-catgory" style="width: 100%">
                                    <option value="">Nothing select</option>
                                    @foreach ($brand as $brandItem)
                                        <option value="{{$brandItem->id}}">{{$brandItem->brand_name}}</option>
                                    @endforeach
                                </select>
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
                                <div class="futureImgPreview">
                                    <img src="" alt="" id="futureImagePreview">
                                </div>
                                <label for="futureImg">upload your future image</label>
                                <input class="d-none" type="file" name="future_image" id="futureImg" onchange="showPreview(event)">
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