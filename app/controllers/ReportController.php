<?php

class ReportController extends BaseController {
  public function index()
  {
    return View::make('report');
  }

  public function soldProduct()
  {
    $report = new \core\Report();
    $report->setPlotter(new \core\SoldProductPlot());
    //var_dump($report->report( new DateTime('2014-11-06'), new DateTime('2014-11-08')));
    //return sizeof($report->report( new DateTime('2014-11-06'), new DateTime('2014-11-08')));
    return $report->report( new DateTime('2014-11-06'), new DateTime('2014-11-08'));
  }
}
