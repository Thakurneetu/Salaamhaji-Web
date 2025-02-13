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
  <tr>
    <th>Service Date:</th>
    <td>{{date('d/m/Y',strtotime($order->service_date))}}</td>
  </tr>
  <tr>
    <th>Time Slot:</th>
    <td>{{date('H:i',strtotime($order->start))}} - {{date('H:i',strtotime($order->end))}}</td>
  </tr>
  <tr>
    <th>Order Status:</th>
    <td>
      <select class="form-control" style="width:200px;" onchange="changeStatus({{$order->id}}, this.value, 'food')">
        <option value="Active" {{$order->status == 'Active' ? 'selected' : ''}}>Active</option>
        <option value="Confirmed" {{$order->status == 'Confirmed' ? 'selected' : ''}}>Confirmed</option>
        <option value="Out for delivery" {{$order->status == 'Out for delivery' ? 'selected' : ''}}>Out for delivery</option>
        <option value="Completed" {{$order->status == 'Completed' ? 'selected' : ''}}>Completed</option>
      </select>
    </td>
  </tr>
</table>