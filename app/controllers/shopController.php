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
	 * ContactUs Page
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function contactUs()
	{
		return View::make('contactUs');
	}

	/**
	 * Customer Order List
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function orderShow()
	{
		return View::make('orderShow');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /shop/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function shopChat()
	{
		if(null !== core\User::newFromEloquent(Auth::user())) {
			return View::make('chatPage',array( 'user' => core\User::newFromEloquent(Auth::user()), 'user_all' => User::all() ));
		}else {
			return View::make('shopHome');
		}
	}

}