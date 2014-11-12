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
  <script type="text/javascript" charset="utf-8">
    nv.addGraph(function() {
  var chart = nv.models.lineChart()
                .margin({left: 100})  //Adjust chart margins to give the x-axis some breathing room.
                .useInteractiveGuideline(true)  //We want nice looking tooltips and a guideline!
                .transitionDuration(350)  //how fast do you want the lines to transition?
                .showLegend(true)       //Show the legend, allowing users to turn on/off line series.
                .showYAxis(true)        //Show the y-axis
                .showXAxis(true)        //Show the x-axis
  ;

  chart.xAxis     //Chart x-axis settings
      .axisLabel('วันที่')
      .tickFormat(function(d) { return d3.time.format('%Y-%m-%d')(new Date(d)); });

//var minDate = "2014-11-06",
    //maxDate = "2014-11-07";

  //chart.xScale(d3.time.scale().domain([minDate, maxDate]).range([0, 450]));
  //chart.xScale(d3.time.scale());

  chart.yAxis     //Chart y-axis settings
      .axisLabel('จำนวนสินค้า')
      .tickFormat(d3.format('d'));

  /* Done setting the chart up? Time to render it!*/
  var myData = sinAndCos();   //You need data...

  d3.select('#chart svg')    //Select the <svg> element you want to render the chart in.   
      .datum(myData)         //Populate the <svg> element with chart data...
      .call(chart);          //Finally, render the chart!

  //Update the chart when window resizes.
  nv.utils.windowResize(function() { chart.update() });
  return chart;
});
/**************************************
 * Simple test data generator
 */
function sinAndCos() {
  var sin = [],sin2 = [],
      cos = [];

  //Data is represented as an array of {x,y} pairs.
  /*for (var i = 0; i < 100; i++) {
    sin.push({x: i, y: Math.sin(i/10)});
    sin2.push({x: i, y: Math.sin(i/10) *0.25 + 0.5});
    cos.push({x: i, y: .5 * Math.cos(i/10)});
  }*/

  //Line chart data should be sent as an array of series objects.
  return [
    {
      values: [{x:new Date(),y:15},{x: new Date(2014, 11, 14)  ,y:1}],      //values - represents the array of {x,y} data points
      key: 'Sine Wave', //key  - the name of the series.
      color: '#ff7f0e'  //color - optional: choose your own line color.
    }
  ];
}
  </script>
@stop
