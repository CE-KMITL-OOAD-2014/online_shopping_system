<?php
namespace core;

class Report{
  protected  $time_unit;
  protected  $plotter;

  public function report(\DateTime $from, \DateTime $to)
  {
    $time_unit = TimeUnit::Daily;
    return $this->plotter->cal($time_unit, $from, $to);
  }

  public function setPlotter(Plotter $plotter)
  {
    $this->plotter = $plotter;
  }

  public function setTimeUnit(TimeUnit $time_unit)
  {
    $this->time_unit = $time_unit;
  }
}
