<?php

class OrderController extends \BaseController {

	protected $orderHelper;
	protected $userHelper;

	public function __construct() {
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
		$orders = $this->orderHelper->all();
		return View::make('orderList', array('orders' => $orders ));
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
	 * PUT /order/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
		//
	}

}