@extends('template.managementStructure')
@section('productContent')
<link href="{{asset('js/jquery-ui.min.css')}}">
<link href="{{asset('js/jquery-ui.theme.min.css')}}">
<style>
.chart {
  height: 400px;
  clear: both;
}

.ui-datepicker{  
  width:18%;  
  font-family:tahoma;  
  font-size:11px;  
  text-align:center;  
  background-color: white; 
}  

.ui-datepicker-calendar {
  width:100%;
}

.ui-datepicker-prev{
  padding-right:3%;
  font-size:1.5em;
}

.ui-datepicker-next{
  padding-right:3%;
  font-size:1.5em;
}
</style>
<div class ="col-md-8">
  <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Order Management</h3>
      </div>
      <div style = "text-align:center;" class="panel-body well">
          กรุณาเลือกช่วงเวลาที่ต้องการแสดง และ ความละเอียดในการแสเงด้านล่างหลังจากนั้น SUBMIT เพื่อประมวลผลกราฟ<br/>
     
      </div>
    </div>
</div>

<div style="clear:left;">

  Date: <input type="text" id="first-datepicker">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  Date: <input type="text" id="second-datepicker">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <select id="frequency ">
    <option value="0">รายวัน</option>
    <option value="1">รายสัปดาห์</option>
    <option value="2">รายเดือน</option>
  </select>
  <button class="btn btn-small btn-success" onclick="drawGraph()">submit</button>
  <div role="tabpanel" class ="panel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active" onclick="drawGraph()">
        <a href="#product-sold" role="tab" data-toggle="tab">Product Sold</a>
      </li>
      <li role="presentation" onclick="drawGraph()">
        <a href="#income" role="tab" data-toggle="tab">Income</a>
      </li>
      <li role="presentation" onclick="drawGraph()">
        <a href="#profit" role="tab" data-toggle="tab">Profit</a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content" id = "printdiv">

      <div role="tabpanel" class="tab-pane active" id="product-sold">
        <div id="product-sold-chart" class="chart">
          <svg></svg>
        </div>
      </div>

      <div role="tabpanel" class="tab-pane" id="income">
        <div id="income-chart" class="chart">
          <svg></svg>
        </div>
      </div>

      <div role="tabpanel" class="tab-pane" id="profit">
        <div id="profit-chart" class="chart">
          <svg></svg>
        </div>
      </div>

    </div>

  </div>
</div> <!-- clear left div -->
  @stop
  @section('script')
    @parent
    <script src="{{asset('js/d3.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/nv.d3.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script>
      $(function() {
        $( "#first-datepicker" ).datepicker();
      });

      $(function() {
        $( "#second-datepicker" ).datepicker();
      });
    </script>
    <script type="text/javascript" charset="utf-8">
      var data;
      var chart;


      function drawGraph(){
        $.post('productSold', {from: $('#first-datepicker').val(), 
          to: $('#second-datepicker').val(), frequency: $('#frequency').find(":selected").val()} ,function (result){
          setProductSoldData(result)
        });
      }

      function setProductSoldData(result){
        var responseDataJson = jQuery.parseJSON(result);
        data[0].values = [];

        for(var i=0; i<responseDataJson.length;i++){
          data[0].values[i] = [responseDataJson[i].x,responseDataJson[i].y]
        }
        var max = Math.max.apply(Math,responseDataJson.map(function(o){return o.y;}));

        chart.forceY([0,max+1]);

        drawProductSoldGraph();

        $.post('income', {from: $('#first-datepicker').val(), 
          to: $('#second-datepicker').val(), frequency: $('#frequency').find(":selected").val()}, function (incomeResult){
            setIncomeData(incomeResult);
        });
      }

      function drawProductSoldGraph(){
        d3.select('#product-sold-chart svg')
          .datum(data)
          .transition()
          .duration(0)
          .call(chart);
      }

      function setIncomeData(incomeResult){
        var responseDataJson = jQuery.parseJSON(incomeResult);
        incomeData[0].values = [];

        for(var i=0; i<responseDataJson.length; i++){
          incomeData[0].values[i] = [responseDataJson[i].x, responseDataJson[i].y];
        }
        var max = Math.max.apply(Math,responseDataJson.map(function(o){return o.y;}));
        chart.forceY([0,max+1]);

        drawIncomeGraph();

        $.post('profit', {from: $('#first-datepicker').val(), 
          to: $('#second-datepicker').val(), frequency: $('#frequency').find(":selected").val()}, function (profitResult){
            setProfitData(profitResult);
        });
      }

      function drawIncomeGraph(){
        d3.select('#income-chart svg')
        .datum(incomeData)
        .transition()
        .call(chart);
      }


    function setProfitData(profitResult){
      var responseDataJson = jQuery.parseJSON(profitResult);
      profitData[0].values = [];

      for(var i=0; i<responseDataJson.length; i++){
        profitData[0].values[i] = [responseDataJson[i].x, responseDataJson[i].y] ;
      }
      var max = Math.max.apply(Math, responseDataJson.map(function(o){return o.y;}));
      drawProfitGraph();
    }

    function drawProfitGraph(){
      d3.select('#profit-chart svg')
        .datum(profitData)
        .transition()
        .call(chart);
    }

    nv.addGraph(function() {
      data = 
      [
        {
          "key" : "Quantity",
          "bar": true,
          "values" : []
        }
      ];

      incomeData = 
      [
        {
          "key" : "income",
          "bar": true,
          "values" : []
        }
      ];


      profitData = 
      [
        {
          "key" : "profit",
          "bar": true,
          "values" : []
        }
      ];
          chart = nv.models.multiBarChart()
                .margin({top: 30, right: 60, bottom: 50, left: 70})
                //We can set x data accessor to use index. Reason? So the bars all appear evenly spaced.
                .x(function(d,i) { return i })
                .y(function(d,i) {return d[1] })
                ;

          chart.xAxis.tickFormat(function(d) {
            var dx = data[0].values[d] && data[0].values[d][0] || 0;
            return d3.time.format('%x')(new Date(dx))
          });

          chart.yAxis
              .tickFormat(d3.format('d'))

          nv.utils.windowResize(chart.update);

          return chart;
      });
     
  </script>
@stop
