<?php
namespace core;

interface Plotter 
{
  public function cal(\DateTime $from, \DateTime $to, $time_unit);
}
