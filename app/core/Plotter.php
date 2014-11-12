<?php
namespace core;

interface Plotter 
{
  public function cal($timeunit, \DateTime $from, \DateTime $to);
}
