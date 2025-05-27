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
  <div class="order-summary table-dark text-white mb-3 rounded">
    <div class="d-flex justify-content-between align-items-center">
      <div class="col-12 col-md-4 offset-md-8 d-flex justify-content-between py-2">
        <strong>Subtotal:</strong>
        <strong>{{ $order->subtotal }}</strong>
      </div>
    </div>
    <div class="d-flex justify-content-between align-items-center">
      <div class="col-12 col-md-4 offset-md-8 d-flex justify-content-between border-top border-gray py-2">
        <strong>Service Tax:</strong>
        <strong>{{ $order->tax }}</strong>
      </div>
    </div>
    <div class="d-flex justify-content-between align-items-center">
      <div class="col-12 col-md-4 offset-md-8 d-flex justify-content-between border-top border-gray py-2">
        <strong>Grand Total:</strong>
        <strong>{{ $order->grand_total }}</strong>
      </div>
    </div>
  </div>

