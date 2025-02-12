<h5>Ordered Food Items</h5>
<table class="table mb-3 table-dark table-borderless table-responsive-md">
  <colgroup>
    <col style="width: 20%;">
    <col style="width: 20%;">
    <col style="width: 20%;">
    <col style="width: 20%;">
    <col style="width: 20%;">
  </colgroup>
  <tr>
    <th>Category</th>
    <th>Service</th>
    <th class="text-right">Price/Piece</th>
    <th class="text-right">Quantity</th>
    <th class="text-right">Total</th>
  </tr>
  @foreach($order->food_items as $item)
  <tr style="border-top:1px solid gray">
    <td>{{$item->category_name}}</td>
    <td>{{$item->service_name}}</td>
    <td class="text-right">{{$item->price_per_piece}}</td>
    <td class="text-right">{{$item->quantity}}</td>
    <td class="text-right">{{$item->total_price}}</td>
  </tr>
  @endforeach
  <tr style="border-top:1px solid gray">
    <td colspan=3></td>
    <td class="text-right"><b>Subtotal:</b></td>
    <td class="text-right"><b>{{$order->subtotal}}</b></td>
  </tr>
  <tr>
    <td colspan=3></td>
    <td class="text-right" style="border-top:1px solid gray"><b>Service Tax:</b></td>
    <td class="text-right" style="border-top:1px solid gray"><b>{{$order->tax}}</b></td>
  </tr>
  <tr>
    <td colspan=3></td>
    <td class="text-right" style="border-top:1px solid gray"><b>Grand Total:</b></td>
    <td class="text-right" style="border-top:1px solid gray"><b>{{$order->grand_total}}</b></td>
  </tr>
</table>