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

    $from = Input::get('from');
    $to = Input::get('to');
    $frequency = Input::get('frequency');
    return $report->report( new DateTime(explode('/', $from)[2].'-'.explode('/', $from)[0].'-'.explode('/', $from)[1])
      , (new DateTime(explode('/', $to)[2].'-'.explode('/', $to)[0].'-'.explode('/', $to)[1])), $frequency);
  }
}
