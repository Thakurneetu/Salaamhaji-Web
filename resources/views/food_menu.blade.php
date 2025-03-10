
<div class="card-body">
  <div class="form-group">
      <h4>Hotel Package</h4>
      <input type="text" class="form-control" id="hotel_name" name="hotel_name" required>
  </div>
  <div class="form-group">
      <h4>Pricing</h4>
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th>All</th>
                  <th>Combo</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td><input type="text" class="form-control" name="menu[][breakfast]" required></td>
                  <td><input type="text" class="form-control" name="menu[][breakfast-lunch]" required></td>
              </tr>
          </tbody>
      </table>
  </div>
  <div class="form-group">
      <label for="week_menu">Weekly Menu</label>
      <table class="table table-bordered">
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
                  <td><textarea class="form-control" name="menu[{{ strtolower($day) }}][breakfast]" required></textarea></td>
                  <td><textarea class="form-control" name="menu[{{ strtolower($day) }}][lunch]" required></textarea></td>
                  <td><textarea class="form-control" name="menu[{{ strtolower($day) }}][dinner]" required></textarea></td>
              </tr>
              @endforeach
              <tr>
                  <td>Common <br> (Based on <br> availability) </td>
                  <td><textarea class="form-control" name="menu[{{ strtolower($day) }}][breakfast]" required></textarea></td>
                  <td><textarea class="form-control" name="menu[{{ strtolower($day) }}][lunch]" required></textarea></td>
                  <td><textarea class="form-control" name="menu[{{ strtolower($day) }}][dinner]" required></textarea></td>
              </tr>
          </tbody>
      </table>
  </div>
  <div class="text-white mb-2">Note: Use ( | ) to seperate two food items. (Ex: KHEEMA | WHITE RICE | DAAL FRY)</div>
  <hr class="border-white">

  <button type="submit" class="btn btn-success text_black">Save Menu</button>
</div>
