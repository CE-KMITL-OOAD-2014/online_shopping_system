@extends('template.managementStructure')
@section('productContent')
<link href="{{asset('js/jquery-ui.min.css')}}">
<link href="{{asset('js/jquery-ui.theme.min.css')}}">
<style>
#chart svg {
  height: 400px;
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
Date: <input type="text" id="first-datepicker">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Date: <input type="text" id="second-datepicker">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Sth: <select id="frequency">
  <option value="0">รายวัน</option>
  <option value="1">รายสัปดาห์</option>
  <option value="2">รายเดือน</option>
</select>
<button class="btn-small btn-success" onclick="drawGraph()">submit</button>
<div id="chart">
  <svg></svg>
</div>
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
    var responseData;
    var data;
    var chart;

    function setReponse(result){
      var responseData = jQuery.parseJSON(result);
      //data[0].values[0] = [responseData[0].x,responseData[0].y];
      //data[0].values[1] = [responseData[1].x,responseData[1].y];
      data[0].values = [];

      for(var i=0; i<responseData.length;i++){
        data[0].values[i] = [responseData[i].x,responseData[i].y]
      }
      var max = Math.max.apply(Math,responseData.map(function(o){return o.y;}));

      chart.forceY([0,max+1]);

      d3.select('#chart svg')
        .datum(data)
        .transition()
        .duration(0)
        .call(chart);
    }

    function drawGraph(){
      $.post('productSold', {from: $('#first-datepicker').val(), 
        to: $('#second-datepicker').val(), frequency: $('#frequency').find(":selected").val()} ,function (result){
        console.log('frequency');
        console.log($('#frequency').find(":selected").val());
        console.log(result);
        //console.log($('#first-datepicker').val());
        setReponse(result)
      });
    }

    nv.addGraph(function() {
      data = 
      [
        {
          "key" : "Quantity",
          "bar": true,
          "values" : []
        }
      ]
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
          //chart.forceY([0])

          //chart.y2Axis
          //    .tickFormat(function(d) { return '$' + d3.format(',f')(d) });

          //chart.bars.forceY([0]);

          /*d3.select('#chart svg')
            .datum(data)
            .transition()
            .duration(0)
            .call(chart);*/

          nv.utils.windowResize(chart.update);

          return chart;
      });
  </script>
@stop
