@include('admin.header')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800 pb-5">Product Branding</h1>
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">All brand</h6>
                </div>
                <div class="card-body">
                    @if (session()->has('updateSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="close"> <span aria-hidden="true">&times;</span> </button>
                            {{session()->get('updateSuccess')}}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Brand Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($productBrand as $brandItem)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$brandItem->brand_name}}</td>
                                        <td class="text-center">
                                            <a href="{{url('web-admin/brand-edit',$brandItem->id)}}"><i class="fas fa-edit"></i></a> | 
                                            <a href="{{url('web-admin/brand-delete',$brandItem->id)}}"><i class="fas fa-trash-alt text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Brand</h6>
                </div>

                <div class="card-body">
                    @if (session()->has('successMessage'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="close"> <span aria-hidden="true">&times;</span> </button>
                            {{session()->get('successMessage')}}
                        </div>
                    @endif
                    <form action="{{url('product-brand')}}" method="post">
                        @csrf
                        @method('POST')
                        <label for="brandName">Name</label>
                        <input class="form-control" type="text" name="brandName" id="brandName" required>
                        <small id="brandName" class="form-text text-danger font-weight-bold mt-1">
                            @error('brandName')
                                {{$message}}
                            @enderror
                        </small>
                        <button class="btn btn-primary my-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@include('admin.footer')