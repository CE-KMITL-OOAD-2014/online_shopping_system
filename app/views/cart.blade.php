@extends('template/shopStructure')
@section('shopContent')
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">สินค้าในตระกร้า</h3>
    </div>

    <div class="panel-body">
    <table class="table table-striped">
      <tr>
        <th>ชื่อสินค้า</th>
        <th>จำนวน</th>
        <th>ราคารวม</th>
      </tr>
      @foreach(json_decode(isset($_COOKIE['products'])?$_COOKIE['products']:'[]') as $product)
      <tr>
        <td>
          {{ $product->name }}
        </td>
        <td>
          {{ $product->amount }}
        </td>
        <td id="total-price">
          {{ $productRepo->find($product->id)->getPrice() * 
              $product->amount; }}
        </td>
      </tr>
      @endforeach
      </table>
      <a href="{{ url('buy')}}"><button class="btn btn-success">Buy</button></a>
    </div>
  </div>
@stop
