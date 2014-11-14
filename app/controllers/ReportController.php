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
    //var_dump($report->report( new DateTime('2014-11-01'), new DateTime('2014-11-08')));
    //return $report->report( new DateTime('2014-10-08'), new DateTime('2014-11-08'), 2);
    $from = Input::get('from');
    $to = Input::get('to');
    $frequency = Input::get('frequency');
    return $report->report( new DateTime(explode('/', $from)[2].'-'.explode('/', $from)[0].'-'.explode('/', $from)[1])
      , (new DateTime(explode('/', $to)[2].'-'.explode('/', $to)[0].'-'.explode('/', $to)[1])), $frequency);
  }

  public function income()
  {
    $report = new \core\Report();
    $report->setPlotter(new \core\IncomePlot());
    //return $report->report( new DateTime('2014-11-01'), new DateTime('2014-11-08'), 0);

    $from = Input::get('from');
    $to = Input::get('to');
    $frequency = Input::get('frequency');
    return $report->report( new DateTime(explode('/', $from)[2].'-'.explode('/', $from)[0].'-'.explode('/', $from)[1])
      , (new DateTime(explode('/', $to)[2].'-'.explode('/', $to)[0].'-'.explode('/', $to)[1])), $frequency);
  }

  public function profit()
  {
    $report = new \core\Report();
    $report->setPlotter(new \core\ProfitPlot());
    return $report->report( new DateTime('2014-11-01'), new DateTime('2014-11-08'), 0);

    $from = Input::get('from');
    $to = Input::get('to');
    $frequency = Input::get('frequency');
    return $report->report( new DateTime(explode('/', $from)[2].'-'.explode('/', $from)[0].'-'.explode('/', $from)[1])
      , (new DateTime(explode('/', $to)[2].'-'.explode('/', $to)[0].'-'.explode('/', $to)[1])), $frequency);
  }
}
