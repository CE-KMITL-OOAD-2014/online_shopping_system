<?php

class ShopController extends \BaseController {

	public function __construct(){
		$this->productHelper = new \core\EloProductRepo(new \Product());
	}

	/**
	 * Display a listing of the resource.
	 * GET /shop
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = $this->productHelper->all();
		return View::make('shopHome', array('user' => core\User::newFromEloquent(Auth::user()),'products' => $products ));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /shop/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /shop
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /shop/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$product = $this->productHelper->find($id);
		return View::make('productDetail',array('product' => $product,'id' => $id));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /shop/{id}/edit
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
	 * PUT /shop/{id}
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
	 * DELETE /shop/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}