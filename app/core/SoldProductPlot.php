<?php
namespace core;
class SoldProductPlot implements Plotter
{
  protected $points;

  public function cal(\DateTime $from, \DateTime $to, $time_unit)
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
            array_push($result,$p);
          }
          else
          {
            $y = sizeof($order->products()->get());
            $result[sizeof($result)-1]->y = $result[sizeof($result)-1]->y + $y;
          }
        }
        break;
      case TimeUnit::Weekly:
        foreach($orders as $order){
          $d1 = strtotime(preg_split('/\s+/',$order->order_time)[0]);
          if(sizeof($result)!=0){ 
            $d2 = strtotime($result[(sizeof($result))-1]->x);
            $diff = $d1 - $d2;
            $daysdiff = floor($diff/(60*60*24));
          }
          $p = new Point();
          $x = new \DateTime(preg_split('/\s+/',$order->order_time)[0]);
          $p->x ;
          if(sizeof($result)==0 || $daysdiff > 30)
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
            $y = sizeof($order->products()->get());
            $result[sizeof($result)-1]->y = $result[sizeof($result)-1]->y + $y;
          }
        }
        break;
        
    }
    //return json_encode(sizeof($result));
    return json_encode($result);
  }
}
