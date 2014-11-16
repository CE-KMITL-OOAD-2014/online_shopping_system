<?php

class OrderController extends \BaseController {

  protected $orderHelper;
  protected $userHelper;

  public function __construct()
  {
    $this->orderHelper = new \core\EloOrderRepo(new \Order());
    $this->userHelper = new \core\EloUserRepo(new \User());
  }

  /**
   * Display a listing of the resource.
   * GET /order
   *
   * @return Response
   */
  public function index()
  {
    if(Auth::user()->username == "admin"){
      $orders = $this->orderHelper->all();
      return View::make('orderList', array('orders' => $orders ,'user' => core\User::newFromEloquent(Auth::user())));
    }
    return View::make('permissionDenied');
  }

  /**
   * Show the form for creating a new resource.
   * GET /order/create
   *
   * @return Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   * POST /order
   *
   * @return Response
   */
  public function store()
  {
    //
  }

  /**
   * Display the specified resource.
   * GET /order/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   * GET /order/{id}/edit
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   * POST /order/{id}/update
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    if(Request::ajax()) {
      $update_order = Order::find($id);
      $update_order->ems = Input::get('ems');
      $update_order->save();
    }else{
      return "You don't have permission";
    }	
  }

  /**
   * Remove the specified resource from storage.
   * DELETE /order/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $del_product = Order::find($id);
    $del_product->products()->detach();
    $del_product->delete();
    return Redirect::to('order');
  }

  public function status($id) {
    if(Request::ajax()) {

      $order = Order::find($id);
      $order->status = Input::get('status');
      $order->save();

    }else{
      return "You don't have permission";
    }
  }
}
