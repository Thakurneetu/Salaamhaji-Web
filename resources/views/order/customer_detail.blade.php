<h5>Customer Deatils</h5>
<table class="table table-borderless mb-3 table-dark table-responsive-md">
  <colgroup>
    <col style="width: 30%;">
    <col style="width: 70%;">
  </colgroup>
  <tr>
    <th>Name:</th>
    <td>{{$order->customer->name}}</td>
  </tr>
  <tr>
    <th>Email:</th>
    <td>{{$order->customer->email}}</td>
  </tr>
  <tr>
    <th>Phone:</th>
    <td>{{$order->customer->phone}}</td>
  </tr>
  <tr>
    <th>Gender:</th>
    <td>{{$order->customer->gender}}</td>
  </tr>
</table>
