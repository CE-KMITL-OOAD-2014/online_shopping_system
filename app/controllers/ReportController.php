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
    return $report->report( new DateTime($this->formatDate($from))
      , (new DateTime($this->formatDate($to))), $frequency);
  }

  public function income()
  {
    $report = new \core\Report();
    $report->setPlotter(new \core\IncomePlot());

    $from = Input::get('from');
    $to = Input::get('to');
    $frequency = Input::get('frequency');
    return $report->report( new DateTime($this->formatDate($from))
      , new DateTime($this->formatDate($to)), $frequency);
  }

  public function profit()
  {
    $report = new \core\Report();
    $report->setPlotter(new \core\ProfitPlot());

    $from = Input::get('from');
    $to = Input::get('to');
    $frequency = Input::get('frequency');
    return $report->report( new DateTime($this->formatDate($from))
      , new DateTime($to), $frequency);
  }

  private function formatDate($dateString)
  {
    return explode('/', $dateString)[2].'-'.explode('/', $dateString)[0].'-'.explode('/', $dateString)[1];
  }
}
