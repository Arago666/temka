<?php

namespace App\Http\Controllers\Games\Catan;

use App\Models\CatanGameLog;
use App\Models\CatanGamePositionPlayer;
use App\Events\CatanBuildingToDb;
use App\Http\Controllers\Controller;
use App\Models\CatanCoordinateElement;
use App\Models\CatanGame;
use App\Models\CatanGamePositionElement;
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

    //выбрать цвет за столом
    public function ChoseColor(Request $request)
    {
        $color = CatanGamePositionPlayer::query()
            ->Where('game_number',$request->game_number)
          //  ->where('user_id','=',auth()->user()->id)
            ->Where('color_id','=',$request->color_id)
            ->get();
        $color1 = CatanGamePositionPlayer::query()
            ->Where('game_number',$request->game_number)
            ->where('user_id','=',auth()->user()->id)
            ->get();
        if(count($color)>0 || count($color1)>0 ){
            return false;
        }

        $item = new CatanGamePositionPlayer();

        $item -> user_id = $request->user()->id;
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
    }

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
    }

}