
    @csrf
    {{ method_field('PUT') }}
    <div class="modal-body">
            <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="category" class="form-control" value="{{$category->category_name}}" placeholder="Enter Category Name">
            <input type="hidden" name="id" value="{{$category->cat_id}}" >
        </div>
        <div class="form-group">
            <label>Category Slug</label>
            <input type="text" name="category_slug" class="form-control" value="{{$category->category_slug}}" placeholder="Enter Category Name">
        </div>
        <div class="form-group row">
            <label class="col-md-2">Image <small class="text-danger">*</small></label>
            <div class="custom-file col-md-7">
                <input type="hidden" class="custom-file-input" name="old_img" value="" />
                <input type="file" class="custom-file-input" name="img" onChange="readURL(this);">
                <label class="custom-file-label">Choose file</label>
            </div>
            <div class="col-md-3 text-right">
                @if($category->image != '')
                    <img id="image" src="{{asset('public/category/'.$category->image)}}" alt="" width="80px" height="80px">
                @else
                    <img id="image" src="{{asset('public/category/default.jpg')}}" alt="" width="80px" height="80px">
                @endif
            </div>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="" selected disabled>Select Status</option>   
                <option value="1" {{ ($category->status == "1" ? "selected":"") }}>Active</option>
                <option value="0" {{ ($category->status == "0" ? "selected":"") }}>Inactive</option> 
            </select>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="submit" class="btn btn-primary ">Update</button>
    </div>
