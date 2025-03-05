<h5>CAB Booking Details</h5>
<table class="table mb-3 table-dark table-borderless table-responsive-md">
  @if($order->cab_order->tour_type == 'local')
  <colgroup>
    <col style="width: 20%;">
    <col style="width: 16%;">
    <col style="width: 16%;">
    <col style="width: 16%;">
    <col style="width: 16%;">
    <col style="width: 16%;">
  </colgroup>
  <tr>
    <th>Booking Type</th>
    <th>Pickup Location</th>
    <th>Tour Location</th>
    <th class="text-right">Hours</th>
    <th class="text-right">Fare/Hour</th>
    <th class="text-right">Total Fare</th>
  </tr>
  <tr style="border-top:1px solid gray">
    <td>{{ucfirst($order->cab_order->tour_type)}} Tour</td>
    <td>{{$order->cab_order->pickup_location}}</td>
    <td>{{$order->cab_order->origin}}</td>
    <td class="text-right">{{$order->cab_order->hours}}</td>
    <td class="text-right">{{$order->cab_order->price}}</td>
    <td class="text-right">{{$order->subtotal}}</td>
  </tr>
  <tr style="border-top:1px solid gray">
    <td colspan=4></td>
    <td class="text-right"><b>Subtotal:</b></td>
    <td class="text-right"><b>{{$order->subtotal}}</b></td>
  </tr>
  <tr>
    <td colspan=4></td>
    <td class="text-right" style="border-top:1px solid gray"><b>Service Tax:</b></td>
    <td class="text-right" style="border-top:1px solid gray"><b>{{$order->tax}}</b></td>
  </tr>
  <tr>
    <td colspan=4></td>
    <td class="text-right" style="border-top:1px solid gray"><b>Grand Total:</b></td>
    <td class="text-right" style="border-top:1px solid gray"><b>{{$order->grand_total}}</b></td>
  </tr>
  @else
  <colgroup>
    <col style="width: 25%;">
    <col style="width: 25%;">
    <col style="width: 25%;">
    <col style="width: 25%;">
  </colgroup>
  <tr>
    <th>Booking Type</th>
    <th>Origin</th>
    <th>Destination</th>
    <th class="text-right">Total Fare</th>
  </tr>
  <tr style="border-top:1px solid gray">
    <td>{{ucfirst($order->cab_order->tour_type)}} Tour</td>
    <td>{{$order->cab_order->origin}}</td>
    <td>{{$order->cab_order->destination}}</td>
    <td class="text-right">{{$order->cab_order->price}}</td>
  </tr>
  <tr style="border-top:1px solid gray">
    <td colspan=2></td>
    <td class="text-right"><b>Subtotal:</b></td>
    <td class="text-right"><b>{{$order->subtotal}}</b></td>
  </tr>
  <tr>
    <td colspan=2></td>
    <td class="text-right" style="border-top:1px solid gray"><b>Service Tax:</b></td>
    <td class="text-right" style="border-top:1px solid gray"><b>{{$order->tax}}</b></td>
  </tr>
  <tr>
    <td colspan=2></td>
    <td class="text-right" style="border-top:1px solid gray"><b>Grand Total:</b></td>
    <td class="text-right" style="border-top:1px solid gray"><b>{{$order->grand_total}}</b></td>
  </tr>
  @endif
</table>