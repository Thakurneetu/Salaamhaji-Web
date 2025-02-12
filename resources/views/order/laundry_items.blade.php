<h5>Ordered Laundry Services</h5>
@foreach($order->laundry_orders as $laundry_order)
  <table class="table mb-1 table-dark table-borderless table-responsive-md">
    <colgroup>
      <col style="width: 20%;">
      <col style="width: 20%;">
      <col style="width: 20%;">
      <col style="width: 20%;">
    </colgroup>
    <tr style="border-bottom:1px solid gray">
      <th class="align-middle">Service Date: {{date('d/m/Y', strtotime($laundry_order->service_date))}}</th>
      <th class="align-middle">Slot: {{date('H:i', strtotime($laundry_order->start))}}-{{date('H:i', strtotime($laundry_order->end))}}</th>
      <th class="text-right align-middle">Status:</th>
      <th>
        <select class="form-control" onchange="changeStatus({{$laundry_order->id}}, this.value, 'laundry')">
          <option value="Active" {{$laundry_order->status == 'Active' ? 'selected' : ''}}>Active</option>
          <option value="Confirmed" {{$laundry_order->status == 'Confirmed' ? 'selected' : ''}}>Confirmed</option>
          <option value="Out for delivery" {{$laundry_order->status == 'Out for delivery' ? 'selected' : ''}}>Out for delivery</option>
          <option value="Completed" {{$laundry_order->status == 'Completed' ? 'selected' : ''}}>Completed</option>
        </select>
      </th>
    </tr>
    <tr>
      <th>Item</th>
      <th class="text-right">Price/Piece</th>
      <th class="text-right">Quantity</th>
      <th class="text-right">Total</th>
    </tr>
    @foreach($laundry_order->items as $item)
      <tr>
        <td>{{$item->service_name}} ({{$laundry_order->category_name}})</td>
        <td class="text-right">{{$item->price_per_piece}}</td>
        <td class="text-right">{{$item->quantity}}</td>
        <td class="text-right">{{$item->total_price}}</td>
      </tr>
    @endforeach
  </table>
@endforeach
<table class="table mb-3 table-dark table-borderless table-responsive-md">
  <colgroup>
    <col style="width: 20%;">
    <col style="width: 20%;">
    <col style="width: 20%;">
    <col style="width: 20%;">
    <col style="width: 20%;">
  </colgroup>
  <tr>
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