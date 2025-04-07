
<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <h4>Area</h4>
      <select name="area_id" id="area" class="form-control">
        <option value="" selected disabled>Select Area</option>
        @foreach($areas as $area)
        <option value="{{$area->id}}" {{old('area_id' , @$foodMenu->area_id) == $area->id ? 'selected' : ''}}>{{$area->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-6 col-12">
      <h4>Hotel Package</h4>
      <input type="text" class="form-control" name="package" value="{{old('package') ?? (@$foodMenu->package ?? '')}}" required>
    </div>
  </div>
  <div class="form-group">
      <h4>Pricing</h4>
      <table class="table table-bordered table-dark">
          <thead>
              <tr>
                  <th>All</th>
                  <th>Combo</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td><input type="text" class="form-control" name="all_price" value="{{old('all_price') ?? (@$foodMenu->all_price ?? '')}}" required></td>
                  <td><input type="text" class="form-control" name="combo_price" value="{{old('combo_price') ?? (@$foodMenu->combo_price ?? '')}}" required></td>
              </tr>
          </tbody>
      </table>
  </div>
  {{--
  <div class="form-group">
      <h4>Meal Timings</h4>
      <table class="table table-bordered table-dark">
          <thead>
              <tr>
                  <th>Meal</th>
                  <th>Start</th>
                  <th>End</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>Breakfast</td>
                  <td><input type="text" class="form-control timepicker" name="breakfast_start" value="{{old('breakfast_start') ?? ((isset($foodMenu) AND $foodMenu->breakfast_start) ? date('H:i', strtotime($foodMenu->breakfast_start)) : '')}}" required></td>
                  <td><input type="text" class="form-control timepicker" name="breakfast_end" value="{{old('breakfast_end') ?? ((isset($foodMenu) AND $foodMenu->breakfast_end) ? date('H:i', strtotime($foodMenu->breakfast_end)) : '')}}" required></td>
              </tr>
              <tr>
                  <td>Lunch</td>
                  <td><input type="text" class="form-control timepicker" name="lunch_start" value="{{old('lunch_start') ?? ((isset($foodMenu) AND $foodMenu->lunch_start) ? date('H:i', strtotime($foodMenu->lunch_start)) : '')}}" required></td>
                  <td><input type="text" class="form-control timepicker" name="lunch_end" value="{{old('lunch_end') ?? ((isset($foodMenu) AND $foodMenu->lunch_end) ? date('H:i', strtotime($foodMenu->lunch_end)) : '')}}" required></td>
              </tr>
              <tr>
                  <td>Dinner</td>
                  <td><input type="text" class="form-control timepicker" name="dinner_start" value="{{old('dinner_start') ?? ((isset($foodMenu) AND $foodMenu->dinner_start) ? date('H:i', strtotime($foodMenu->dinner_start)) : '')}}" required></td>
                  <td><input type="text" class="form-control timepicker" name="dinner_end" value="{{old('dinner_end') ?? ((isset($foodMenu) AND $foodMenu->dinner_end) ? date('H:i', strtotime($foodMenu->dinner_end)) : '')}}" required></td>
              </tr>
          </tbody>
      </table>
  </div>
  --}}
  <div class="form-group">
      <label for="week_menu">Weekly Menu</label>
      <table class="table table-bordered table-dark">
          <thead>
              <tr>
                  <th>Day</th>
                  <th>Breakfast</th>
                  <th>Lunch</th>
                  <th>Dinner</th>
              </tr>
          </thead>
          <tbody>
              @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
              <tr>
                  <td>{{ $day }}</td>
                  <td><textarea class="form-control" name="menu[{{ strtolower($day) }}][breakfast]">{{old('menu[strtolower($day)][breakfast]') ?? (isset($foodMenu) ? ($foodMenu->items->where('day',strtolower($day))->where('meal','breakfast')->first()->meal_items ?? '') : '')}}</textarea></td>
                  <td><textarea class="form-control" name="menu[{{ strtolower($day) }}][lunch]">{{old('menu[strtolower($day)][lunch]') ?? (isset($foodMenu) ? ($foodMenu->items->where('day',strtolower($day))->where('meal','lunch')->first()->meal_items ?? '') : '')}}</textarea></td>
                  <td><textarea class="form-control" name="menu[{{ strtolower($day) }}][dinner]">{{old('menu[strtolower($day)][dinner]') ?? (isset($foodMenu) ? ($foodMenu->items->where('day',strtolower($day))->where('meal','dinner')->first()->meal_items ?? '') : '')}}</textarea></td>
              </tr>
              @endforeach
              <tr>
                  <td>Common <br> (Based on <br> availability) </td>
                  <td><textarea class="form-control" name="menu[common][breakfast]">{{old('menu[common][breakfast]') ?? (isset($foodMenu) ? ($foodMenu->items->where('day','common')->where('meal','breakfast')->first()->meal_items ?? '') : '')}}</textarea></td>
                  <td><textarea class="form-control" name="menu[common][lunch]" >{{old('menu[common][lunch]') ?? (isset($foodMenu) ? ($foodMenu->items->where('day','common')->where('meal','lunch')->first()->meal_items ?? '') : '')}}</textarea></td>
                  <td><textarea class="form-control" name="menu[common][dinner]" >{{old('menu[common][dinner]') ?? (isset($foodMenu) ? ($foodMenu->items->where('day','common')->where('meal','dinner')->first()->meal_items ?? '') : '')}}</textarea></td>
              </tr>
          </tbody>
      </table>
  </div>
  <div class="text-white mb-2">Note: Use <b>Comma</b>(<b>,</b>) to seperate two food items. (Ex: KHEEMA, WHITE RICE, DAAL FRY)</div>
  <button type="submit" class="btn btn-success text_black">Save Menu</button>
</div>
