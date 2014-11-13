@extends('template.managementStructure')
@section('productContent')
<style>
#chart svg {
  height: 400px;
}
</style>
<div class="col-md-8" id="chart">
  <svg></svg>
</div>
@stop
@section('script')
  @parent
  <script src="{{asset('js/d3.min.js')}}" charset="utf-8"></script>
  <script src="{{asset('js/nv.d3.min.js')}}" charset="utf-8"></script>
  <script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
  <script type="text/javascript" charset="utf-8">
    var responseData;
    var data;
    var chart;

    function setReponse(result){
      console.log("test");
      var responseData = jQuery.parseJSON(result);
      //data[0].values[0] = [responseData[0].x,responseData[0].y];
      //data[0].values[1] = [responseData[1].x,responseData[1].y];

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

    nv.addGraph(function() {
      $.get('productSold' ,function (result){
        setReponse(result)
      });
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
              .tickFormat(d3.format(',f'))
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
