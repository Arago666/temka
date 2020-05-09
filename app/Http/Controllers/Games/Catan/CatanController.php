<?php

namespace App\Http\Controllers\Games\Catan;

use App\Events\CatanPlayerCardToDb;
use App\Models\CatanGameDevelopmentCard;
use App\Models\CatanGameKnightPosition;
use App\Models\CatanGameLog;
use App\Models\CatanGamePlayerCard;
use App\Models\CatanGamePositionPlayer;
use App\Events\CatanBuildingToDb;
use App\Http\Controllers\Controller;
use App\Models\CatanCoordinateElement;
use App\Models\CatanGame;
use App\Models\CatanGamePositionElement;
use App\Models\CatanGameTurn;
use App\Models\CatanPositionCard;
use App\Models\Message;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;
use function React\Promise\Stream\first;

class CatanController extends Controller
{
    public function index()
    {
        $items = CatanGame::all();
        return view('games.catan.index', compact('items'));
    }
    public function show($id)
    {
        $items = CatanGame::all()->where('game_number','=',$id);
        return view('games.catan.play',compact('items'));
    }

    //создание игры
    public function create()
    {
        $count = CatanGame::all()->count()+1;

        $item = new CatanGame();
        $item->game_number = \Str::Random(15);
        $item->name = 'Игра №'.$count;

        $item->save();



        //порядок чисел
       // $number = collect([2,3,3,4,4,5,5,6,6,8,8,9,9,10,10,11,11,12])->shuffle();
        //круг цифр (несколько вариантов для начального положения буквы "а", чтобы идти по кругу с разных первоначальных гексов
        $a=rand(1,4);
        if($a==1){
        $position =collect([1,2,3,7,12,16,19,18,17,13,8,4,5,6,11,15,14,9,10]);}
        if($a==2){
        $position =collect([12,16,19,18,17,13,8,4,1,2,3,7,  11,15,14,9,5,6,  10]);}
        if($a==3){
        $position =collect([18,17,13,8,4,1,2,3,7,12,16,19,  15,14,9,5,6,11,  10]);}
        if($a==4){
        $position =collect([13,8,4,1,2,3,7,12,16,19,18,17,  14,9,5,6,11,15,  10]);}

        //порядок фифр (а(с другой стороны 5),б(с другой стороны 2),в(с другой стороны 6),...)
        $positionA = collect([5,2,6,3,8,10,9,12,11,4,8,10,   9,4,5,6,3,  11]);

        //порядок гексов
        $collection = collect([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19])->shuffle();

        //Определяем коллекцию произвольными значениями, чтобы потом перезадать (в данной коллекции содержатся цифры на гексах)
        $collectionNumber=collect([777,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,777]);
        $s=0;

        for($i=0;$i<19;$i++)
        {
            for($j=1;$j<19;$j++)
            {
                if($collection[$j]==$position[$i])
                {
                   $collectionNumber[$j]=$positionA[$s];
                    $s++;
                }
            }
        }

        //пустыня (1 гекс)
        $position= new CatanPositionCard();
        $position->position = $collection[0];
        $position->game_number=$item->game_number;
        $position->card_type_id = 1;
        $position->number = $collectionNumber[$i];
        $position->save();
        //глина (3 гекса)
        for($i=1;$i<4;$i++)
        {
        $position= new CatanPositionCard();
        $position->position = $collection[$i];
        $position->game_number=$item->game_number;
        $position->card_type_id = 2;
        $position->number = $collectionNumber[$i];
        $position->save();
        }
        //камень (3 гекса)
        for($i=4;$i<7;$i++)
        {
            $position= new CatanPositionCard();
            $position->position = $collection[$i];
            $position->game_number=$item->game_number;
            $position->card_type_id = 3;
            $position->number = $collectionNumber[$i];
            $position->save();
        }
        //лес (4 гекса)
        for($i=7;$i<11;$i++)
        {
            $position= new CatanPositionCard();
            $position->position = $collection[$i];
            $position->game_number=$item->game_number;
            $position->card_type_id = 4;
            $position->number = $collectionNumber[$i];
            $position->save();
        }
        //сено (4 гекса)
        for($i=11;$i<15;$i++)
        {
            $position= new CatanPositionCard();
            $position->position = $collection[$i];
            $position->game_number=$item->game_number;
            $position->card_type_id = 5;
            $position->number = $collectionNumber[$i];
            $position->save();
        }
        //овца (4 гекса)
        for($i=15;$i<19;$i++)
        {
            $position= new CatanPositionCard();
            $position->position = $collection[$i];
            $position->game_number=$item->game_number;
            $position->card_type_id = 6;
            $position->number = $collectionNumber[$i];
            $position->save();
        }

//        //создаем таблицу с пустыми ячейками (пока ничего не построено)
//        //54 для города/поселения
//        for($i=1;$i<55;$i++)
//        {
//        $gameElements = new CatanGamePositionElement();
//        $gameElements->game_number = $item->game_number;
//        $gameElements->element_type_id = 3;
//        $gameElements->number = $i;
//        $gameElements->save();
//        }
//        //24 для вертикальной дороги
//        for($i=1;$i<25;$i++)
//        {
//            $gameElements = new CatanGamePositionElement();
//            $gameElements->game_number = $item->game_number;
//            $gameElements->element_type_id = 4;
//            $gameElements->number = $i;
//            $gameElements->save();
//        }
//        //24 для дороги левоНиз - правоВерх
//        for($i=1;$i<25;$i++)
//        {
//            $gameElements = new CatanGamePositionElement();
//            $gameElements->game_number = $item->game_number;
//            $gameElements->element_type_id = 5;
//            $gameElements->number = $i;
//            $gameElements->save();
//        }
//        //24 для дороги левоВерх - правоНиз
//        for($i=1;$i<25;$i++)
//        {
//            $gameElements = new CatanGamePositionElement();
//            $gameElements->game_number = $item->game_number;
//            $gameElements->element_type_id = 6;
//            $gameElements->number = $i;
//            $gameElements->save();
//        }


        //стартовое количество ресурсов 0
        for($i=1;$i<5;$i++)
        {
            for($j=1;$j<12;$j++)
            {
                $res= new CatanGamePlayerCard();
                $res->game_number=$item->game_number;
                $res->position_id = $i;
                $res->type_res = $j;
                $res->count_res = 0;
                $res->save();
            }
        }


        //стартовая колода с картами развития

        $cardposition = collect([6,6,6,6,6, 7,7, 8,8, 9,9, 10,10,10,10,10,10,10,10,10,10,10,10,10,10,])->shuffle();

        for($i=0;$i<25;$i++)
        {
            $position = new CatanGameDevelopmentCard();
            $position->game_number=$item->game_number;
            $position->position = $i;
            $position->type_card = $cardposition[$i];
            $position->status = 0;
            $position->save();

        }

        return redirect()->route('catan.show',$item->game_number);
    }

    //получить позиции карт в текущей игре
    public function getCatanCardPosition($game_number)
    {
        $status = CatanPositionCard::Where('game_number',$game_number)->orderBy('position')->get();
       // $status=CatanPositionCard::Where('game_number',1)->orderBy('position')->get();

        return $status;
    }

    //получить координаты гексов для начальной отрисовки
    public function getCatanCoordinateElements()
    {
        $coordinates = CatanCoordinateElement::all();

        return $coordinates;
    }

    //получить цвет для игрока (для отрисовки элементов)
    public function getCatanPlayerColor($game_number)
    {

        $color = CatanGamePositionPlayer::query()->join('catan_colors','catan_colors.id','=','catan_game_position_players.color_id')
            ->Where('game_number',$game_number)
            ->where('user_id','=',auth()->user()->id)
            ->get();
      //  $status = CatanPositionCard::Where('game_number',$game_number)->orderBy('position')->get();
        // $status=CatanPositionCard::Where('game_number',1)->orderBy('position')->get();

        return $color;
    }

    //получить постройки в игре (где какие дороги, города и поселения стоят)
    public function getBuildings($game_number)
    {
        $buildings = CatanGamePositionElement::query()
            ->join('catan_colors','catan_colors.id','=','catan_game_position_elements.color_id')
            ->Where('game_number',$game_number)
            ->join('catan_coordinate_elements', function($join){
                    $join->on('catan_coordinate_elements.element_type_id','=','catan_game_position_elements.element_type_id')
                        ->on('catan_coordinate_elements.number','=','catan_game_position_elements.number');
            })
            ->get();
//        ->sortByDesc('element_type_id')
        return $buildings;
    }

    //получить постройки в игре (где какие дороги, города и поселения стоят)
    public function getPlayerCards($game_number)
    {
        $cards = CatanGamePlayerCard::query()
            ->Where('game_number',$game_number)
            ->get();
        return $cards;
    }

    //получить постройки в игре (где какие дороги, города и поселения стоят)
    public function getPlayers($game_number)
    {
        $players = CatanGamePositionPlayer::query()
            ->Where('game_number',$game_number)
            ->join('users', function($join){
                $join->on('users.id','=','catan_game_position_players.user_id');
            })
            ->get();
        return $players;
    }

    //добавить ресурс игроку
    public function AddResToPlayer(Request $request){
        if($request->type_res<6){
            $res = CatanGamePlayerCard::query()
                ->Where('game_number',$request->game_number)
                ->Where('position_id','=',$request->position_id)
                ->Where('type_res','=',$request->type_res)
                ->first();

            if($res){
                $res->count_res = $res->count_res+1;
                $res->save();
            }
            else{
                $res = new CatanGamePlayerCard();

                $res -> game_number = $request->game_number;
                $res -> position_id = $request->position_id;
                $res -> type_res = $request->type_res;
                $res -> count_res = 1;
                $res->save();

            }
            broadcast(new CatanPlayerCardToDb($res));
        }
        else{
            $card = CatanGameDevelopmentCard::query()
                ->Where('game_number',$request->game_number)
                ->Where('status','=','0')
                ->orderBy('position','asc')
                ->first();


            $res = CatanGamePlayerCard::query()
                ->Where('game_number',$request->game_number)
                ->Where('position_id','=',$request->position_id)
                ->Where('type_res','=',$card->type_card)
                ->first();
            $res->count_res = $res->count_res+1;
            $res->save();

            $card->status = 1;
            $card->save();
            broadcast(new CatanPlayerCardToDb($res));




        }

    }
    //добавить ресурс игроку со стола
    public function AddResToPlayerFromtable(Request $request){
        if($request->type_res<6){
            $res = CatanGamePlayerCard::query()
                ->Where('game_number',$request->game_number)
                ->Where('position_id','=',$request->position_id)
                ->Where('type_res','=',$request->type_res)
                ->first();

            if($res){
                $res->count_res = $res->count_res+1;
                $res->save();
            }
            else{
                $res = new CatanGamePlayerCard();

                $res -> game_number = $request->game_number;
                $res -> position_id = $request->position_id;
                $res -> type_res = $request->type_res;
                $res -> count_res = 1;
                $res->save();

            }
            broadcast(new CatanPlayerCardToDb($res));
        }

        //убрать карту со стола
        $turn = CatanGameTurn::query()
            ->Where('game_number',$request->game_number)
            ->orderBy('id','desc')
            ->first();
        if($request->type_res==1){
            $turn->count_card_one = $turn->count_card_one-1;
        }
        if($request->type_res==2){
            $turn->count_card_two = $turn->count_card_two-1;
        }
        if($request->type_res==3){
            $turn->count_card_tree = $turn->count_card_tree-1;
        }
        if($request->type_res==4){
            $turn->count_card_four = $turn->count_card_four-1;
        }
        if($request->type_res==5){
            $turn->count_card_five = $turn->count_card_five-1;
        }


        $turn->save();
        broadcast(new CatanBuildingToDb($turn));


    }

    public function DelResFromPlayer(Request $request){
        $res = CatanGamePlayerCard::query()
            ->Where('game_number',$request->game_number)
            ->Where('position_id','=',$request->position_id)
            ->Where('type_res','=',$request->type_res)
            ->first();
        if($res){
            $res->count_res = $res->count_res-1;
            $res->save();
        }
        else{
            return back();
        }
        broadcast(new CatanPlayerCardToDb($res));

        //добавить карту на стол
        $turn = CatanGameTurn::query()
            ->Where('game_number',$request->game_number)
            ->orderBy('id','desc')
            ->first();
        if($request->type_res==1){
            $turn->count_card_one = $turn->count_card_one+1;
        }
        if($request->type_res==2){
            $turn->count_card_two = $turn->count_card_two+1;
        }
        if($request->type_res==3){
            $turn->count_card_tree = $turn->count_card_tree+1;
        }
        if($request->type_res==4){
            $turn->count_card_four = $turn->count_card_four+1;
        }
        if($request->type_res==5){
            $turn->count_card_five = $turn->count_card_five+1;
        }
        if($request->type_res>5){
            $turn->card_dev_type = $request->type_res;
        }

        $turn->save();
        broadcast(new CatanBuildingToDb($turn));

        //если рыцарь то добавить в сыгранные рыцари
        if($request->type_res==10){
            $res = CatanGamePlayerCard::query()
                ->Where('game_number',$request->game_number)
                ->Where('position_id','=',$request->position_id)
                ->Where('type_res','=',11)
                ->first();
            if($res) {
                $res->count_res = $res->count_res + 1;
                $res->save();
            }
            broadcast(new CatanPlayerCardToDb($res));
        }


    }

    //выбрать цвет за столом
    public function ChoseColor(Request $request)
    {
        $color = CatanGamePositionPlayer::query()
            ->Where('game_number',$request->game_number)
          //  ->where('user_id','=',auth()->user()->id)
            ->Where('color_id','=',$request->color_id)
            ->get();

        //проверка выбран ли уже цвет игроком, если да - то выходим
        $color1 = CatanGamePositionPlayer::query()
            ->Where('game_number',$request->game_number)
            ->where('user_id','=',auth()->user()->id)
            ->get();
        if(count($color)>0 || count($color1)>0 ){
            return back();
               // ->withErrors(['msg' => 'Ошибка удаления']);
        }

        $item = new CatanGamePositionPlayer();

        $item -> user_id = $request->user()->id;
       $item -> user_name = $request->user()->name;
        $item -> game_number = $request->game_number;
       // $item = CatanGame::find($request->game_number);

    //    $item->password =$request->user()->id;
        if($request->color=='red')
        {
            $item->color_id = 1;
            $item->position = 1;
        }
        if($request->color=='green')
        {
            $item->color_id = 2;
            $item->position = 2;
        }
        if($request->color=='orange')
        {
            $item->color_id = 3;
            $item->position = 3;
        }
        if($request->color=='blue')
        {
            $item->color_id = 4;
            $item->position = 4;
        }
        $item->save();

        broadcast(new CatanBuildingToDb($item));

    }

    //cтроительство на карте дороги, поселения или города
    public function AddBuildingToDb(Request $request)
    {
        $item = CatanGamePositionElement::query()
        ->Where('game_number','=',$request->game_number)
            ->Where('element_type_id','=',$request->element_type_id)
            ->Where('number','=',$request->number)
 //           ->join('catan_colors','catan_colors.id','=','catan_game_position_elements.color_id')
//            ->join('catan_coordinate_elements', function($join){
//                $join->on('catan_coordinate_elements.element_type_id','=','catan_game_position_elements.element_type_id')
//                    ->on('catan_coordinate_elements.number','=','catan_game_position_elements.number');
//            })
            ->first();
        if($item){
            $item->color_id = $request->color_id;
            $item->status = $request->typeCityOrVillege;
            $item->save();
        }
        else{
            $item1 = new CatanGamePositionElement();
            $item1->game_number = $request->game_number;
            $item1->element_type_id = $request->element_type_id;
            $item1->number = $request->number;
            $item1->color_id = $request->color_id;
            $item1->status = $request->typeCityOrVillege;
            $item1->save();


        }




//        $item = CatanGamePositionElement::query()
//            ->join('catan_colors','catan_colors.id','=','catan_game_position_elements.color_id')
//            ->Where('game_number','=',$request->game_number)
//            ->Where('element_type_id','=',$request->element_type_id)
//            ->Where('number','=',$request->number)
 //
//            ->join('catan_coordinate_elements', function($join){
//                $join->on('catan_coordinate_elements.element_type_id','=','catan_game_position_elements.element_type_id')
//                    ->on('catan_coordinate_elements.number','=','catan_game_position_elements.number');
//            })
//            ->first();

    //    $item2 = new \http\Env\Request();
    //    $item2 = $request;


//$data = $request;
//        $data->color_id = $request->color_id;
//
//
//        $data->status = $request->typeCityOrVillege;

//        $item1->color1_element = $request->color1_element;
//        $item1->color2_element = $request->color2_element;
//        $item1->color3_element = $request->color3_element;
//        $item1->coordinate_top = $request->coordinate_top;
//        $item1->coordinate_left = $request->coordinate_left;

      //  $item->color_id = 999;
     //   var_dump($item2);
//        $color = CatanGamePositionPlayer::query()
//            ->Where('game_number',$request->game_number)
//            ->first();

        $catanGameLog = new CatanGameLog();
        $catanGameLog->game_number = $request->game_number;
        $catanGameLog->element_type_id = $request->element_type_id;
        $catanGameLog->number = $request->number;

        $catanGameLog->color_id = $request->color_id;
        $catanGameLog->status = $request->typeCityOrVillege;

        $catanGameLog->color1_element = $request->color1_element;
        $catanGameLog->color2_element = $request->color2_element;
        $catanGameLog->color3_element = $request->color3_element;
        $catanGameLog->coordinate_top = $request->coordinate_top;
        $catanGameLog->coordinate_left = $request->coordinate_left;
        $catanGameLog->save();

        broadcast(new CatanBuildingToDb($catanGameLog))->toOthers();

       // broadcast(new CatanPlayerCardToDb($catanGameLog));
    }

    //удаление на карте дороги, поселения или города
    public function DelBuildingFromDb(Request $request)
    {
        $item = CatanGamePositionElement::query()
            ->Where('game_number','=',$request->game_number)
            ->Where('element_type_id','=',$request->element_type_id)
            ->Where('number','=',$request->number)
            ->delete();

       // broadcast(new CatanBuildingToDb($catanGameLog))->toOthers();
    }






    //получить место, где стоит рыцарь
    public function getKnightPosition($game_number)
    {
        $position = CatanGameKnightPosition::query()
            ->Where('game_number',$game_number)
            ->get();
        return $position;
    }

    //поменять расположение рыцаря
    public function changeKnightPosition(Request $request){
        $position = CatanGameKnightPosition::query()
            ->where('game_number',$request->game_number)
            ->first();
        if($position){
            $position->position_knight=$request->position_knight;
            $position->save();
        }
        else{
            $position = new CatanGameKnightPosition();
            $position->game_number = $request->game_number;
            $position->position_knight=$request->position_knight;
            $position->save();
        }
        broadcast(new CatanBuildingToDb($position));
    }

    public function TrowDice(Request $request)
    {
        //найти какой сейчас ход
        //найти кто сейчас ходит
        $dice = new CatanGameTurn();
        $dice->dice_one = rand(1,6);
        $dice->dice_two = rand(1,6);
        $dice->game_number = $request->game_number;

        $dice->turn_number = 0;
        $dice->position_id = 0;
        $dice->count_card_one = 0;
        $dice->count_card_two = 0;
        $dice->count_card_tree = 0;
        $dice->count_card_four = 0;
        $dice->count_card_five = 0;
        $dice->card_dev_type = 0;

        $dice->save();
        broadcast(new CatanBuildingToDb($dice));

    }
    public function StealRes(Request $request)
    {
        $res = CatanGamePlayerCard::query()
            ->Where('game_number',$request->game_number)
            ->Where('position_id','=',$request->player_id_to_steal)
            ->Where('count_res','!=','0')
            ->Where('type_res','<','6')
            ->get();
        $type_res_to_steal = rand(1,count($res));
        for($i=0;$i<count($res);$i++){
            if($i+1==$type_res_to_steal){
                $type_res_to_add =  $res[$i]->type_res;
                $res[$i]->count_res = $res[$i]->count_res-1;
                $res[$i]->save();
                broadcast(new CatanPlayerCardToDb($res[$i]));
            }
        }


        $res1 = CatanGamePlayerCard::query()
            ->Where('game_number',$request->game_number)
            ->Where('position_id','=',$request->position_id)
            ->Where('type_res','=',$type_res_to_add)
            ->first();
        $res1->count_res = $res1->count_res +1;
        $res1->save();
        broadcast(new CatanPlayerCardToDb($res1));

    }



}
