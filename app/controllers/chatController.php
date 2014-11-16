<?php

class ChatController extends \BaseController {

  /**
   * Display a listing of the resource.
   * GET /chat
   *
   * @return Response
   */
  public function index()
  {
    //check Is admin online 
    return View::make('chatPage',array( 'user' => core\User::newFromEloquent(Auth::user()),
      'user_all' => User::all() , 'messages' => Message::all()));
  }

  /**
   * Show the form for creating a new resource.
   * GET /chat/create
   *
   * @return Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a Chat 
   * POST /chat
   *
   * @return Response
   */
  public function store()
  {
    if(Request::ajax()) {
      $message = new Message();
      $message->name = Input::get('name');
      $message->message = Input::get('message');
      $message->save(); 

    }else{
      return "You don't have permission";
    }
  }


  /**
   * Display the specified resource.
   * GET /chat/{id}
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
   * GET /chat/{id}/edit
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
   * PUT /chat/{id}
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
   * DELETE /chat/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }

}
