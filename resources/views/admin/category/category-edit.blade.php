@include('admin.header')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800 pb-5">Category Edit</h1>
    <div class="col-lg-5 col-md-5 m-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
            </div>

            <div class="card-body">
                @if (session()->has('sucessMessage'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close"> <span aria-hidden="true">&times;</span> </button>
                        {{session()->get('sucessMessage')}}
                    </div>
                @endif
                <form action="{{url('update-category')}}" method="POST">
                    @csrf
                    @method('POST')
                    <label for="categoryName">Name</label>
                    <input type="hidden" name="categoriesID" value="{{$editCategory->id}}">
                    <input class="form-control" type="text" name="updateCategory_name" value="{{$editCategory->category_name}}" id="categoryName" required>
                    <small id="emailHelp" class="form-text text-danger font-weight-bold mt-1">
                        @error('updateCategory_name')
                            {{$message}}
                        @enderror
                    </small>
                    <button class="btn btn-primary my-3">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')