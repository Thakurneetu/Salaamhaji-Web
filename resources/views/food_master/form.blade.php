<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label>Service Category</label>
      <select name="category_id" id="category" class="form-control">
        <option value="" selected disabled>Select Service Category</option>
        @foreach($categories as $category)
        <option value="{{$category->id}}" {{old('category_id' , @$loundryMaster->category_id) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-6 col-12">
      <label >Service Name</label>
      <input type="text" name="name" value="{{old('name') ?? (@$loundryMaster->name ?? '')}}" 
      class="form-control @error('name') is-invalid @enderror" placeholder="Enter Service Name" required>
      @error('name')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label >Price</label>
      <input type="text" name="price" value="{{old('price') ?? (@$loundryMaster->price ?? '')}}" 
      class="form-control @error('email') is-invalid @enderror" placeholder="Enter Customer Email" required>
      @error('price')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label>Weight (in grams)</label>
      <input type="text" name="weight" value="{{old('price') ?? (@$loundryMaster->price ?? '')}}" 
      class="form-control @error('email') is-invalid @enderror" placeholder="Enter Weight" required>
      @error('weight')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>

<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-success text_black">Save</button>
  <a href="{{ route('food_master.index') }}" class="btn btn-secondary ml-3">Cancel</a>
</div>