<?php

namespace App\Http\Controllers\Games\CardWars;

use App\Events\CardWarsMain;
use App\Http\Controllers\Controller;
use App\Models\CardWarsDeckCard;
use App\Models\CardWarsGame;
use App\Models\CardWarsGameDeckCard;
use App\Models\CardWarsGamePlayerCard;
use App\Models\CardWarsGamePositionPlayer;
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
     //   broadcast(new CardWarsMain($items));
        return view('games.cardwars.play',compact('items'));
    }


    //получаем всех игроков за столом
    public function getPlayers($game_number){
        $players = CardWarsGamePositionPlayer::query()
            ->Where('game_number',$game_number)
            ->get();
        return $players;
    }

    //садимся за стол (выбираем позицию за столом)
    public function ChosePlayerPosition(Request $request)
    {
        $item = CardWarsGamePositionPlayer::query()
            ->Where('game_number',$request->game_number)
            ->Where('position',$request->position)
            ->get();
        if(count($item)>0||$request->deck_type=="")
        {
            return back();
        }
       // return back()->with(['success' => 'Успешно сохранено']);;

        $item = new CardWarsGamePositionPlayer();
        $item->game_number = $request->game_number;
        $item->color_id = $request->color_id;
        $item->position = $request->position;
        $item->user_id = auth()->user()->id;
        $item->user_name = auth()->user()->name;
        $item->hp = 25;

        $item->deck_type = $request->deck_type;
        $item->save();
//!!обработать событие добавить
        broadcast(new CardWarsMain($item));

        $number = collect([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40])->shuffle();
       $bugNumber = collect([1,2,3,4])->shuffle();

        for($i=0;$i<40;$i++){
        $card = new CardWarsGameDeckCard();
        $card->game_number = $request->game_number;
        $card->position_id = $request->position;

        $card->deck_type = $request->deck_type;
        $card->card_number = $i+1;
        $card->card_position = $number[$i];
        $card->status_knockout  = 1;
        $card->active_deck_status =1;
        $card->save();
    }





    //выкладываем 4 карты на стол (больших)
        for($i=0;$i<4;$i++){
            $card = new CardWarsGamePlayerCard();

            $card->game_number = $request->game_number;
            $card->position_id = $request->position;

            $card->number_card = $bugNumber[$i];
            $card->status  = 6;
            $card->card_type =2;//колода из 4 больших карт на столе
            $card->shirt_card =1;//картинкой вверх
            $card->position_card =$i+1;//колода из 4 больших карт на столе

            $card->save();
           // broadcast(new CardWarsMain($card));
        }
    }


    //получаем карты игроков
    public function getPlayersCards($game_number){
        $playerscards = CardWarsGamePlayerCard::query()
            ->Where('game_number',$game_number)
            ->get();
        return $playerscards;
    }


//получить картинки карт
    public function getCardsImg($game_number){
      $cardtype = CardWarsGamePositionPlayer::query()
          ->Where('game_number',$game_number)
          ->get();
//      dd($cardtype[0]->deck_type);

        if(count($cardtype)>1){
            $cardsImg = CardWarsDeckCard::query()
                ->where('deck_type',$cardtype[0]->deck_type)
                ->orWhere('deck_type', $cardtype[1]->deck_type)
                ->get();
        }
        else{
            $cardsImg = CardWarsDeckCard::query()
                ->where('deck_type',$cardtype[0]->deck_type)
                //->orWhere('deck_type', $cardtype[1]->deck_type)
                ->get();
        }
      //  broadcast(new CardWarsMain($cardsImg));
        return $cardsImg;

    }

    public function addCardToPlayer(Request $request)
    {
        $card = CardWarsGameDeckCard::query()
            ->Where('game_number',$request->game_number)
            ->Where('position_id',$request->position)
            ->Where('active_deck_status','=','1')
            ->first();
        $card->active_deck_status =3;
        $card->save();

        $playerCard = new CardWarsGamePlayerCard();
        $playerCard->game_number = $request->game_number;
        $playerCard->position_id = $request->position;

        $playerCard->number_card = $card->card_position;
        $playerCard->status  = 1; //на руке
        $playerCard->card_type =1;//колода из 40 обычных карт
        $playerCard->shirt_card =1;//картинкой вверх
        $playerCard->position_card =0;//на руке
        $playerCard->hp =0;

        $playerCard->save();

        broadcast(new CardWarsMain($playerCard));


    }

    public function cardWithHand(Request $request)
    {

        if($request->hp){
            $card = CardWarsGamePlayerCard::query()
                ->Where('game_number',$request->game_number)
                ->Where('position_id',$request->position)
                ->Where('number_card',$request->number_card)
                ->Where('status',$request->start_status)
                ->first();
            $card->hp = $card->hp+$request->hp;

            $card->save();
        }
        elseif ($request->shirt_card){
            $card = CardWarsGamePlayerCard::query()
                ->Where('game_number',$request->game_number)
                ->Where('position_id',$request->position)
                ->Where('number_card',$request->number_card)
                ->Where('status',$request->status)
                ->first();
            $card->shirt_card = $request->shirt_card;

            $card->save();
        }
        elseif($request->status==9){


            $card = CardWarsGamePlayerCard::query()
                ->Where('game_number',$request->game_number)
                ->Where('position_id',$request->position)
                ->Where('number_card',$request->number_card)
                ->Where('status',$request->start_status)
                ->first();
            $card->status = 9;
            $card->delete();

            $card = CardWarsGameDeckCard::query()
                ->Where('game_number',$request->game_number)
                ->Where('position_id',$request->position)
                ->Where('card_position',$request->number_card)
                ->Where('active_deck_status','=','3')
                ->first();
            $card->active_deck_status =1;
            $card->save();




        }
        else{
            $card = CardWarsGamePlayerCard::query()
                ->Where('game_number',$request->game_number)
                ->Where('position_id',$request->position)
                ->Where('number_card',$request->number_card)
                ->Where('status',$request->start_status)
                ->first();
            $card->position_card = $request->position_card;
            $card->status = $request->status;
            $card->save();
        }

        broadcast(new CardWarsMain($card));

        //добавляем карту в сброс
//        if($request->status==8)
//        {
//            $card = CardWarsGameDeckCard::query()
//                ->Where('game_number',$request->game_number)
//                ->Where('position_id',$request->position)
//                ->Where('active_deck_status','=','3')
//                ->first();
//            $card->active_deck_status =2;
//            $card->save();
//        }

    }


    public function changeHpPlayer(Request $request)
    {
        $player = CardWarsGamePositionPlayer::query()
            ->Where('game_number',$request->game_number)
            ->Where('position',$request->position)
            ->first();
        $player->hp = $player->hp + $request->changeHpCount;
        $player->save();
        broadcast(new CardWarsMain($player));
    }



}
