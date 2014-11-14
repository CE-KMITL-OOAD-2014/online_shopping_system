<?php
namespace core;

class Report{
  protected  $time_unit;
  protected  $plotter;

  public function report(\DateTime $from, \DateTime $to, $time_unit)
  {
    $this->time_unit = $time_unit;
    return $this->plotter->cal($from, $to, $this->time_unit);
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
