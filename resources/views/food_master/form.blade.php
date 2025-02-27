<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label>Service Category</label>
      <select name="category_id" id="category" class="form-control">
        <option value="" selected disabled>Select Service Category</option>
        @foreach($categories as $category)
        <option value="{{$category->id}}" {{old('category_id' , @$foodMaster->category_id) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-6 col-12">
      <label >Service Name</label>
      <input type="text" name="name" value="{{old('name') ?? (@$foodMaster->name ?? '')}}" 
      class="form-control @error('name') is-invalid @enderror" placeholder="Enter Service Name" required>
      @error('name')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label >Price</label>
      <input type="text" name="price" value="{{old('price') ?? (@$foodMaster->price ?? '')}}" 
      class="form-control @error('price') is-invalid @enderror" placeholder="Enter Price" required>
      @error('price')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label>Serves (People count)</label>
      <input type="text" name="serves" value="{{old('serves') ?? (@$foodMaster->serves ?? '')}}" 
      class="form-control @error('serves') is-invalid @enderror" placeholder="Enter Number of People" required>
      @error('serves')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="cab_catalogue">Item Image</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="image" name="image" {{@$foodMaster->image != '' ? '' : 'required'}}>
          <label class="custom-file-label" for="cab_catalogue">Select Item Image</label>
        </div>
      </div>
    </div>
    @if(isset($foodMaster) && $foodMaster->image)
    <div class="form-group col-md-6 col-12">
      <img class="rounded" style='width:250px' src="{{asset(@$foodMaster->image)}}" alt='Image'>
      </div>
    @endif
  </div>
</div>

<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-success text_black">Save</button>
  <a href="{{ route('food_master.index') }}" class="btn btn-secondary ml-3">Cancel</a>
</div>