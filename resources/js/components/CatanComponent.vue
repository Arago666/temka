<template>
    <div class="container">

        <div style="position:absolute; top:100px; left: 610px;">
            <div style="position:absolute; left:718px; top:0px;">
                <div v-if="colors[0]">


                    <!--            Взять ресурс из банка (карты)-->
                    <div style="position: absolute;top:0px;left:-55px;">
                        <div style="position: absolute;top:0px;left:0px;">
                            <img src="/img/kart-seno.png" width="80" height="120">
                            <button v-on:click="addResToPlayer(1)" class="btn btn-success" style="width:80px;" >Взять</button>

                        </div>
                        <div style="position: absolute;top:0px;left:90px;">
                            <img src="/img/kart-glina.png"  width="80" height="120">
                            <button v-on:click="addResToPlayer(2)" class="btn btn-success" style="width:80px;" >Взять</button>
                        </div>
                        <div  style="position: absolute;top:0px;left:180px;">
                            <img class="content_center" src="/img/kart-les.png"  width="80" height="120">
                            <button v-on:click="addResToPlayer(3)" class="btn btn-success" style="width:80px;" >Взять</button>
                        </div>
                        <div style="position: absolute;top:0px;left:270px;">
                            <img src="/img/kart-ovtsa.png"  width="80" height="120">
                            <button v-on:click="addResToPlayer(4)" class="btn btn-success" style="width:80px;" >Взять</button>
                        </div>
                        <div style="position: absolute;top:0px;left:360px;">
                            <img src="/img/kart-kamen.png"  width="80" height="120">
                            <button v-on:click="addResToPlayer(5)" class="btn btn-success" style="width:80px;" >Взять</button>
                        </div>
                        <div style="position: absolute;top:0px;left:450px;">
                            <img src="/img/kart-back.png"  width="80" height="120">
                            <button v-on:click="addResToPlayer(7)" class="btn btn-success" style="width:80px;" >Взять</button>
                        </div>

                    </div>


                    <!--        Стол    Бросить кубики-->
                    <div style="position: absolute;
                    top:200px;
                    left:-55px;
                    width: 600px;
                    height: 300px;
                    background: url(/img/derevo-doski-fon2.jpg);
                    background-size:600px 300px;
                    border-radius:100px;
                    box-shadow: 0 12px 6px -6px #666, 0 0 3px 0 #ccc;">
                        <div style="position: absolute;left:250px;top:310px;">
                        <button v-on:click="trowdice()" class="btn btn-success" style="width:80px;" >Кубики</button>

                        </div>
                        <div v-if="status_dice_rest_to_player==1" style="position: absolute;left:340px;top:310px;">

                            <button v-on:click="addresfromdice()" class="btn btn-success" style="width:150px;" >Раздать ресурсы</button>
                        </div>
                        <div style="z-index: 999;position: absolute;left:100px;top:20px;">
                            <img v-if="dice_one==1" src="/img/1.png" width="50" height="50">
                            <img v-if="dice_one==2" src="/img/2.png" width="50" height="50">
                            <img v-if="dice_one==3" src="/img/3.png" width="50" height="50">
                            <img v-if="dice_one==4" src="/img/4.png" width="50" height="50">
                            <img v-if="dice_one==5" src="/img/5.png" width="50" height="50">
                            <img v-if="dice_one==6" src="/img/6.png" width="50" height="50">
                        </div>

                        <div style="z-index: 999;position: absolute;left:170px;top:20px;">
                            <img v-if="dice_two==1" src="/img/1.png" width="50" height="50">
                            <img v-if="dice_two==2" src="/img/2.png" width="50" height="50">
                            <img v-if="dice_two==3" src="/img/3.png" width="50" height="50">
                            <img v-if="dice_two==4" src="/img/4.png" width="50" height="50">
                            <img v-if="dice_two==5" src="/img/5.png" width="50" height="50">
                            <img v-if="dice_two==6" src="/img/6.png" width="50" height="50">
                        </div>

                    </div>
                    <div style="position: absolute;top:190px;left:-55px;">
                        <div style="position: absolute;top:0px;left:0px;">



                            <div style="position: absolute;top:90px;left:35px;">
                                <div style="display: none;position: absolute;top:90px;left:0px;">{{a=0}}</div>
                                <div v-if="table_card_one!=0" style="position: absolute;top:0px;left:0px;">
                                    <div style="display: none;">{{a=90}}</div>
                                    <img src="/img/kart-seno.png" width="80" height="120">
                                    <button v-on:click="addResToPlayerFromTable(1)" class="btn btn-success" style="width:80px;" >{{table_card_one}}</button>

                                </div>
                                <div v-if="table_card_two!=0" :style="'position: absolute;top:0px;left:'+a+'px;'">
                                  <div style="display: none;">{{a=90+a}}</div>
                                    <img src="/img/kart-glina.png"  width="80" height="120">
                                    <button v-on:click="addResToPlayerFromTable(2)" class="btn btn-success" style="width:80px;" >{{table_card_two}}</button>
                                </div>
                                <div v-if="table_card_tree!=0" :style="'position: absolute;top:0px;left:'+a+'px;'">
                                    <div style="display: none;">{{a=90+a}}</div>
                                    <img class="content_center" src="/img/kart-les.png"  width="80" height="120">
                                    <button v-on:click="addResToPlayerFromTable(3)" class="btn btn-success" style="width:80px;" >{{table_card_tree}}</button>
                                </div>
                                <div v-if="table_card_four!=0" :style="'position: absolute;top:0px;left:'+a+'px;'">
                                    <div style="display: none;">{{a=90+a}}</div>
                                    <img src="/img/kart-ovtsa.png"  width="80" height="120">
                                    <button v-on:click="addResToPlayerFromTable(4)" class="btn btn-success" style="width:80px;" >{{table_card_four}}</button>
                                </div>
                                <div v-if="table_card_five!=0" :style="'position: absolute;top:0px;left:'+a+'px;'">
                                    <div style="display: none;">{{a=90+a}}</div>
                                    <img src="/img/kart-kamen.png"  width="80" height="120">
                                    <button v-on:click="addResToPlayerFromTable(5)" class="btn btn-success" style="width:80px;" >{{table_card_five}}</button>
                                </div>
                                <div v-if="table_card_dev!=0" :style="'position: absolute;top:0px;left:'+a+'px;'">
                                    <div style="display: none;">{{a=90+a}}</div>
                                    <img v-if="table_card_dev==6" src="/img/kart-1poin-1.png"  width="80" height="120">
                                    <img v-if="table_card_dev==7" src="/img/kart-monopolia.png"  width="80" height="120">
                                    <img v-if="table_card_dev==8" src="/img/kart-proriv.png"  width="80" height="120">
                                    <img v-if="table_card_dev==9" src="/img/kart-road.png"  width="80" height="120">
                                    <img v-if="table_card_dev==10" src="/img/kart-knight.png"  width="80" height="120">

                                </div>


                            </div>

                        </div>

                    </div>

                </div>
                <div v-if="!colors[0]">
                    Выбрать цвет
                    <button class="btn btn-danger" v-on:click="ChoseColor('red',1)" style="width: 100px;">Красный</button>
                    <button class="btn btn-success" v-on:click="ChoseColor('green',2)" style="width: 100px;">Зеленый</button>
                    <button class="btn btn-warning" v-on:click="ChoseColor('orange',3)" style="width: 100px; background-color: orange; border-color:orange;">Оранжевый</button>
                    <button class="btn btn-primary" v-on:click="ChoseColor('blue',4)" style="width: 100px;">Голубой</button>
                </div>

            </div>

            <!--         стартовые гексы - море-->
            <div v-for="coordinate in coordinates"
                 :class="'type'+coordinate.element_type_id+'-'+coordinate.number" v-if="coordinate.element_type_id==1">

                <div  :style="'position: absolute; top:'+ coordinate.coordinate_top +'px; left:'+ coordinate.coordinate_left +'px; height: 100px; width: 100px;'">
                    <svg  viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <polygon  points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#type_more)"/>
                    </svg>
                </div>

            </div>

<!--         стартовые гексы - земля-->
            <div v-for="coordinate in coordinates"
                 :class="'type'+coordinate.element_type_id+'-'+coordinate.number" v-if="coordinate.element_type_id==2">

                <div :style="'position: absolute; top:'+ coordinate.coordinate_top +'px; left:'+ coordinate.coordinate_left +'px; height: 100px; width: 100px;'">

                    <svg v-for="position in positions" v-if="coordinate.number == position.position" viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <polygon v-if="position.card_type_id == 1" points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#type_pyst)"/>
                        <polygon v-else-if="position.card_type_id == 2" points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#type_glina)"/>
                        <polygon v-else-if="position.card_type_id == 3" points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#type_kamen)"/>
                        <polygon v-else-if="position.card_type_id == 4" points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#type_les)"/>
                        <polygon v-else-if="position.card_type_id == 5" points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#type_seno)"/>
                        <polygon v-else-if="position.card_type_id == 6" points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#type_ovtsa)"/>
                    </svg>
                </div>
                <div style="display: none;">
                    {{ a = coordinate.coordinate_left + 36 }}
                    {{ b = coordinate.coordinate_top + 34 }}
                </div>
<!--                Цифры на гексах-->
                <div v-for="position in positions" v-if="coordinate.number == position.position">
                    <input v-on:dblclick="addKnight(coordinate.number)" :class="'btnNumber'+coordinate.number" v-if="position.number!=8 && position.number!=6 && position.number!=777" type="button" :value="position.number" :style="'z-index:99;position: absolute; left: '+ a +'px;top:'+ b +'px;  margin: 0 auto;height:30px;cursor:default; width:30px;  display: inline-block;  color: black; font-size:14px; font-weight: bold;  outline: none;  border: 2px solid white;  border-radius: 70px; background: rgb(238, 239, 195);    box-shadow: 0 12px 6px -6px #b1b1b1, 0 0 3px 0 #151515;'">
                    <input v-on:dblclick="addKnight(coordinate.number)" :class="'btnNumber'+coordinate.number" v-else-if="position.number==8 || position.number==6 && position.number!=777" type="button" :value="position.number" :style="'z-index:99;position: absolute; left: '+ a +'px;top:'+ b +'px;  margin: 0 auto;height:30px;cursor:default; width:30px;  display: inline-block;  color: red; font-size:14px; font-weight: bold;  outline: none;  border: 2px solid white;  border-radius: 70px; background: rgb(238, 239, 195);    box-shadow: 0 12px 6px -6px #b1b1b1, 0 0 3px 0 #151515;'">
<!--                    //местоположение рыцаря-->
                    <input v-if="coordinate.number==knightPosition" :class="'btnNumber000'+coordinate.number" type="button"  :style="'z-index:99;position: absolute; left: '+ a +'px;top:'+ b +'px;  margin: 0 auto;height:30px;cursor:pointer; width:30px;  display: inline-block;  color: black; font-size:14px; font-weight: bold;  border: 2px solid white;  border-radius: 70px; background: url(/img/7.png);background-size: 30px 30px; '">

                </div>


            </div>

            <div id="dlya-otobrajenia-elementov" class="nenyjnii element" >
                <div style="position: absolute; top: 0px; left: 135px; height: 100px; width: 100px;">
                    <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="type_glina" patternUnits="userSpaceOnUse" width="100" height="100">
                                <image href="/img/glina.png" x="0" y="0" width="100%" height="100%" preserveAspectRatio="none"/>
                            </pattern>
                        </defs>
                        <polygon   points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#type_glina)"/>
                    </svg>
                </div>


                <div style="position: absolute; top: 0px; left: 135px; height: 100px; width: 100px;">
                    <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="type_pyst" patternUnits="userSpaceOnUse" width="100" height="100">
                                <image href="/img/pyst.png" x="0" y="0" width="100%" height="100%" preserveAspectRatio="none"/>
                            </pattern>
                        </defs>
                        <polygon   points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#type_pyst)"/>
                    </svg>
                </div>


                <div style="position: absolute; top: 0px; left: 135px; height: 100px; width: 100px;">
                    <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="type_kamen" patternUnits="userSpaceOnUse" width="100" height="100">
                                <image href="/img/kamen.png" x="0" y="0" width="100%" height="100%" preserveAspectRatio="none"/>
                            </pattern>
                        </defs>
                        <polygon   points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#type_kamen)"/>
                    </svg>
                </div>

                <div style="position: absolute; top: 0px; left: 135px; height: 100px; width: 100px;">
                    <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="type_les" patternUnits="userSpaceOnUse" width="100" height="100">
                                <image href="/img/les.png" x="0" y="0" width="100%" height="100%" preserveAspectRatio="none"/>
                            </pattern>
                        </defs>
                        <polygon   points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#type_les)"/>
                    </svg>
                </div>
                <div style="position: absolute; top: 0px; left: 135px; height: 100px; width: 100px;">
                    <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="type_ovtsa" patternUnits="userSpaceOnUse" width="100" height="100">
                                <image href="/img/ovtsa.png" x="0" y="0" width="100%" height="100%" preserveAspectRatio="none"/>
                            </pattern>
                        </defs>
                        <polygon   points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#type_ovtsa)"/>
                    </svg>
                </div>

                <div style="position: absolute; top: 0px; left: 135px; height: 100px; width: 100px;">
                    <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="type_seno" patternUnits="userSpaceOnUse" width="100" height="100">
                                <image href="/img/seno.png" x="0" y="0" width="100%" height="100%" preserveAspectRatio="none"/>
                            </pattern>
                        </defs>
                        <polygon   points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#type_seno)"/>
                    </svg>
                </div>

                <div style="position: absolute; top: 0px; left: 135px; height: 100px; width: 100px;">
                    <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="type_more" patternUnits="userSpaceOnUse" width="100" height="100">
                                <image href="/img/more.png" x="-25" width="150" height="100" />
                            </pattern>
                        </defs>
                        <polygon points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#type_more)"/>
                    </svg>
                </div>


            </div>

<!--           Значки обмена ресурсов на карте-->
            <div v-if="statusTorg==1">
                <div style="position: absolute;top:455px;left:341px;">
                    <img src="/img/0-derevo.png"  width="20" height="20">
                </div>
                <div style="position: absolute;top:332px;left:115px;">
                    <img src="/img/0-seno.png"  width="20" height="20">
                </div>
                <div style="position: absolute;top:63px;left:339px;">
                    <img src="/img/0-ovtsa.png"  width="20" height="20">
                </div>
                <div style="position: absolute;top:187px;left:115px;">
                    <img src="/img/0-kamen.png"  width="20" height="20">
                </div>
                <div style="position: absolute;top:380px;left:477px;">
                    <img src="/img/0-glina.png"  width="20" height="20">
                </div>
                <div style="position: absolute;top:62px;left:192px;">
                    <img src="/img/0-3-1.png"  width="20" height="20">
                </div>
                <div style="position: absolute;top:454px;left:187px;">
                    <img src="/img/0-3-1.png"  width="20" height="20">
                </div>
                <div style="position: absolute;top:257px;left:550px;">
                    <img src="/img/0-3-1.png"  width="20" height="20">
                </div>
                <div style="position: absolute;top:136px;left:476px;">
                    <img src="/img/0-3-1.png"  width="20" height="20">
                </div>
            </div>





            <!--            Карты ресурсов игрока-->
            <div style="display: none">
            {{i=360}}
            {{b=90}}</div>
            <div style="position: absolute;top:600px;left:90px;">

                <div v-for="playercard in playercards">
<!--                Сыгранные рыцари-->
                    <div v-if="playercard.position_id==colors[0].id && playercard.type_res>10 && playercard.count_res>0">
                        <div   style="position: absolute;top:0px;left:-110px;">
                            <img src="/img/kart-knight.png"  width="80" height="120" style="filter: grayscale(80%); ">
                            <div style=" position: absolute;top:111px;left:25px;font-size: 49px;font-weight: bold;font-family: 'Monotype Corsiva';">{{playercard.count_res}}</div>
                        </div>
                    </div>
<!--                    Обычные ресурсы (дерево, глина...)-->
                    <div v-if="playercard.position_id==colors[0].id && playercard.type_res<6">
                        <div v-if="playercard.type_res==1" style="position: absolute;top:0px;left:0px;">

                            <img v-on:click.alt="delResFromPlayer(1)" v-on:dblclick="delResFromPlayer(1)" src="/img/kart-seno.png"  width="80" height="120">
                            <div style=" position: absolute;top:111px;left:25px;font-size: 49px;font-weight: bold;font-family: 'Monotype Corsiva';">{{playercard.count_res}}</div>

                        </div>
                        <div v-if="playercard.type_res==2" style="position: absolute;top:0px;left:90px;">
                            <img v-on:click.alt="delResFromPlayer(2)" v-on:dblclick="delResFromPlayer(2)" src="/img/kart-glina.png"  width="80" height="120">
                            <div style=" position: absolute;top:111px;left:25px;font-size: 49px;font-weight: bold;font-family: 'Monotype Corsiva';">{{playercard.count_res}}</div>
                        </div>
                        <div v-if="playercard.type_res==3" style="position: absolute;top:0px;left:180px;">
                            <img v-on:click.alt="delResFromPlayer(3)" v-on:dblclick="delResFromPlayer(3)" class="content_center" src="/img/kart-les.png"  width="80" height="120">
                            <div style=" position: absolute;top:111px;left:25px;font-size: 49px;font-weight: bold;font-family: 'Monotype Corsiva';">{{playercard.count_res}}</div>
                        </div>
                        <div  v-if="playercard.type_res==4" style="position: absolute;top:0px;left:270px;">
                            <img v-on:click.alt="delResFromPlayer(4)" v-on:dblclick="delResFromPlayer(4)" src="/img/kart-ovtsa.png"  width="80" height="120">
                            <div style=" position: absolute;top:111px;left:25px;font-size: 49px;font-weight: bold;font-family: 'Monotype Corsiva';">{{playercard.count_res}}</div>
                        </div>
                        <div  v-if="playercard.type_res==5" style="position: absolute;top:0px;left:360px;">
                            <img v-on:click.alt="delResFromPlayer(5)" v-on:dblclick="delResFromPlayer(5)" src="/img/kart-kamen.png"  width="80" height="120">
                            <div style=" position: absolute;top:111px;left:25px;font-size: 49px;font-weight: bold;font-family: 'Monotype Corsiva';">{{playercard.count_res}}</div>
                        </div>
                    </div>
<!--                    карты развития-->
                    <div v-if="playercard.position_id==colors[0].id && playercard.type_res>5 && playercard.type_res<11 && playercard.count_res>0">
<div style="display: none;">
                        {{i=b+i}}</div>
                        <div v-if="playercard.type_res==6" :style="'position: absolute;top:0px;left:'+ i +'px;'">
                            <img v-on:click.alt="delResFromPlayer(6)" v-on:dblclick="delResFromPlayer(6)" src="/img/kart-1poin-1.png"  width="80" height="120">
                            <div style=" position: absolute;top:111px;left:25px;font-size: 49px;font-weight: bold;font-family: 'Monotype Corsiva';">{{playercard.count_res}}</div>

                        </div>
                        <div v-if="playercard.type_res==7" :style="'position: absolute;top:0px;left:'+ i +'px;'">
                            <img v-on:click.alt="delResFromPlayer(7)" v-on:dblclick="delResFromPlayer(7)" src="/img/kart-monopolia.png"  width="80" height="120">
                            <div style=" position: absolute;top:111px;left:25px;font-size: 49px;font-weight: bold;font-family: 'Monotype Corsiva';">{{playercard.count_res}}</div>
                        </div>
                        <div v-if="playercard.type_res==8" :style="'position: absolute;top:0px;left:'+ i +'px;'">
                            <img v-on:click.alt="delResFromPlayer(8)" v-on:dblclick="delResFromPlayer(8)" class="content_center" src="/img/kart-proriv.png"  width="80" height="120">
                            <div style=" position: absolute;top:111px;left:25px;font-size: 49px;font-weight: bold;font-family: 'Monotype Corsiva';">{{playercard.count_res}}</div>
                        </div>
                        <div  v-if="playercard.type_res==9"  :style="'position: absolute;top:0px;left:'+ i +'px;'">
                            <img v-on:click.alt="delResFromPlayer(9)" v-on:dblclick="delResFromPlayer(9)" src="/img/kart-road.png"  width="80" height="120">
                            <div style=" position: absolute;top:111px;left:25px;font-size: 49px;font-weight: bold;font-family: 'Monotype Corsiva';">{{playercard.count_res}}</div>
                        </div>
                        <div  v-if="playercard.type_res==10"  :style="'position: absolute;top:0px;left:'+ i +'px;'">
                            <img v-on:click.alt="delResFromPlayer(10)" v-on:dblclick="delResFromPlayer(10)" src="/img/kart-knight.png"  width="80" height="120">
                            <div style=" position: absolute;top:111px;left:25px;font-size: 49px;font-weight: bold;font-family: 'Monotype Corsiva';">{{playercard.count_res}}</div>
                        </div>

                    </div>
                </div>
            </div>

<!--            твой цвет и кнопки управления-->
            <div v-if="colors[0]">
                <div style="position: absolute; left:-375px;top:-24px;">
                    <button class="btn" :style="'width: 100px;background:'+colors[0].color+';color:white;'">Твой цвет</button>
                    <!--кнопка ключения удаления строения-->
                    <button class="btn" v-if="statusDel==0" v-on:click="changeStatusDel()" style="background: #2fa360;position: absolute;left: 104px;top:2px;"></button>
                    <button class="btn" v-else v-on:click="changeStatusDel()" style="background: red;position: absolute;left: 104px;top:2px;"></button>
                    <!--Кнопка включения значков обмена ресурсов на карте-->
                    <button class="btn" v-if="statusTorg==0" v-on:click="changeStatusTorg()" style="background: red;position: absolute;left: 104px;top:20px;"></button>
                    <button class="btn" v-else v-on:click="changeStatusTorg()" style="background: #eadd3f;position: absolute;left: 104px;top:20px;"></button>

                </div>
            </div>

            <!--            Карты ресурсов других игроков -->
            <div style="position: absolute;top:0px;left:-300px;">
                <div style="display: none;">{{a=35}}</div>
                <div v-for="player in players">
                    <div v-if="player.position == 1 && player.position !=colors[0].id">

                                <div class="card" :style="'width: 360px;height: 140px;position: absolute;top:'+a+'px;left:-200px;'">
                                    <div style="display: none;">{{a=a+155}}</div>
                                        <div style="position: absolute;top:45px;left:10px;">
                                            <button class="btn" style="width: 130px;background:red;color:white;">{{player.user_name}}</button>
                                        </div>
                                        <div style="position: absolute;top:10px;left:220px;">
                                            <img src="/img/kart-back-res.png"  width="60" height="90">
                                            <div style="position: absolute;top:84px;left:20px;font-size: 32px;font-weight: bold;font-family: 'Monotype Corsiva';">{{ player1countcard }}</div>
                                        </div>
                                        <div   style="position: absolute;top:10px;left:150px;">
                                            <img src="/img/kart-back.png"  width="60" height="90">
                                            <div style="position: absolute;top:84px;left:20px;font-size: 32px;font-weight: bold;font-family: 'Monotype Corsiva';">{{ player1countcardrazv }}</div>
                                        </div>
                                        <div   style="position: absolute;top:10px;left:290px;">
                                            <img src="/img/kart-knight.png"  width="60" height="90" style="filter: grayscale(80%); ">
                                            <div style=" position: absolute;top:84px;left:20px;font-size: 32px;font-weight: bold;font-family: 'Monotype Corsiva';">{{ player1countcardknight}}</div>
                                        </div>
                                    <button class="btn" v-on:click="stealRes(1)" style="background: #2fa360;position: absolute;left: 65px;top:90px;"></button>
                                 </div>


                    </div>

                    <div v-if="player.position == 2 && player.position !=colors[0].id">
                        <div class="card" :style="'width: 360px;height: 140px;position: absolute;top:'+a+'px;left:-200px;'">
                            <div style="display: none;">{{a=a+155}}</div>

                            <div style="position: absolute;top:45px;left:10px;">
                                <button class="btn" style="width: 130px;background:green;color:white;">{{player.user_name}}</button>
                            </div>
                            <div style="position: absolute;top:10px;left:220px;">
                                <img src="/img/kart-back-res.png"  width="60" height="90">
                                <div style="position: absolute;top:84px;left:20px;font-size: 32px;font-weight: bold;font-family: 'Monotype Corsiva';">{{ player2countcard }}</div>
                            </div>
                            <div   style="position: absolute;top:10px;left:150px;">
                                <img src="/img/kart-back.png"  width="60" height="90">
                                <div style="position: absolute;top:84px;left:20px;font-size: 32px;font-weight: bold;font-family: 'Monotype Corsiva';">{{ player2countcardrazv }}</div>
                            </div>
                            <div   style="position: absolute;top:10px;left:290px;">
                                <img src="/img/kart-knight.png"  width="60" height="90" style="filter: grayscale(80%); ">
                                <div style=" position: absolute;top:84px;left:20px;font-size: 32px;font-weight: bold;font-family: 'Monotype Corsiva';">{{ player2countcardknight}}</div>
                            </div>
                            <button class="btn" v-on:click="stealRes(2)" style="background: #2fa360;position: absolute;left: 65px;top:90px;"></button>
                        </div>
                    </div>

                    <div v-if="player.position == 3 && player.position !=colors[0].id">
                        <div class="card" :style="'width: 360px;height: 140px;position: absolute;top:'+a+'px;left:-200px;'">
                            <div style="display: none;">
                                {{a=a+155}}
                            </div>

                            <div style="position: absolute;top:45px;left:10px;">
                                <button class="btn" style="width: 130px;background:orange;color:white;">{{player.user_name}}</button>
                            </div>
                            <div style="position: absolute;top:10px;left:220px;">
                                <img src="/img/kart-back-res.png"  width="60" height="90">
                                <div style="position: absolute;top:84px;left:20px;font-size: 32px;font-weight: bold;font-family: 'Monotype Corsiva';">{{ player3countcard }}</div>
                            </div>
                            <div   style="position: absolute;top:10px;left:150px;">
                                <img src="/img/kart-back.png"  width="60" height="90">
                                <div style="position: absolute;top:84px;left:20px;font-size: 32px;font-weight: bold;font-family: 'Monotype Corsiva';">{{ player3countcardrazv }}</div>
                            </div>
                            <div   style="position: absolute;top:10px;left:290px;">
                                <img src="/img/kart-knight.png"  width="60" height="90" style="filter: grayscale(80%); ">
                                <div style=" position: absolute;top:84px;left:20px;font-size: 32px;font-weight: bold;font-family: 'Monotype Corsiva';">{{ player3countcardknight}}</div>
                            </div>
                            <button class="btn" v-on:click="stealRes(3)" style="background: #2fa360;position: absolute;left: 65px;top:90px;"></button>
                        </div>
                    </div>

                    <div v-if="player.position == 4 && player.position !=colors[0].id">
                        <div class="card" :style="'width: 360px;height: 140px;position: absolute;top:'+a+'px;left:-200px;'">
                            <div style="display: none;">{{a=a+155}}</div>

                            <div style="position: absolute;top:45px;left:10px;">
                                <button class="btn" style="width: 130px;background:blue;color:white;">{{player.user_name}}</button>
                            </div>
                            <div style="position: absolute;top:10px;left:220px;">
                                <img src="/img/kart-back-res.png"  width="60" height="90">
                                <div style="position: absolute;top:84px;left:20px;font-size: 32px;font-weight: bold;font-family: 'Monotype Corsiva';">{{ player4countcard }}</div>
                            </div>
                            <div   style="position: absolute;top:10px;left:150px;">
                                <img src="/img/kart-back.png"  width="60" height="90">
                                <div style="position: absolute;top:84px;left:20px;font-size: 32px;font-weight: bold;font-family: 'Monotype Corsiva';">{{ player4countcardrazv }}</div>
                            </div>
                            <div   style="position: absolute;top:10px;left:290px;">
                                <img src="/img/kart-knight.png"  width="60" height="90" style="filter: grayscale(80%); ">
                                <div style=" position: absolute;top:84px;left:20px;font-size: 32px;font-weight: bold;font-family: 'Monotype Corsiva';">{{ player4countcardknight}}</div>
                            </div>
                            <button class="btn" v-on:click="stealRes(4)" style="background: #2fa360;position: absolute;left: 65px;top:90px;"></button>
                        </div>
                    </div>
                </div>
            </div>

            <!--         стартовая загрузка Дорог-->
            <div v-for="building in buildings">
                <div v-if="building.element_type_id == 4 && building.status == 1" >
                    <div style="display: none">
                        {{a=building.coordinate_top-45}}
                        {{b=building.coordinate_left+8}}
                        {{coordMenuTop=building.coordinate_top+9}}
                        {{coordMenuLeft=building.coordinate_left+27}}
                    </div>
                    <!--                    Элемент div, в котором появляется элемент-->
                    <div :id="'RoadVertical'+building.number" :style="'position: absolute; top:'+ a +'px; left:'+ b +'px;'">
                        <div id="RoadVertical" style="position: absolute;  height: 100px; width: 100px;">
                        <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                             <path
                                 :style="'fill:' + building.color1_element + ';stroke:;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'"
                                  d="m 2.9864819,36.789501 0.074905,43.339124 4.0360704,-0.04388 -0.529661,-43.220339 z"
                                  id="path530"
                                  inkscape:connector-curvature="0"
                                  sodipodi:nodetypes="ccccc" />
                              <path
                                  :style="'fill:' + building.color2_element + ';stroke:;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'"
                                  d="M 6.5677966,36.864407 8.5805085,39.40678 8.7923729,81.461865 7.0974576,80.084746 Z"
                                  id="path534"
                                   inkscape:connector-curvature="0"
                                   sodipodi:nodetypes="ccccc" />
                              <path
                                   :style="'fill:' + building.color2_element + ';stroke:;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'"
                                   d="m 3.0613872,80.128625 1.7449239,1.545104 3.9860618,-0.211864 -1.6949153,-1.377119 -4.0360704,0.04388"
                                   id="path536"
                                   inkscape:connector-curvature="0"
                                   sodipodi:nodetypes="ccccc" />
                           </svg>
                          </div>
                    </div>
                </div>


                <div v-if="building.element_type_id==5 && building.status == 1" >
                    <!--                    расчет координат появления элемента-->
                    <div style="display: none">
                        {{a=building.coordinate_top-6}}
                        {{b=building.coordinate_left-9}}
                        {{coordMenuTop=building.coordinate_top+9}}
                        {{coordMenuLeft=building.coordinate_left+27}}
                    </div>
                    <!--                    Элемент div, в котором появляется элемент-->
                    <div :id="'RoadLeftUp'+building.number" :style="'position: absolute; top:'+ a +'px; left:'+ b +'px;'">
                             <div id="doroga2" style="position: absolute;  height: 100px; width: 100px;">
                          <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                          <path
                          :style="'fill:' + building.color1_element + ';stroke:;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'"
                          d="M 9.7408179,30.455222 45.018133,11.386936 45.040072,7.8422393 9.8157223,25.851204 Z"
                          id="path512"
                          inkscape:connector-curvature="0"
                          sodipodi:nodetypes="ccccc" />
                          <path
                          :style="'fill:' + building.color2_element + ';stroke:;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'"
                          d="m 9.7408179,30.455222 -4.1727626,0.05673 0.05297,-4.339187 4.194697,-0.32156 z"
                          id="path514"
                          inkscape:connector-curvature="0"
                            sodipodi:nodetypes="ccccc" />
                           <path
                          :style="'fill:' + building.color3_element + ';stroke:;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'"
                          d="M 5.6210257,26.172764 40.462213,8.1985911 45.040072,7.8422393 9.8157227,25.851204 Z"
                          id="path518"
                         inkscape:connector-curvature="0"
                           sodipodi:nodetypes="ccccc" />
                           </svg>
                         </div>

                    </div>

                </div>

                <div v-if="building.element_type_id==6 && building.status == 1" >
                    <!--                    расчет координат появления элемента-->
                    <div style="display: none">
                        {{a=building.coordinate_top-6}}
                        {{b=building.coordinate_left-57}}
                        {{coordMenuTop=building.coordinate_top+9}}
                        {{coordMenuLeft=building.coordinate_left+27}}
                    </div>
                    <!--                    Элемент div, в котором появляется элемент-->
                    <div :id="'RoadLeftDown'+building.number" :style="'position: absolute; top:'+ a +'px; left:'+ b +'px;'">
                            <div id="doroga3" style="position: absolute; height: 100px; width: 100px;">
                               <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                             <path
                             :style="'fill:' + building.color1_element + ';stroke:;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'"
                            d="M 53.182819,11.31203 89.212307,30.038375 89.362122,25.768769 53.107919,7.8663832 Z"
                            id="path520"
                            inkscape:connector-curvature="0"
                           sodipodi:nodetypes="ccccc" />
                           <path
                         :style="'fill:' + building.color3_element + ';stroke:;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'"
                          d="m 53.107919,7.8663832 36.254203,17.9023858 3.670354,0.22472 c -35.879671,-18.2769165 0,0 -35.879671,-18.2769165 z"
                          id="path524"
                          inkscape:connector-curvature="0"
                         sodipodi:nodetypes="ccccc" />
                         <path
                         :style="'fill:' + building.color2_element + ';stroke:;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'"
                         d="m 89.212307,30.038375 3.745269,0.299623 0.0749,-4.344509 -3.670354,-0.22472 z"
                         id="path528"
                         inkscape:connector-curvature="0"
                         sodipodi:nodetypes="ccccc" />
                         </svg>
                         </div>

                    </div>

                </div>
            </div>










            <!--         кнопки для дороги вертикальной-->
            <div v-for="(coordinate) in coordinates"
                 :class="'typeRoad'+coordinate.element_type_id+'-'+coordinate.number"
                 v-if="coordinate.element_type_id==4" >
                <!--                    расчет координат появления элемента-->
                <div style="display: none">
                    {{a=coordinate.coordinate_top-45}}
                    {{b=coordinate.coordinate_left+8}}
                    {{coordMenuTop=coordinate.coordinate_top+9}}
                    {{coordMenuLeft=coordinate.coordinate_left+27}}
                </div>
                <!--                    Элемент div, в котором появляется элемент-->
                <div :id="'RoadVertical'+coordinate.number" :style="'position: absolute; top:'+ a +'px; left:'+ b +'px;'"></div>

                <div :id="'MenuRoadVertical'+coordinate.number"  :style="'z-index: 100;display:none; position: absolute; top:'+ coordMenuTop +'px; left:'+ coordMenuLeft +'px;'">
                    <button class="btn btn-success" v-on:click="addRoadVertical(coordinate.number),addBuildingToDb(4,coordinate.number,1,coordinate.coordinate_top,coordinate.coordinate_left)" style="width: 100px; ">Дорога</button>
                    <button class="btn btn-danger" v-on:click="closeMenuRoadVertical(coordinate.number)" style="width: 100px;">Закрыть</button>
                    <button v-if="statusDel==1" class="btn" v-on:click="delroad(4,coordinate.number),delBuildingFromDb(4,coordinate.number,1,coordinate.coordinate_top,coordinate.coordinate_left)" style="width: 100px;background: #1b1e21;color: white;">Удалить</button>
                </div>

                <!--              кнопка для вызова меню постройки -->
                <button v-on:click="openMenuRoadVertical(coordinate.number)"  class="button_active" :id="'button_active_road'+coordinate.number" :style="'z-index: 99; position: absolute; top:'+ coordinate.coordinate_top +'px; left:'+ coordinate.coordinate_left +'px; height: 30px; width: 30px; border-radius: 30px; color: transparent;background-color: transparent; border-color: transparent; cursor: pointer;'"></button>
            </div>




            <!--         кнопки для дороги ЛевоНиз-ПравоВерх 5-->
            <div v-for="(coordinate) in coordinates"
                 :class="'typeRoadLeftUp'+coordinate.element_type_id+'-'+coordinate.number"
                 v-if="coordinate.element_type_id==5" >
                <!--                    расчет координат появления элемента-->
                <div style="display: none">
                    {{a=coordinate.coordinate_top-6}}
                    {{b=coordinate.coordinate_left-9}}
                    {{coordMenuTop=coordinate.coordinate_top+9}}
                    {{coordMenuLeft=coordinate.coordinate_left+27}}
                </div>
                <!--                    Элемент div, в котором появляется элемент-->
                <div :id="'RoadLeftUp'+coordinate.number" :style="'position: absolute; top:'+ a +'px; left:'+ b +'px;'"></div>

                <div :id="'MenuRoadLeftUp'+coordinate.number"  :style="'z-index: 100;display:none; position: absolute; top:'+ coordMenuTop +'px; left:'+ coordMenuLeft +'px;'">
                    <button class="btn btn-success" v-on:click="addRoadLeftUp(coordinate.number),addBuildingToDb(5,coordinate.number,1,coordinate.coordinate_top,coordinate.coordinate_left)" style="width: 100px; ">Дорога</button>
                    <button class="btn btn-danger" v-on:click="closeMenuRoadLeftUp(coordinate.number)" style="width: 100px;">Закрыть</button>
                    <button v-if="statusDel==1" class="btn" v-on:click="delroad(5,coordinate.number),delBuildingFromDb(5,coordinate.number,1,coordinate.coordinate_top,coordinate.coordinate_left)" style="width: 100px;background: #1b1e21;color: white;">Удалить</button>
                </div>

                <!--              кнопка для вызова меню постройки -->
                <button v-on:click="openMenuRoadLeftUp(coordinate.number)"  class="button_active" :id="'button_active_road'+coordinate.number" :style="'z-index: 99; position: absolute; top:'+ coordinate.coordinate_top +'px; left:'+ coordinate.coordinate_left +'px; height: 30px; width: 30px; border-radius: 30px; color: transparent;background-color: transparent; border-color: transparent; cursor: pointer;'"></button>
            </div>



            <!--         кнопки для дороги ЛевоВерх->ПравоНиз 6-->
            <div v-for="(coordinate) in coordinates"
                 :class="'typeRoadLeftDown'+coordinate.element_type_id+'-'+coordinate.number"
                 v-if="coordinate.element_type_id==6" >
                <!--                    расчет координат появления элемента-->
                <div style="display: none">
                    {{a=coordinate.coordinate_top-6}}
                    {{b=coordinate.coordinate_left-57}}
                    {{coordMenuTop=coordinate.coordinate_top+9}}
                    {{coordMenuLeft=coordinate.coordinate_left+27}}
                </div>
                <!--                    Элемент div, в котором появляется элемент-->
                <div :id="'RoadLeftDown'+coordinate.number" :style="'position: absolute; top:'+ a +'px; left:'+ b +'px;'"></div>

                <div :id="'MenuRoadLeftDown'+coordinate.number"  :style="'z-index: 100;display:none; position: absolute; top:'+ coordMenuTop +'px; left:'+ coordMenuLeft +'px;'">
                    <button class="btn btn-success" v-on:click="addRoadLeftDown(coordinate.number),addBuildingToDb(6,coordinate.number,1,coordinate.coordinate_top,coordinate.coordinate_left)" style="width: 100px; ">Дорога</button>
                    <button class="btn btn-danger" v-on:click="closeMenuRoadLeftDown(coordinate.number)" style="width: 100px;">Закрыть</button>
                    <button v-if="statusDel==1" class="btn" v-on:click="delroad(6,coordinate.number),delBuildingFromDb(6,coordinate.number,1,coordinate.coordinate_top,coordinate.coordinate_left)" style="width: 100px;background: #1b1e21;color: white;">Удалить</button>
                </div>

                <!--              кнопка для вызова меню постройки -->
                <button v-on:click="openMenuRoadLeftDown(coordinate.number)"  class="button_active" :id="'button_active_road'+coordinate.number" :style="'z-index: 99; position: absolute; top:'+ coordinate.coordinate_top +'px; left:'+ coordinate.coordinate_left +'px; height: 30px; width: 30px; border-radius: 30px; color: transparent;background-color: transparent; border-color: transparent; cursor: pointer;'"></button>
            </div>




            <!--         стартовая загрузка строений (поселения)-->
            <div v-for="building in buildings">



            </div>



            <!--         стартовая загрузка строений (города)-->
            <div v-for="building in buildings">
                <div v-if="building.element_type_id == 3">


                    <div v-if="building.status == 2" >
                        <div style="display: none">
                            {{a=building.coordinate_top-20}}
                            {{b=building.coordinate_left-60}}
                            {{coordMenuTop=building.coordinate_top+9}}
                            {{coordMenuLeft=building.coordinate_left+27}}
                        </div>
                        <div :id="'startCity'+building.number" :style="'position: absolute; top:'+ a +'px; left:'+ b +'px;'">
                            <div id="123" style=" height: 100px; width: 100px;">
                                <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <path :style="'fill:'+building.color1_element + ';stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'"
                                          d="m 77.563864,44.025829 c 1.495732,1.791319 3.121698,1.889589 4.899876,0.0091 l -0.03479,-16.893823 -2.318303,-7.084984 -2.537696,7.084984 z"
                                          id="path310-2" inkscape:connector-curvature="0" sodipodi:nodetypes="cccccc" />
                                    <path :style="'fill:'+building.color2_element + ';stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'"
                                          d="m 77.572951,27.141106 c 1.773969,2.25189 3.363899,1.835207 4.855999,0 l -2.318303,-7.084984 z"
                                          id="path312-8" inkscape:connector-curvature="0" sodipodi:nodetypes="cccc" />
                                    <path :style="'fill:'+building.color1_element + ';stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'" d="m 63.182031,43.950924 c 1.495732,1.791319 3.121698,1.889589 4.899876,0.0091 l -0.03479,-16.893823 -2.318303,-7.084984 -2.537696,7.084984 z"
                                          id="path310-4" inkscape:connector-curvature="0" sodipodi:nodetypes="cccccc" />
                                    <path :style="'fill:'+building.color2_element + ';stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'" d="m 63.191118,27.066201 c 1.773969,2.25189 3.363899,1.835207 4.855999,0 l -2.318303,-7.084984 z"
                                          id="path312-1" inkscape:connector-curvature="0" sodipodi:nodetypes="cccc" />
                                    <path :style="'fill:'+building.color1_element + ';stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'" d="m 84.268552,24.383022 5.001267,0.02306 -0.199745,-6.556797 -2.318303,-7.084984 -2.537696,7.084984 z"
                                          id="path310-2-3" inkscape:connector-curvature="0" sodipodi:nodetypes="cccccc" />
                                    <path :style="'fill:'+building.color2_element + ';stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'" d="m 84.214075,17.849283 c 1.773969,2.25189 3.363899,1.835207 4.855999,0 l -2.318303,-7.084984 z"
                                          id="path312-8-9" inkscape:connector-curvature="0" sodipodi:nodetypes="cccc" />
                                    <path :style="'fill:'+building.color1_element + ';stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'" d="m 69.662004,24.645188 5.061026,-0.01431 -0.03475,-6.856502 -2.318303,-7.084984 -2.537696,7.084984 z"
                                          id="path310-4-2" inkscape:connector-curvature="0" sodipodi:nodetypes="cccccc" />
                                    <path :style="'fill:'+building.color2_element + ';stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'" d="m 69.832242,17.774378 c 1.773969,2.25189 3.363899,1.835207 4.855999,0 l -2.318303,-7.084984 z"
                                          id="path312-1-1" inkscape:connector-curvature="0" sodipodi:nodetypes="cccc" />
                                    <path :style="'fill:'+building.color1_element + ';stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'" d="m 68.081907,43.960024 9.481957,0.06581 -0.02149,-10.842566 -9.528574,0.0045 0.06811,10.772217"
                                          id="path402" inkscape:connector-curvature="0" sodipodi:nodetypes="ccccc" />
                                    <path :style="'fill:'+building.color2_element + ';stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'" d="m 82.46374,44.034929 6.940746,-8.243148 -0.134667,-11.385699 -6.811794,7.529819 z"
                                          id="path404" inkscape:connector-curvature="0" sodipodi:nodetypes="ccccc" />
                                    <path  :style="'fill:'+building.color3_element + ';stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'" d="m 68.013798,33.187812 0.03332,-6.121611 1.614886,-2.421013 h 8.726476 l -0.815528,2.495918 -0.03058,6.042162 z"
                                           id="path408" inkscape:connector-curvature="0" sodipodi:nodetypes="ccccccc" />
                                    <path :style="'fill:'+building.color3_element + ';stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'" d="m 81.422148,24.420472 2.846404,-0.03745 5.001267,0.02306 -6.811794,7.529819 -0.02908,-4.794792 z"
                                          id="path410" inkscape:connector-curvature="0" sodipodi:nodetypes="cccccc" />
                                </svg>
                            </div>

                        </div>
                    </div>

                    <div v-else-if="building.status == 1">
                        <div style="display: none">
                            {{a=building.coordinate_top-55}}
                            {{b=building.coordinate_left-15}}
                            {{coordMenuTop=building.coordinate_top+9}}
                            {{coordMenuLeft=building.coordinate_left+27}}
                        </div>
                        <div :id="'start'+building.number" :style="'position: absolute; top:'+ a +'px; left:'+ b +'px;'">
                            <div id="123" style=" height: 100px; width: 100px;">
                                <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        :style="'fill:' + building.color1_element + ';stroke:#000000;stroke-width:0.5px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'"
                                        d="m 27.542373,83.262712 -0.05297,-11.28178 15.889831,-10.275423 0.05297,11.175847 z"
                                        id="path188"
                                        inkscape:connector-curvature="0"
                                        sodipodi:nodetypes="ccccc" />
                                    <path
                                        :style="'fill:' + building.color2_element + ';stroke:#000000;stroke-width:0.5px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'"
                                        d="m 43.379234,61.705509 -4.766946,-8.474577 -15.042372,9.216103 3.919487,9.533897 z"
                                        id="path190"
                                        inkscape:connector-curvature="0"
                                        sodipodi:nodetypes="ccccc" />
                                    <path
                                        :style="'fill:' + building.color3_element + ';stroke:#000000;stroke-width:0.5px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1'"
                                        d="M 27.542373,83.262712 19.491525,79.872881 V 68.697034 l 4.078391,-6.249999 3.919487,9.533897 z"
                                        id="path192"
                                        inkscape:connector-curvature="0"
                                        sodipodi:nodetypes="cccccc" />
                                </svg>
                            </div>

                        </div>
                    </div>

                </div>
            </div>



            <!--         кнопки для города/поселения-->
            <div v-for="(coordinate,index) in coordinates"
                 :class="'type'+coordinate.element_type_id+'-'+coordinate.number"
                 v-if="coordinate.element_type_id==3" :key="coordinate.number">
                <!--                    расчет координат появления элемента-->
                <div style="display: none">
                    {{a=coordinate.coordinate_top-55}}
                    {{b=coordinate.coordinate_left-15}}
                    {{coordMenuTop=coordinate.coordinate_top+9}}
                    {{coordMenuLeft=coordinate.coordinate_left+27}}
                </div>
                <!--                    Элемент div, в котором появляется элемент города или поселения-->
                <div :id="coordinate.number" :style="'position: absolute; top:'+ a +'px; left:'+ b +'px;'"></div>

                <div :id="'menu'+coordinate.number"  :style="'z-index: 100;display:none; position: absolute; top:'+ coordMenuTop +'px; left:'+ coordMenuLeft +'px;'">
                    <button class="btn btn-success" v-on:click="addCity(coordinate.number),addBuildingToDb(3,coordinate.number,2,coordinate.coordinate_top,coordinate.coordinate_left)" style="width: 100px; ">Город</button>
<!--                    addBuildingToDb(3 - тип элемента,coordinate.number,1 - поселение (2 для города))-->
                    <button class="btn btn-primary" v-on:click="addVillage(coordinate.number),addBuildingToDb(3,coordinate.number,1,coordinate.coordinate_top,coordinate.coordinate_left)">Поселение</button>
                    <button class="btn btn-danger" v-on:click="closeMenu(coordinate.number)" style="width: 100px;">Закрыть</button>
                    <button v-if="statusDel==1" class="btn" v-on:click="addVillage(coordinate.number),addCity(coordinate.number),delBuildingFromDb(3,coordinate.number,1,coordinate.coordinate_top,coordinate.coordinate_left)" style="width: 100px;background: #1b1e21;color: white;">Удалить</button>

                </div>

                <!--              кнопка для вызова меню постройки поселения или города-->
                <button v-on:click="openMenu(coordinate.number)"  class="button_active" :id="'button_active'+coordinate.number" :style="'z-index: 99; position: absolute; top:'+ coordinate.coordinate_top +'px; left:'+ coordinate.coordinate_left +'px; height: 30px; width: 30px; border-radius: 30px; color: transparent;background-color: transparent; border-color: transparent; cursor: pointer;color:black;'"></button>
            </div>













        </div>


    </div>
</template>

<script>
    export default {
        props:
            ['user','item'],



        data() {
            return {
                coordinates: [],
                positions: [],
                townText: [],
                textRes: [],
                statusOK: [],
                colors: [],
                buildings: [],
                playercards: [],
                statusDel: '0',
                statusTorg: '0',
                player1countcard: 0,
                player1countcardrazv: 0,
                player1countcardknight: 0,
                player2countcard: 0,
                player3countcard: 0,
                player4countcard: 0,
                player2countcardrazv: 0,
                player3countcardrazv: 0,
                player4countcardrazv: 0,
                player2countcardknight: 0,
                player3countcardknight: 0,
                player4countcardknight: 0,

                knightPosition: 0,
                dice_one: 0,
                dice_two: 0,
                dice_both: 0,
                // карты на столе
                table_card_one: 0,
                table_card_two: 0,
                table_card_tree: 0,
                table_card_four: 0,
                table_card_five: 0,
                table_card_dev: 0,

                players: [],
                status_dice_rest_to_player: 0,


            }
        },

        created() {

            this.fetchCoordinate();
            this.fetchPosition();
            this.fetchPlayerColors();
            this.fetchBuildings();
            this.fetchPlayerCards();
            this.fetchKnightPosition();
            this.fetchPlayers();


            Echo.join('catan-playercard')
                .listen('CatanPlayerCardToDb', (event) => {
                    console.log('Карточки');
                    console.log(event.playerCard);
                    var k=1;

                    // убираем кнопку после раздачи ресурсов
                    if(event.playerCard.number_geks){
                        console.log('status_dice_rest_to_player');
                        console.log(event.playerCard);
                        console.log('status_dice_rest_to_player');
                          this.status_dice_rest_to_player = 0;
                    }


                    if(event.playerCard.game_number == this.item.game_number){

                        //добавляем количиство карт локального пользователя
                        console.log(event.playerCard);
                        for(var i=0;i<this.playercards.length;i++) {
                            if(this.playercards[i].position_id==event.playerCard.position_id && this.playercards[i].type_res==event.playerCard.type_res)
                            {
                                if(this.playercards[i].count_res>event.playerCard.count_res){
                                    k=-1;
                                }
                                this.playercards[i].count_res = event.playerCard.count_res;
                            }
                        }


                        if(event.playerCard.position_id==1 && event.playerCard.type_res<6){
                            this.player1countcard = this.player1countcard +k;
                        }
                        if(event.playerCard.position_id==2 && event.playerCard.type_res<6){
                            this.player2countcard = this.player2countcard +k;
                        }
                        if(event.playerCard.position_id==3 && event.playerCard.type_res<6){
                            this.player3countcard = this.player3countcard +k;
                        }
                        if(event.playerCard.position_id==4 && event.playerCard.type_res<6){
                            this.player4countcard = this.player4countcard +k;
                        }
                        if(event.playerCard.position_id==1 && event.playerCard.type_res>5 && event.playerCard.type_res<11){
                            this.player1countcardrazv = this.player1countcardrazv +k;
                        }
                        if(event.playerCard.position_id==2 && event.playerCard.type_res>5 && event.playerCard.type_res<11){
                            this.player2countcardrazv = this.player2countcardrazv +k;
                        }
                        if(event.playerCard.position_id==3 && event.playerCard.type_res>5 && event.playerCard.type_res<11){
                            this.player3countcardrazv = this.player3countcardrazv +k;
                        }
                        if(event.playerCard.position_id==4 && event.playerCard.type_res>5 && event.playerCard.type_res<11){
                            this.player4countcardrazv = this.player4countcardrazv +k;
                        }
                        if(event.playerCard.position_id==1 && event.playerCard.type_res>10){
                            this.player1countcardknight = this.player1countcardknight +k;
                        }
                        if(event.playerCard.position_id==2 && event.playerCard.type_res>10){
                            this.player2countcardknight = this.player2countcardknight +k;
                        }
                        if(event.playerCard.position_id==3 && event.playerCard.type_res>10){
                            this.player3countcardknight = this.player3countcardknight +k;
                        }
                        if(event.playerCard.position_id==4 && event.playerCard.type_res>10){
                            this.player4countcardknight = this.player4countcardknight +k;
                        }






                    }

                });


            Echo.join('catan-building')
                .listen('CatanBuildingToDb', (event) =>{
                    //  if(document.getElementById('start' + event.building.number && event.building.element_type_id==3 && event.building.status==1)){
                    //      document.getElementById('start' + event.building.number).innerHTML ='';
                    //  }
                    // if(document.getElementById('startCity' + event.building.number && event.building.status==2)){
                    //     document.getElementById('startCity' + event.building.number).innerHTML ='';
                    // }

                    // if(document.getElementById('start' + event.building.number)){
                    //
                    //     document.getElementById('start' + event.building.number).innerHTML ='';
                    // }
                    // if(document.getElementById('startCity' + event.building.number)){
                    //     document.getElementById('startCity' + event.building.number).innerHTML ='';
                    //
                    // }

                    // console.log('БРЕД!!');
                    // console.log(event.building);
                    //







                    if(event.building.game_number == this.item.game_number){
                        this.buildings.push(event.building);
                        if(event.building.element_type_id==3){
                            if(event.building.status == 2){
                                document.getElementById('start' + event.building.number).innerHTML ='';
                            }
                            else{
                                document.getElementById('startCity' + event.building.number).innerHTML ='';
                            }

                        }

                        //переставляем рыцаря
                        if(event.building.position_knight>0 && event.building.position_knight < 20){
                            this.knightPosition = event.building.position_knight;
                            console.log('БРЕД Рыцарь');
                            console.log(event.building);
                        }

                        //кидаем кубики
                        if(event.building.dice_one){
                            this.dice_one = event.building.dice_one;
                            this.dice_two = event.building.dice_two;
                            this.dice_both = this.dice_one + this.dice_two;
                            this.table_card_one = event.building.count_card_one;
                            this.table_card_two = event.building.count_card_two;
                            this.table_card_tree = event.building.count_card_tree;
                            this.table_card_four = event.building.count_card_four;
                            this.table_card_five = event.building.count_card_five;
                            this.table_card_dev = event.building.card_dev_type;
                            this.status_dice_rest_to_player = 1;
                        }


                        //добавляем игроков при выборе цвета
                        if(event.building.user_name){
                            console.log('Ахтунг!!');
                            console.log(event.building);
                            console.log( this.players);
                            this.players.push(event.building);

                            console.log( this.players);
                        }
                    }





                    console.log('Заработало!');
                    console.log(event);
                })


        },

        methods: {


            //получаем координаты всех элементов
            fetchCoordinate() {
                axios.get('/games/coordinateelements').then(response =>{
                    this.coordinates = response.data;
                    console.log(this.item.game_number);
                    console.log('мои данные');
                    console.log(this.colors);
                    console.log('мои данные');
                })
            },
            //получаем расположение гексов
            fetchPosition() {
                axios.get('/games/cardposition/'+this.item.game_number).then(response =>{
                    this.positions = response.data;

                })
            },
            //получаем цвета игроков
            fetchPlayerColors() {
                axios.get('/games/playercolor/'+this.item.game_number).then(response =>{
                    this.colors = response.data;
                    console.log('Цвета игроков');
                    console.log(this.colors);
                })
            },
            //получаем данные о построенных дорогах/городах/поселениях игроками в игре
            fetchBuildings(){
                axios.get('/games/buildings/'+this.item.game_number).then(response =>{
                    this.buildings = response.data;
                    console.log('Строения');
                    console.log(this.buildings);
                })
            },
            //получаем данные о картах игроков
            fetchPlayerCards(){
                axios.get('/games/playercards/'+this.item.game_number).then(response =>{
                    this.playercards = response.data;
                    console.log('Карты');
                    console.log(this.playercards);
                    // считаем количество карт на руках
                    for(var i=0;i<this.playercards.length;i++){
                        if(this.playercards[i].position_id==1){
                            if(this.playercards[i].type_res<6){
                                this.player1countcard = this.player1countcard+this.playercards[i].count_res;
                            }
                            if(this.playercards[i].type_res>5 && this.playercards[i].type_res<11){
                                this.player1countcardrazv = this.player1countcardrazv+this.playercards[i].count_res;
                            }
                            if(this.playercards[i].type_res>10){
                                this.player1countcardknight = this.player1countcardknight+this.playercards[i].count_res;
                            }
                        }
                        if(this.playercards[i].position_id==2){
                            if(this.playercards[i].type_res<6){
                                this.player2countcard = this.player2countcard+this.playercards[i].count_res;
                            }
                            if(this.playercards[i].type_res>5 && this.playercards[i].type_res<11){
                                this.player2countcardrazv = this.player2countcardrazv+this.playercards[i].count_res;
                            }
                            if(this.playercards[i].type_res>10){
                                this.player2countcardknight = this.player2countcardknight+this.playercards[i].count_res;
                            }
                        }
                        if(this.playercards[i].position_id==3){
                            if(this.playercards[i].type_res<6){
                                this.player3countcard = this.player3countcard+this.playercards[i].count_res;
                            }
                            if(this.playercards[i].type_res>5 && this.playercards[i].type_res<11){
                                this.player3countcardrazv = this.player3countcardrazv+this.playercards[i].count_res;
                            }
                            if(this.playercards[i].type_res>10){
                                this.player3countcardknight = this.player3countcardknight+this.playercards[i].count_res;
                            }
                        }
                        if(this.playercards[i].position_id==4){
                            if(this.playercards[i].type_res<6){
                                this.player4countcard = this.player4countcard+this.playercards[i].count_res;
                            }
                            if(this.playercards[i].type_res>5 && this.playercards[i].type_res<11){
                                this.player4countcardrazv = this.player4countcardrazv+this.playercards[i].count_res;
                            }
                            if(this.playercards[i].type_res>10){
                                this.player4countcardknight = this.player4countcardknight+this.playercards[i].count_res;
                            }
                        }
                    }
                })
            },

            //получить местоположение рыцаря
            fetchKnightPosition(){
                axios.get('/games/getknightposition/'+this.item.game_number).then(response =>{
                    console.log(response.data[0].position_knight);
                    this.knightPosition = response.data[0].position_knight;
                    console.log('Цвета местоположение рыцаря');
                    //console.log(this.knightPosition);
                })
            },
            //получить всех игроков игры
            fetchPlayers(){
                axios.get('/games/getplayers/'+this.item.game_number).then(response =>{
                    console.log('Все игроки');
                    this.players = response.data;
                    console.log(this.players);
                  //  this.knightPosition = response.data[0].position;
                    console.log('Все игроки');
                    //console.log(this.knightPosition);
                })
            },



            addTown(id){

                this.textRes[0]='sdfsdfsfd1';
                this.textRes[1]='sdfsdfsfd2';
                this.textRes[id]='sdfsdfsfd';
                console.log(this.textRes[1]);

                document.getElementById(id).innerHTML('dddd');
                alert('hello');
            },
            openMenu: function(id){
                document.getElementById('menu'+id).style.display = 'block';
            //    document.getElementById('button_active'+id).style.borderColor = 'red';
            },
            openMenuRoadVertical: function(id){
                document.getElementById('MenuRoadVertical'+id).style.display = 'block';
                //    document.getElementById('button_active'+id).style.borderColor = 'red';
            },
            openMenuRoadLeftUp: function(id){
                document.getElementById('MenuRoadLeftUp'+id).style.display = 'block';
                //    document.getElementById('button_active'+id).style.borderColor = 'red';
            },
            openMenuRoadLeftDown: function(id){
                document.getElementById('MenuRoadLeftDown'+id).style.display = 'block';
                //    document.getElementById('button_active'+id).style.borderColor = 'red';
            },



            closeMenu: function(id){
                document.getElementById('menu'+id).style.display = 'none';
               // document.getElementById(id).innerHTML = "";
              //  document.getElementById('button_active'+id).style.background = 'transparent';
            },
            closeMenuRoadVertical: function(id){
                document.getElementById('MenuRoadVertical'+id).style.display = 'none';
            },
            closeMenuRoadLeftUp: function(id){
                document.getElementById('MenuRoadLeftUp'+id).style.display = 'none';
            },
            closeMenuRoadLeftDown: function(id){
                document.getElementById('MenuRoadLeftDown'+id).style.display = 'none';
            },


            addVillage: function(id){
               // document.getElementById(id).innerHTML ='';


                    document.getElementById('menu'+id).style.display = 'none';
                if(document.getElementById('start' + id)){

                    document.getElementById('start' + id).innerHTML ='';
                }
                if(document.getElementById('startCity' + id)){
                    document.getElementById('startCity' + id).innerHTML ='';

                }

            },

            addCity: function(id) {

                document.getElementById('menu' + id).style.display = 'none';
                if(document.getElementById('start' + id)){

                    document.getElementById('start' + id).innerHTML ='';
                }
                if(document.getElementById('startCity' + id)){
                    document.getElementById('startCity' + id).innerHTML ='';

                }

            },

            addRoadVertical: function(id){


                document.getElementById('MenuRoadVertical' + id).style.display = 'none';
            },

            addRoadLeftUp: function(id){

                document.getElementById('MenuRoadLeftUp' + id).style.display = 'none';
            },

            addRoadLeftDown: function(id){

                document.getElementById('MenuRoadLeftDown' + id).style.display = 'none';
            },


            //игрок выбирает цвет
            ChoseColor(color,color_id){
             //   alert(color);

              // axios.post('color',{color: color});
                console.log('бляяя');
                 axios.post('color',{game_number: this.item.game_number, color: color, color_id:color_id});
               console.log({game_number: this.item, user: this.user, color: color, color_id:color_id});
                console.log('бляяя');
               // fetchPlayerColors();
                axios.get('/games/playercolor/'+this.item.game_number).then(response =>{
                    this.colors = response.data;
                    console.log(this.colors[0].color);
                })
            },
            //добавляем данные по строительству дороги или города или поселения в базу
            addBuildingToDb(type_id,id,typeCityOrVillege,coordinate_top,coordinate_left){
                // console.log('Id игры');
                // console.log(this.item.game_number);
                //
                // console.log('ID цвета');
                // console.log(this.colors[0].id);
                // console.log('ID элемента');
                // console.log(id);
                //
                // console.log('Тип (дорога/город/поселение)');
                // console.log(type_id);
                // console.log('typeCityOrVillege');
                // console.log(typeCityOrVillege);
                // console.log('this.buildings');
                // console.log(this.buildings);
                this.buildings.push({
                    user: this.user,
                    color1_element: this.colors[0].color1_element,
                    color2_element: this.colors[0].color2_element,
                    color3_element: this.colors[0].color3_element,
                    number: id,
                    element_type_id: type_id,
                    coordinate_top: coordinate_top,
                    coordinate_left: coordinate_left,
                    status: typeCityOrVillege,
                    game_number: this.item.game_number,
                    color_id: this.colors[0].id,

                });
                axios.post('addbuildingtodb',{
                    game_number: this.item.game_number,
                    color_id: this.colors[0].id,
                    number: id,
                    element_type_id:type_id,
                    typeCityOrVillege: typeCityOrVillege,

                    color1_element: this.colors[0].color1_element,
                    color2_element: this.colors[0].color2_element,
                    color3_element: this.colors[0].color3_element,
                    coordinate_top: coordinate_top,
                    coordinate_left: coordinate_left,
                });
            },

            //удаление строения данные по строительству дороги или города или поселения в базу
            delBuildingFromDb(type_id,id,typeCityOrVillege,coordinate_top,coordinate_left){
                    axios.post('delbuildingfromdb',{
                    game_number: this.item.game_number,
                    color_id: this.colors[0].id,
                    number: id,
                    element_type_id:type_id,
                    typeCityOrVillege: typeCityOrVillege,

                    color1_element: this.colors[0].color1_element,
                    color2_element: this.colors[0].color2_element,
                    color3_element: this.colors[0].color3_element,
                    coordinate_top: coordinate_top,
                    coordinate_left: coordinate_left,
                });
            },
            changeStatusDel(){
                if(this.statusDel == 1){
                    this.statusDel = 0;
                }else{
                    this.statusDel = 1;
                }
            },
            changeStatusTorg(){
                if(this.statusTorg == 1){
                    this.statusTorg = 0;
                }else{
                    this.statusTorg = 1;
                }
            },

            delroad(a,b){
             //   5,coordinate.number
                if(a==4){
                    document.getElementById('RoadVertical' + b).style.display = 'none';
                }
                if(a==5){
                    document.getElementById('RoadLeftUp' + b).style.display = 'none';
                }
                if(a==6){
                    document.getElementById('RoadLeftDown' + b).style.display = 'none';
                }
                document.getElementById('MenuRoadVertical'+b).style.display = 'none';

                document.getElementById('MenuRoadLeftUp'+b).style.display = 'none';

                document.getElementById('MenuRoadLeftDown'+b).style.display = 'none';
             },
            addResToPlayer(type_res){
                console.log(type_res);
                axios.post('addresourcetoplayer',{game_number: this.item.game_number, position_id: this.colors[0].id, type_res:type_res});
                console.log(this.playercards);
            },
            addResToPlayerFromTable(type_res){
                console.log(type_res);
                axios.post('addresourcetoplayerfromtable',{game_number: this.item.game_number, position_id: this.colors[0].id, type_res:type_res});
                console.log(this.playercards);
            },

            delResFromPlayer(type_res){
                console.log(type_res);
                axios.post('delresourcefromplayer',{game_number: this.item.game_number, position_id: this.colors[0].id, type_res:type_res});
                console.log(this.playercards);

            },
            addKnight(position_knight){
                this.knightPosition = position_knight;
                axios.post('changeknightposition',{game_number: this.item.game_number, position_knight: position_knight});
            },
            trowdice(){
                //this.knightPosition = position;
                axios.post('trowdice',{game_number: this.item.game_number,  position_id: this.colors[0].id});
                this.status_dice_rest_to_player =1;
            },
            stealRes(player_id_to_steal){
                axios.post('stealres',{game_number: this.item.game_number,  position_id: this.colors[0].id, player_id_to_steal:player_id_to_steal});
            },
            addresfromdice(){
               axios.post('addresfromdice',{game_number: this.item.game_number, dice_both:this.dice_both});
               this.status_dice_rest_to_player = 0;
               // axios.post('addresfromdice',{game_number: this.item.game_number, dice_both:this.dice_both);

                // console.log('взять ресурсы');
                console.log(this.dice_both);
                console.log(this.item.game_number);
            },
        }
    }
</script>


