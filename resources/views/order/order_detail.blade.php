<h5>Order Deatils</h5>
<table class="table table-borderless mb-3 table-dark table-responsive-md w-100">
  <colgroup>
    <col style="width: 30%;">
    <col style="width: 70%;">
  </colgroup>
  <tr>
    <th>Order ID:</th>
    <td>{{$order->uuid}}</td>
  </tr>
  <tr>
    <th>Order Date:</th>
    <td>{{date('d/m/Y',strtotime($order->created_at))}}</td>
  </tr>
  <tr>
    <th>Area:</th>
    <td>{{$order->area_id != '' ? $order->area->name : '-'}}</td>
  </tr>
  @if($order->type != 'cab')
  <tr>
    <th>Address Line One:</th>
    <td>{{$order->address_line_1}}</td>
  </tr>
  <tr>
    <th>Address Line Two:</th>
    <td>{{$order->address_line_2}}</td>
  </tr>
  <tr>
    <th>Landmark:</th>
    <td>{{$order->landmark}}</td>
  </tr>
  @endif
  @if(in_array($order->type,['cab','laundry']))
  <tr>
    <th>Service Date:</th>
    <td>{{date('d/m/Y',strtotime($order->service_date))}}</td>
  </tr>
    @if($order->type =='cab')
    <tr>
      <th>Pickup Time:</th>
      <td>{{date('h:i A',strtotime($order->start))}}</td>
    </tr>
    @else
    <tr>
      <th>Time Slot:</th>
      <td>{{date('H:i',strtotime($order->start))}} - {{date('H:i',strtotime($order->end))}}</td>
    </tr>
    @endif
  @endif
  <tr>
    <th>Order Status:</th>
    <td>
      <select class="form-control" style="width:300px;" onchange="changeStatus({{$order->id}}, this.value, 'food')">
        <option value="Order accepted" {{$order->status == 'Order accepted' ? 'selected' : ''}}>Order accepted</option>
        <option value="Order assigned to vendor" {{$order->status == 'Order assigned to vendor' ? 'selected' : ''}}>Order assigned to vendor</option>
        <option value="Order in progress" {{$order->status == 'Order in progress' ? 'selected' : ''}}>Order in progress</option>
        <option value="Order completed" {{$order->status == 'Order completed' ? 'selected' : ''}}>Order completed</option>
        <option value="Order cancelled" {{$order->status == 'Order cancelled' ? 'selected' : ''}}>Order cancelled</option>
      </select>
    </td>
  </tr>
  @if($order->type == 'cab')
  <tr>
    <th>CAB Type:</th>
    <td>{{$order->cab_order->cab_type}} - {{$order->cab_order->seats}} @if($order->cab_order->luggage) - {{$order->cab_order->luggage}}@endif</td>
  </tr>
  <tr>
    <th>Instruction:</th>
    <td>{{$order->cab_order->instruction}}</td>
  </tr>
  @endif
</table>