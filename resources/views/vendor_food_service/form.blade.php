
<div class="card-body">
  <div class="form-group">
      <h4>Hotel Package</h4>
      <input type="text" class="form-control" name="package" value="{{old('package') ?? (@$vendorFoodService->package ?? '')}}" required>
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
                  <td><input type="text" class="form-control" name="all_price" value="{{old('all_price') ?? (@$vendorFoodService->all_price ?? '')}}" required></td>
                  <td><input type="text" class="form-control" name="combo_price" value="{{old('combo_price') ?? (@$vendorFoodService->combo_price ?? '')}}" required></td>
              </tr>
          </tbody>
      </table>
  </div>
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
                  <td><input type="text" class="form-control timepicker" name="breakfast_start" value="{{old('breakfast_start') ?? ((isset($vendorFoodService) AND $vendorFoodService->breakfast_start) ? date('H:i', strtotime($vendorFoodService->breakfast_start)) : '')}}" required></td>
                  <td><input type="text" class="form-control timepicker" name="breakfast_end" value="{{old('breakfast_end') ?? ((isset($vendorFoodService) AND $vendorFoodService->breakfast_end) ? date('H:i', strtotime($vendorFoodService->breakfast_end)) : '')}}" required></td>
              </tr>
              <tr>
                  <td>Lunch</td>
                  <td><input type="text" class="form-control timepicker" name="lunch_start" value="{{old('lunch_start') ?? ((isset($vendorFoodService) AND $vendorFoodService->lunch_start) ? date('H:i', strtotime($vendorFoodService->lunch_start)) : '')}}" required></td>
                  <td><input type="text" class="form-control timepicker" name="lunch_end" value="{{old('lunch_end') ?? ((isset($vendorFoodService) AND $vendorFoodService->lunch_end) ? date('H:i', strtotime($vendorFoodService->lunch_end)) : '')}}" required></td>
              </tr>
              <tr>
                  <td>Dinner</td>
                  <td><input type="text" class="form-control timepicker" name="dinner_start" value="{{old('dinner_start') ?? ((isset($vendorFoodService) AND $vendorFoodService->dinner_start) ? date('H:i', strtotime($vendorFoodService->dinner_start)) : '')}}" required></td>
                  <td><input type="text" class="form-control timepicker" name="dinner_end" value="{{old('dinner_end') ?? ((isset($vendorFoodService) AND $vendorFoodService->dinner_end) ? date('H:i', strtotime($vendorFoodService->dinner_end)) : '')}}" required></td>
              </tr>
          </tbody>
      </table>
  </div>
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
                  <td><textarea class="form-control" name="menu[{{ strtolower($day) }}][breakfast]">{{old('menu[strtolower($day)][breakfast]') ?? (isset($vendorFoodService) ? ($vendorFoodService->items->where('day',strtolower($day))->where('meal','breakfast')->first()->meal_items ?? '') : '')}}</textarea></td>
                  <td><textarea class="form-control" name="menu[{{ strtolower($day) }}][lunch]">{{old('menu[strtolower($day)][lunch]') ?? (isset($vendorFoodService) ? ($vendorFoodService->items->where('day',strtolower($day))->where('meal','lunch')->first()->meal_items ?? '') : '')}}</textarea></td>
                  <td><textarea class="form-control" name="menu[{{ strtolower($day) }}][dinner]">{{old('menu[strtolower($day)][dinner]') ?? (isset($vendorFoodService) ? ($vendorFoodService->items->where('day',strtolower($day))->where('meal','dinner')->first()->meal_items ?? '') : '')}}</textarea></td>
              </tr>
              @endforeach
              <tr>
                  <td>Common <br> (Based on <br> availability) </td>
                  <td><textarea class="form-control" name="menu[common][breakfast]">{{old('menu[common][breakfast]') ?? (isset($vendorFoodService) ? ($vendorFoodService->items->where('day','common')->where('meal','breakfast')->first()->meal_items ?? '') : '')}}</textarea></td>
                  <td><textarea class="form-control" name="menu[common][lunch]" >{{old('menu[common][lunch]') ?? (isset($vendorFoodService) ? ($vendorFoodService->items->where('day','common')->where('meal','lunch')->first()->meal_items ?? '') : '')}}</textarea></td>
                  <td><textarea class="form-control" name="menu[common][dinner]" >{{old('menu[common][dinner]') ?? (isset($vendorFoodService) ? ($vendorFoodService->items->where('day','common')->where('meal','dinner')->first()->meal_items ?? '') : '')}}</textarea></td>
              </tr>
          </tbody>
      </table>
  </div>
  <div class="text-white mb-2">Note: Use <b>Comma</b>(<b>,</b>) to seperate two food items. (Ex: KHEEMA, WHITE RICE, DAAL FRY)</div>
  <button type="submit" class="btn btn-success text_black">Save Menu</button>
</div>
