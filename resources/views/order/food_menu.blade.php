<h5>Package Menu Items When Ordered</h5>
<table class="table mb-3 table-dark table-borderless table-responsive-md">
  <colgroup>
    <col style="width: 10%;">
    <col style="width: 10%;">
    <col style="width: 10%;">
    <col style="width: 70%;">
  </colgroup>
  <tr>
    <th>Date</th>
    <th>Day</th>
    <th>Meal</th>
    <th>Meal Items</th>
  </tr>
  @foreach($order->food_order->items->where('day', '!=', 'common') as $item)
  <tr>
    <td>{{date('d/m/Y',strtotime($item->date))}}</td>
    <td>{{ucfirst($item->day)}}</td>
    <td>{{ucfirst($item->meal)}}</td>
    <td>{{ucfirst($item->meal_items)}}</td>
  </tr>
  @endforeach
</table>
<table class="table mb-3 table-dark table-borderless table-responsive-md">
  <colgroup>
    <col style="width: 10%;">
    <col style="width: 90%;">
  </colgroup>
  <tr>
    <th>Meal</th>
    <th>Common (Based on availability)</th>
  </tr>
  @foreach($order->food_order->items->where('day', 'common') as $item)
  <tr>
    <td>{{ucfirst($item->meal)}}</td>
    <td>{{ucfirst($item->meal_items)}}</td>
  </tr>
  @endforeach
</table>
