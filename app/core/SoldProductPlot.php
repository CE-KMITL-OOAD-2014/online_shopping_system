<?php
namespace core;
class SoldProductPlot implements Plotter
{
  protected $points;

  public function cal($time_unit, \DateTime $from, \DateTime $to)
  {
    $orderRepo = new EloOrderRepo(new \Order());   
    $orders = $orderRepo->whereBetween('order_time',
      $from->format('Y-m-d'), $to->format('Y-m-d'));
    //return $orders;
    $result = array();
    switch ($time_unit){
      case TimeUnit::Daily:
        foreach($orders as $order){
          if(sizeof($result)==0 || 
            (new \DateTime(preg_split('/\s+/',$order->order_time)[0]))->format('Y-m-d') != 
            $result[(sizeof($result))-1]->x)
          {
            $x = new \DateTime(preg_split('/\s+/',$order->order_time)[0]);
            $y = sizeof($order->products()->get());
            $p = new Point();
            $p->x = $x->format('Y-m-d');
            $p->y = $y;
            //$p->y = 0;
            array_push($result,$p);
          }
          else
          {
            $result[sizeof($result)-1]->y += sizeof($order->products());
          }
        }
        break;
    }
    return json_encode($result);
  }
}
