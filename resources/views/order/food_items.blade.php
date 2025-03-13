<h5>Ordered Package</h5>
<table class="table mb-3 table-dark table-borderless table-responsive-md">
  <colgroup>
    <col style="width: 20%;">
    <col style="width: 20%;">
    <col style="width: 15%;">
    <col style="width: 15%;">
    <col style="width: 10%;">
    <col style="width: 10%;">
    <col style="width: 10%;">
  </colgroup>
  <tr>
    <th>Package</th>
    <th>Meals Ordered</th>
    <th>Starts From</th>
    <th>Ends On</th>
    <th class="text-right">Price</th>
    <th class="text-right">Quantity</th>
    <th class="text-right">Total</th>
  </tr>
  <tr>
    <td>{{$order->food_order->package}}</td>
    <td> {{$order->food_order->meal}}
      @if($order->food_order->meal == 'All')
      (Breakfast, Lunch, Dinner)
      @else
      {{'('.implode(', ', array_map('ucfirst', explode('-', $order->food_order->meal_type))).')'}}
      @endif
    </td>
    <td>{{date('d/m/Y',strtotime($order->food_order->from))}}</td>
    <td>{{date('d/m/Y',strtotime($order->food_order->to))}}</td>
    <td class="text-right">{{$order->food_order->price}}</td>
    <td class="text-right">{{$order->food_order->quantity}}</td>
    <td class="text-right">{{$order->food_order->total}}</td>
  </tr>
  <tr style="border-top:1px solid gray">
    <td colspan=5></td>
    <td class="text-right"><b>Subtotal:</b></td>
    <td class="text-right"><b>{{$order->subtotal}}</b></td>
  </tr>
  <tr>
    <td colspan=5></td>
    <td class="text-right" style="border-top:1px solid gray"><b>Service Tax:</b></td>
    <td class="text-right" style="border-top:1px solid gray"><b>{{$order->tax}}</b></td>
  </tr>
  <tr>
    <td colspan=5></td>
    <td class="text-right" style="border-top:1px solid gray"><b>Grand Total:</b></td>
    <td class="text-right" style="border-top:1px solid gray"><b>{{$order->grand_total}}</b></td>
  </tr>
</table>