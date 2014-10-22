<?php

class ProductController extends \BaseController {

	protected $productHelper;

	public function __construct(){
		$this->productHelper = new \core\EloProductRepo(new \Product());
	}
	/**
	 * Display a listing of the resource.
	 * GET /product
	 *
	 * @return Response
	 */
	public function index()
	{	
		$products = $this->productHelper->all();
		return View::make('productView', array('products' =>  $products ));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /product/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$products = $this->productHelper->all();
		return View::make('productView', array('products' =>  $products ));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /product
	 *
	 * @return Response
	 */
	public function store()
	{
		$formInfo = Input::all();

		$product = new \core\Product();
		$product->setPrice($formInfo['price']);
		$product->setCategory($formInfo['category']);
		$product->setDescription($formInfo['description']);
		$product->setSize($formInfo['size']);
		$product->setColor($formInfo['color']);
		$product->setSuplier($formInfo['suplier']);
		$product->setAmount($formInfo['amount']);

		$this->productHelper->save($product);		

		return Redirect::to('product');
	}

	/**
	 * Display the specified resource.
	 * GET /product/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$productTarget = $this->productHelper->all();
		return View::make('productShow',array('project' => , $productTarget););
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /product/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$productTarget = $this->productHelper->find($id);
		return View::make('productEdit',array('product' => $productTarget,'id' => $id));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /product/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		$productTarget = new \core\Product();

		$productTarget->setPrice($input['price']);
		$productTarget->setCategory($input['category']);
		$productTarget->setDescription($input['description']);
		$productTarget->setSize($input['size']);
		$productTarget->setColor($input['color']);
		$productTarget->setSuplier($input['suplier']);
		$productTarget->setAmount($input['amount']);
		
		$this->productHelper->saveId($productTarget,$id);
		return Redirect::to('product/'.$id.'/edit');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /product/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->productHelper->remove($id);
		return Redirect::to('product/view');
	}

}