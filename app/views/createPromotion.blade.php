@extends('template.managementStructure')
@section('productContent')
  <div class = "col-md-4">
    <div class="panel panel-warning">
      <div class="panel-heading">
        <h3 class="panel-title">Product Details</h3>
      </div>
      <div class="panel-body">
          <table class = "table  table-striped table-hover" >
          <tr>
            <td>name</td>
            <td>{{ $product->getProductName() }} </td>
          </tr>
          <tr>
            <td>price</td>
            <td>{{ $product->getPrice() }} </td>
          </tr>
          <tr>
            <td>category</td>
            <td>{{ $product->getCategory() }}</td>
          </tr>
          <tr>
            <td>description</td>
            <td>{{ $product->getDescription() }}</td>
          </tr>
          <tr>
            <td>size</td>
            <td>{{ $product->getSize() }}</td>
          </tr>
          <tr>
            <td>color</td>
            <td>{{ $product->getColor() }}</td>
          </tr>
          <tr>
            <td>Suplier</td>
            <td>{{ $product->getSuplier() }}</td>
          </tr>
          <tr>
            <td>Amount</td>
            <td>{{ $product->getAmount() }}</td>
          </tr>
        </table>
       </div>
    </div>
  </div>
  <div class = "col-md-4">
    <div class="panel panel-warning">
      <div class="panel-heading">
        <h3 class="panel-title">Promotion</h3>
      </div>
      <div class="panel-body">
          กรุณาระบุชนิดของโปรโมชั่น และ ข้อมูลของการทำโปรโมชั่นลงในฟอร์มด้านล่าง 
              <ul class="nav nav-tabs">
                @foreach ($types as $type)
                  <li class=""><a href="#{{ $type }}" data-toggle="tab" aria-expanded="false">{{ $type }}</a></li>
                @endforeach
              </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="discount">
                  {{ Form::open(array('url' => 'product/'.$id.'/promotion' , 'class' => 'form-horizontal' )) }}
                  <fieldset>
                      <input type = "hidden" name = "typeAdapter" value = "PromotionDiscount"> 
                      <div class="form-group">
                        <label for="percent" class="col-lg-3 control-label">ลดไป</label>
                        <div class="col-lg-8">
                          <input type="number" class="form-control" name = "percent" id="percent" placeholder="percent"> 
                        </div>
                      </div>
                      <h6> จะลดเหลือ <span class="label label-warning" id = "total" ></span> บาท</h6>
                  {{ Form::submit('ยืนยัน',array('class' => 'btn btn-success')) }}
                  <a href = "{{ URL::to('product') }}" class = "btn btn-primary">กลับ</a>
                </fieldset>
                {{ Form::close() }}
              </div>
              <div class="tab-pane fade" id="buyXfreeY">
              {{ Form::open(array('url' => 'product/'.$id.'/promotion' , 'class' => 'form-horizontal' )) }}
                  <fieldset>
                  <input type = "hidden" name = "typeAdapter" value = "PromotionBuyXFreeY">
                      <div class="form-group">
                        <label for="percent" class="col-lg-3 control-label">ซื้อ</label>
                        <div class="col-lg-8">
                          <input type="number" class="form-control" id="percent" placeholder="ex. 2" name = "buy"> 
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="percent" class="col-lg-3 control-label">แถม</label>
                        <div class="col-lg-8">
                          <input type="number" class="form-control" id="percent" placeholder="ex. 1" name = "free"> 
                        </div>
                      </div>
                      {{ Form::submit('ยืนยัน',array('class' => 'btn btn-success')) }}
                  <a href = "{{ URL::to('product') }}" class = "btn btn-primary">กลับ</a>
                  </fieldset>
              {{ Form::close() }}
              </div>
            </div>

      </div>
    </div>
  </div>

  <script type="text/javascript" >
   $(document).ready(function () {
      var ans = 0;
     $('#percent').on('input',function() {
        console.log("in in in ");
        ans =  parseInt("{{ $product->getPrice() }}") * (100 - $('#percent').val())/100
        $('#total').html(ans);
      });
    });
  </script>
@stop 