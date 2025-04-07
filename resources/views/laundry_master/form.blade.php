<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label>Area</label>
      <select name="area_id" id="area" class="form-control  @error('area_id') is-invalid @enderror">
        <option value="" selected disabled>Select Area</option>
        @foreach($areas as $area)
        <option value="{{$area->id}}" {{old('area_id' , @$laundryMaster->area_id) == $area->id ? 'selected' : ''}}>{{$area->name}}</option>
        @endforeach
      </select>
      @error('area_id')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label>Service Category</label>
      <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
        <option value="" selected disabled>Select Service Category</option>
        @foreach($categories as $category)
        <option value="{{$category->id}}" {{old('category_id' , @$laundryMaster->category_id) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
        @endforeach
      </select>
      @error('category_id')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="name">Service Name</label>
      <input type="text" name="name" value="{{old('name') ?? (@$laundryMaster->name ?? '')}}" 
      class="form-control @error('name') is-invalid @enderror" placeholder="Enter Service Name" required>
      @error('name')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="email">Price</label>
      <input type="number" step="any" name="price" value="{{old('price') ?? (@$laundryMaster->price ?? '')}}" 
      class="form-control @error('price') is-invalid @enderror" placeholder="Enter Price" required>
      @error('price')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="icon">Icon</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input @error('icon') is-invalid @enderror" id="icon" name="icon">
          <label class="custom-file-label" for="icon">Select Icon</label>
        </div>
      </div>
      @error('icon')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    @if(isset($laundryMaster) && $laundryMaster->icon)
      <img style='width:100px' src="{{asset(@$laundryMaster->icon)}}" alt='Icon'>
    @endif
  </div>
</div>

<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-success text_black">Save</button>
  <a href="{{ route('laundry_master.index') }}" class="btn btn-secondary ml-3">Cancel</a>
</div>