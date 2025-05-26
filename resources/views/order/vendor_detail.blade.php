<h5>Assigned Vendor Details</h5>
<form action="{{route('order.update', $order->id)}}" method="post">
  @csrf @method('put')
  <table class="table table-borderless mb-3 table-dark table-responsive-md">
    <colgroup>
      <col style="width: 30%;">
      <col style="width: 70%;">
    </colgroup>
    <tr>
      <th scope="col">Vendor Name:</th>
      <td>
        <input type="text" name="vendor_name" class="form-control" value="{{$order->vendor_name}}">
      </td>
    </tr>
    <tr>
      <th scope="col">Vendor Phone:</th>
      <td>
        <input type="text" name="vendor_phone" class="form-control" value="{{$order->vendor_phone}}">
      </td>
    </tr>
    <tr>
      <th scope="col">Vendor Address:</th>
      <td>
        <input type="text" name="vendor_address" class="form-control" value="{{$order->vendor_address}}">
      </td>
    </tr>
    <tr>
      <th scope="col">Delivery Date & Time:</th>
      <td>
      <input type="text" class="form-control timepicker" name="delivered_at" value="{{$order->delivered_at != '' ? date('Y-m-d H:i', strtotime($order->delivered_at)) : ''}}">
      </td>
    </tr>
    <tr>
      <td colspan="2" class="text-center"><button class="btn btn-light">Save</button></td>
    </tr>
  </table>
</form>
