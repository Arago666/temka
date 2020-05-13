<?php

namespace App\Http\Controllers\Games\CardWars;

use App\Http\Controllers\Controller;
use App\Models\CardWarsGame;
use Illuminate\Http\Request;

class CardWarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = CardWarsGame::all();
        return view('games.cardwars.index', compact('items'));
    }

//создание игры
    public function store(Request $request)
    {
        $item = new CardWarsGame();

        if($request->name==""){
            $count = CardWarsGame::all()->count()+1;

            $item->name = 'Игра №'.$count;
        }
        else{
            $item->name = $request->name;
        }

        if($request->count_players==""){
          $item->count_players = 2;
        }
        else{
            $item->count_players = $request->count_players;
        }
        $item->password = $request->password;

        $item->game_number = \Str::Random(15);





        $item->save();
        return redirect()->route('cardwars.show',$item->game_number);
//        return redirect()->route('cardwars.index');


   // **   $data = $request->input();

        //ушло в обсервер
        /* if(empty($data['slug'])){
             $data['slug'] = Str::slug($data['title']);
         }*/

        //Создаст объект но не добавит в БД
//        $item = new BlogCategory($data);
//        $item->save();

        //Создаст объект и добавит в БД
  //**      $item = (new BlogCategory())->create($data);


    //    return redirect()->route('cardwars.show',$item->game_number);

    }



    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    //открываем игру
    public function show($id)
    {
        $items = CardWarsGame::all()->where('game_number','=',$id);
        return view('games.cardwars.play',compact('items'));
    }





}
