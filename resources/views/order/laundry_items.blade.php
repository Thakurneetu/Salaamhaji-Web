<h5>Ordered Laundry Services</h5>
  <table class="table table-dark table-borderless table-responsive-md">
    <colgroup>
      <col style="width: 20%;">
      <col style="width: 20%;">
      <col style="width: 20%;">
      <col style="width: 20%;">
    </colgroup>
    <tr>
      <th scope="col">Item</th>
      <th scope="col" class="text-right">Price/Piece</th>
      <th scope="col" class="text-right">Quantity</th>
      <th scope="col" class="text-right">Total</th>
    </tr>
    @foreach($order->laundry_orders as $laundry_order)
    <tr colspan="4">
      <th scope="col"><u>Category: {{$laundry_order->category_name}}</u></th>
    </tr>
    @foreach($laundry_order->items as $item)
      <tr style="border-bottom:1px solid gray">
        <td>{{$item->service_name}}</td>
        <td class="text-right">{{$item->price_per_piece}}</td>
        <td class="text-right">{{$item->quantity}}</td>
        <td class="text-right">{{$item->total_price}}</td>
      </tr>
    @endforeach
    @endforeach
  </table>
<table class="table mb-3 table-dark table-borderless table-responsive-md" role="presentation">
  <colgroup>
    <col style="width: 20%;">
    <col style="width: 20%;">
    <col style="width: 20%;">
    <col style="width: 20%;">
    <col style="width: 20%;">
  </colgroup>
  <tr>
    <td colspan="3"></td>
    <td class="text-right"><b>Subtotal:</b></td>
    <td class="text-right"><b>{{$order->subtotal}}</b></td>
  </tr>
  <tr>
    <td colspan="3"></td>
    <td class="text-right" style="border-top:1px solid gray"><b>Service Tax:</b></td>
    <td class="text-right" style="border-top:1px solid gray"><b>{{$order->tax}}</b></td>
  </tr>
  <tr>
    <td colspan="3"></td>
    <td class="text-right" style="border-top:1px solid gray"><b>Grand Total:</b></td>
    <td class="text-right" style="border-top:1px solid gray"><b>{{$order->grand_total}}</b></td>
  </tr>
</table>