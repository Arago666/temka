<template>
    <div class="container" style="position: relative;">

<!--        Выбор Позиции за столом-->
        <div v-if="player1position==0 || player2position==0 && myPosition==''" style="width: 200px;">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Выбрать колоду</label>
                <select class="form-control" id="exampleFormControlSelect1" v-model="selectedDeck">
                    <option disabled value="">Выберите колоду</option>
                    <option value="1">Кейк</option>
                    <option value="2">Принцесса Жвачка</option>
                    <option value="3">Лимонхват</option>
                    <option value="4">Чарли</option>
                </select>
                <span>Выбрано: {{ selectedDeck }}</span>
            </div>
            <button v-if="player1position==0" class="btn btn-danger" v-on:click="ChosePlayerPosition(1,1,selectedDeck)" style="width: 200px;">Сесть за стол</button>
            <button v-if="player2position==0" class="btn btn-success" v-on:click="ChosePlayerPosition(2,2,selectedDeck)" style="width: 200px;">Сесть за стол</button>
        </div>

        <div v-if="(player1position==0 || player2position==0) && myPosition!=''" style="width: 200px;">

            <button class="btn btn-danger" >Ждем второго игрока</button>

        </div>


        <!--Стол-->
        <div v-if="player1position!=0 && player2position!=0" style="position: absolute;
                    top:-20px;
                    left:870px;
                    width: 600px;
                    height: 238px;
                    background: url(/img/derevo-doski-fon2.jpg);
                    background-size:600px 300px;
                    border-radius:100px;
                    box-shadow: 0 12px 6px -6px #666, 0 0 3px 0 #ccc;">
        </div>


<!--        Игроки (картинка игроков и хп игроков)-->
        <div v-if="player1position!=0 && player2position!=0" v-for="player in players" style="position: relative;left:-400px; top:10px;">

            <div v-if="player.position!=myPosition" >
                <div v-for="cardsImage in cardsImg">
                    <div v-if="cardsImage.deck_type == opponentDeckType &&cardsImage.card_type==3"
                         style="position: absolute;left:65px;top:0px;">
                        <img :src="'/img/cardwars/'+cardsImage.img" width="262" height="354">
                        <div style="position: absolute; top:356px;left:107px;">
                            <button  class="btn btn-success"  style="border-radius:70px;">{{player.hp}}</button>
                        </div>
                        <div style="position: absolute; top:355px;left:177px;">
                            <button v-on:click="changeHpPlayer(opponentPosition,1)"  class="btn btn-danger" >+</button>
                        </div>
                        <div style="position: absolute; top:355px;left:47px;">
                            <button v-on:click="changeHpPlayer(opponentPosition,-1)" class="btn btn-danger" >-</button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="player.position==myPosition" >
                <div v-for="cardsImage in cardsImg">
                    <div v-if="cardsImage.deck_type == myDeckType &&cardsImage.card_type==3"
                         style="position: absolute;left:65px;top:450px;">
                        <img :src="'/img/cardwars/'+cardsImage.img" width="262" height="354">

                        <div style="position: absolute; top:-33px;left:107px;">
                            <button  class="btn btn-success"  style="border-radius:70px;">{{player.hp}}</button>
                        </div>
                        <div style="position: absolute; top:-32px;left:177px;">
                            <button v-on:click="changeHpPlayer(myPosition,1)" class="btn btn-danger" >+</button>
                        </div>
                        <div style="position: absolute; top:-32px;left:47px;">
                            <button v-on:click="changeHpPlayer(myPosition,-1)" class="btn btn-danger" >-</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div style="display: none">{{i=0}}</div>
        <div v-if="player1position!=0 && player2position!=0" v-for="playercard in playerscards">
            <div v-if="playercard.status==1 && playercard.position_id!=myPosition" >
                <div style="display: none">{{i=i+1}}</div>
            </div>
        </div>
        <div style="position: absolute;top:20px;left:-50px;">
            <button class="btn-dark" style="border-radius:50px;">{{i}}</button>
        </div>




        <div style="display: none;"> {{b=900}} {{c=280}} {{d=906}} </div>

<!--        Отображение карт-->
        <div v-if="player1position!=0 && player2position!=0" v-for="playercard in playerscards">
            <div style="display: none;">

                <div v-if="playercard.position_card==1">
                    {{a=0}}     {{aTown=24}}
                </div>
                <div v-if="playercard.position_card==2">
                    {{a=0+220}} {{aTown=24+220}}
                </div>
                <div v-if="playercard.position_card==3">
                    {{a=0+440}} {{aTown=24+440}}
                </div>
                <div v-if="playercard.position_card==4">
                    {{a=0+660}} {{aTown=24+660}}
                </div>
            </div>
<!--         Отображение больших карт   Противник-->
            <div v-if="playercard.status==6 && playercard.position_id!=myPosition" >
                <div v-for="cardsImage in cardsImg">
                    <div v-if="cardsImage.deck_type == opponentDeckType && playercard.number_card==cardsImage.number &&cardsImage.card_type==2"
                         :style="'position: absolute;left:'+a+'px;top:160px;'">

                        <img v-if="playercard.shirt_card==1" :src="'/img/cardwars/'+cardsImage.img" width="176" height="250">
                        <img v-if="playercard.shirt_card==2" src="/img/cardwars/back.jpg" width="176" height="250">
                    </div>
                </div>
            </div>
<!--        Отображение больших карт    Я-->
            <div v-if="playercard.status==6 && playercard.position_id==myPosition">
                <div v-for="cardsImage in cardsImg">
                    <div v-if="cardsImage.deck_type == myDeckType && playercard.number_card==cardsImage.number &&cardsImage.card_type==2"
                    :style="'position: absolute;left:'+a+'px;top:420px;'">

                        <img v-on:dblclick="bigCardBack(playercard.number_card,playercard.status,playercard.position_card,2)" v-if="playercard.shirt_card==1" :src="'/img/cardwars/'+cardsImage.img" width="176" height="250">
                        <img v-on:dblclick="bigCardBack(playercard.number_card,playercard.status,playercard.position_card,1)" v-if="playercard.shirt_card==2" src="/img/cardwars/back.jpg" width="176" height="250">
                    </div>
                </div>
            </div>

            <!--         Отображение строений   Я-->
            <div v-if="playercard.status==5 && playercard.position_id==myPosition">
                <div v-for="cardsImage in cardsImg">
                    <div v-if="cardsImage.deck_type == myDeckType && playercard.number_card==cardsImage.number &&cardsImage.card_type==1"
                         :style="'position: absolute;left:'+aTown+'px;top:680px;'">
                        <div :id="'ImgDiv'+playercard.position_id+'_'+playercard.number_card" :style="'position: absolute;left:0px;top:0'">
                        <img :id="'Img'+playercard.position_id+'_'+playercard.number_card" v-on:mousemove.alt="changeSizeImg(playercard.position_id,playercard.number_card)" v-on:mouseleave="changeSizeImgToDefault(playercard.position_id,playercard.number_card)" v-on:click="openMenuCardBuilding(playercard.number_card)" :src="'/img/cardwars/'+cardsImage.img" width="128" height="176">
                        </div>


                        <div :id="'MenuCardBuilding'+playercard.number_card"  :style="'z-index: 100;display:none; position: absolute; top:30px; left:14px;'">
                            <button v-on:click="openMenuCardBuildingChangePosition(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">Переместить</button>
                            <button v-on:click="cardWithHand(playercard.number_card,8,playercard.position_card,5),closeMenuCardBuilding(playercard.number_card)" class="btn btn-dark" style="width: 100px; ">Сбросить</button>
                            <button v-on:click="closeMenuCardBuilding(playercard.number_card)" class="btn btn-danger" style="width: 100px; ">Закрыть</button>
                            <div :id="'MenuCardBuildingChangePosition'+playercard.number_card"  :style="'z-index: 100;display:none; position: absolute; top:0px; left:100px;'">
                                <button v-on:click="cardWithHand(playercard.number_card,5,1,5),closeMenuCardBuilding(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">1 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,5,2,5),closeMenuCardBuilding(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">2 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,5,3,5),closeMenuCardBuilding(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">3 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,5,4,5),closeMenuCardBuilding(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">4 позиция</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!--         Отображение существ на поле в Флюпнуты   Я-->
            <!--            playercard.status = cardwars_game_player_cards.Card_type-->
            <div v-if="playercard.status==4 && playercard.position_id==myPosition">
                <div v-for="cardsImage in cardsImg">
                    <div v-if="cardsImage.deck_type == myDeckType && playercard.number_card==cardsImage.number &&cardsImage.card_type==1"
                         :style="'position: absolute;left:'+aTown+'px;top:518px;'">
                        <div :id="'ImgDiv'+playercard.position_id+'_'+playercard.number_card" :style="'position: absolute;left:0px;top:0'">
                        <img v-on:click="openMenuCardField(playercard.number_card)" :src="'/img/cardwars/'+cardsImage.img" :id="'Img'+playercard.position_id+'_'+playercard.number_card" v-on:mousemove.alt="changeSizeImgFight(playercard.position_id,playercard.number_card)" v-on:mouseleave="changeSizeImgToDefaultFightMe(playercard.position_id,playercard.number_card)" width="128" height="176" style="transform: rotate(90deg);">
                        </div>
                        <div style="position: absolute; top:-11px;left:50px;z-index: 2;">
                            <button v-on:click="changehp(playercard.number_card,playercard.status,playercard.position_card,playercard.status,1,myPosition)" class="btn btn-danger"  style="border-radius:70px;">{{playercard.hp}}</button>
                        </div>
                        <div style="position: absolute; top:129px;left:152px;z-index: 2;">
                            <button v-on:click="changehp(playercard.number_card,playercard.status,playercard.position_card,playercard.status,-1,myPosition)" class="btn btn-success" ></button>
                        </div>

                        <div :id="'MenuCardField'+playercard.number_card"  :style="'z-index: 100;display:none; position: absolute; top:30px; left:14px;'">
                            <button v-on:click="openMenuCardFieldFight(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">Переместить</button>
                            <button v-on:click="cardWithHand(playercard.number_card,3,playercard.position_card,4),closeMenuCardField(playercard.number_card)" class="btn btn-success" style="width: 100px; ">В атаку</button>
                            <button v-on:click="cardWithHand(playercard.number_card,4,playercard.position_card,4),closeMenuCardField(playercard.number_card)" class="btn btn-warning" style="width: 100px; ">Флюп</button>
                            <button v-on:click="cardWithHand(playercard.number_card,8,playercard.position_card,4),closeMenuCardField(playercard.number_card)" class="btn btn-dark" style="width: 100px; ">Сбросить</button>
                            <button v-on:click="closeMenuCardField(playercard.number_card)" class="btn btn-danger" style="width: 100px; ">Закрыть</button>
                            <div :id="'MenuCardFieldFight'+playercard.number_card"  :style="'z-index: 100;display:none; position: absolute; top:0px; left:100px;'">
                                <button v-on:click="cardWithHand(playercard.number_card,2,1,4),closeMenuCardField(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">1 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,2,2,4),closeMenuCardField(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">2 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,2,3,4),closeMenuCardField(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">3 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,2,4,4),closeMenuCardField(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">4 позиция</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--         Отображение существ на поле вертикальных   я-->
            <!--            playercard.status = cardwars_game_player_cards.Card_type-->
            <div v-if="playercard.status==2 && playercard.position_id==myPosition">
                <div v-for="cardsImage in cardsImg">
                    <div v-if="cardsImage.deck_type == myDeckType && playercard.number_card==cardsImage.number &&cardsImage.card_type==1"
                         :style="'position: absolute;left:'+aTown+'px;top:454px;'">
                        <div :id="'ImgDiv'+playercard.position_id+'_'+playercard.number_card" :style="'position: absolute;left:0px;top:0'">
                        <img :id="'Img'+playercard.position_id+'_'+playercard.number_card" v-on:mousemove.alt="changeSizeImg(playercard.position_id,playercard.number_card)" v-on:mouseleave="changeSizeImgToDefault(playercard.position_id,playercard.number_card)" v-on:click="openMenuCardField(playercard.number_card)"  :src="'/img/cardwars/'+cardsImage.img" width="128" height="176" style="height: 176px;width: 128px;">
                        </div>

                        <div style="position: absolute; top:50px;left:50px;z-index: 2;">
                            <button v-on:click="changehp(playercard.number_card,playercard.status,playercard.position_card,playercard.status,1,myPosition)" class="btn btn-danger"  style="border-radius:70px;">{{playercard.hp}}</button>
                        </div>
                        <div style="position: absolute; top:190px;left:152px;z-index: 2;">
                            <button v-on:click="changehp(playercard.number_card,playercard.status,playercard.position_card,playercard.status,-1,myPosition)" class="btn btn-success" ></button>
                        </div>


                        <div :id="'MenuCardField'+playercard.number_card"  :style="'z-index: 100;display:none; position: absolute; top:30px; left:14px;'">
                            <button v-on:click="openMenuCardFieldFight(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">Переместить</button>
                            <button v-on:click="cardWithHand(playercard.number_card,3,playercard.position_card,2),closeMenuCardField(playercard.number_card)" class="btn btn-success" style="width: 100px; ">В атаку</button>
                            <button v-on:click="cardWithHand(playercard.number_card,4,playercard.position_card,2),closeMenuCardField(playercard.number_card)" class="btn btn-warning" style="width: 100px; ">Флюп</button>
                            <button v-on:click="cardWithHand(playercard.number_card,8,playercard.position_card,2),closeMenuCardField(playercard.number_card)" class="btn btn-dark" style="width: 100px; ">Сбросить</button>
                            <button v-on:click="closeMenuCardField(playercard.number_card)" class="btn btn-danger" style="width: 100px; ">Закрыть</button>
                            <div :id="'MenuCardFieldFight'+playercard.number_card"  :style="'z-index: 100;display:none; position: absolute; top:0px; left:100px;'">
                                <button v-on:click="cardWithHand(playercard.number_card,2,1,2),closeMenuCardField(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">1 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,2,2,2),closeMenuCardField(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">2 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,2,3,2),closeMenuCardField(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">3 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,2,4,2),closeMenuCardField(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">4 позиция</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--         Отображение существ на поле в атаке   Я-->
            <!--            playercard.status = cardwars_game_player_cards.Card_type-->
            <div v-if="playercard.status==3 && playercard.position_id==myPosition">
                <div v-for="cardsImage in cardsImg">
                    <div v-if="cardsImage.deck_type == myDeckType && playercard.number_card==cardsImage.number &&cardsImage.card_type==1"
                         :style="'position: absolute;left:'+aTown+'px;top:396px;'">
                        <div :id="'ImgDiv'+playercard.position_id+'_'+playercard.number_card" :style="'position: absolute;left:0px;top:0'">
                        <img v-on:click="openMenuCardField(playercard.number_card)" :src="'/img/cardwars/'+cardsImage.img" :id="'Img'+playercard.position_id+'_'+playercard.number_card" v-on:mousemove.alt="changeSizeImgFight(playercard.position_id,playercard.number_card)" v-on:mouseleave="changeSizeImgToDefaultFightMe(playercard.position_id,playercard.number_card)" width="128" height="176" style="transform: rotate(90deg);">
                        </div>
                        <div style="position: absolute; top:108px;left:50px;z-index: 2;">
                            <button v-on:click="changehp(playercard.number_card,playercard.status,playercard.position_card,playercard.status,1,myPosition)" class="btn btn-danger"  style="border-radius:70px;">{{playercard.hp}}</button>
                        </div>
                        <div style="position: absolute; top:248px;left:152px;z-index: 2;">
                            <button v-on:click="changehp(playercard.number_card,playercard.status,playercard.position_card,playercard.status,-1,myPosition)" class="btn btn-success" ></button>
                        </div>

                        <div :id="'MenuCardField'+playercard.number_card"  :style="'z-index: 100;display:none; position: absolute; top:30px; left:14px;'">
                            <button v-on:click="openMenuCardFieldFight(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">Переместить</button>
                            <button v-on:click="cardWithHand(playercard.number_card,3,playercard.position_card,3),closeMenuCardField(playercard.number_card)" class="btn btn-success" style="width: 100px; ">В атаку</button>
                            <button v-on:click="cardWithHand(playercard.number_card,4,playercard.position_card,3),closeMenuCardField(playercard.number_card)" class="btn btn-warning" style="width: 100px; ">Флюп</button>
                            <button v-on:click="cardWithHand(playercard.number_card,8,playercard.position_card,3),closeMenuCardField(playercard.number_card)" class="btn btn-dark" style="width: 100px; ">Сбросить</button>
                            <button v-on:click="closeMenuCardField(playercard.number_card)" class="btn btn-danger" style="width: 100px; ">Закрыть</button>
                            <div :id="'MenuCardFieldFight'+playercard.number_card"  :style="'z-index: 100;display:none; position: absolute; top:0px; left:100px;'">
                                <button v-on:click="cardWithHand(playercard.number_card,2,1,3),closeMenuCardField(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">1 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,2,2,3),closeMenuCardField(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">2 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,2,3,3),closeMenuCardField(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">3 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,2,4,3),closeMenuCardField(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">4 позиция</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--         Отображение существ на поле в атаке   Противник-->
            <!--            playercard.status = cardwars_game_player_cards.Card_type-->
            <div v-if="playercard.status==3 && playercard.position_id!=myPosition">
                <div v-for="cardsImage in cardsImg">
                    <div v-if="cardsImage.deck_type == opponentDeckType && playercard.number_card==cardsImage.number &&cardsImage.card_type==1"
                         :style="'position: absolute;left:'+aTown+'px;top:258px;'">
                        <div :id="'ImgDiv'+playercard.position_id+'_'+playercard.number_card" :style="'position: absolute;left:0px;top:0'">
                        <img :src="'/img/cardwars/'+cardsImage.img" :id="'Img'+playercard.position_id+'_'+playercard.number_card" v-on:mousemove.alt="changeSizeImgFight(playercard.position_id,playercard.number_card)" v-on:mouseleave="changeSizeImgToDefaultFight(playercard.position_id,playercard.number_card)" width="128" height="176" style="transform: rotate(-90deg);">
                        </div>
                        <div style="position: absolute; top:-8px;left:50px;z-index: 2;">
                            <button v-on:click="changehp(playercard.number_card,playercard.status,playercard.position_card,playercard.status,1,opponentPosition)" class="btn btn-danger"  style="border-radius:70px;">{{playercard.hp}}</button>
                        </div>
                        <div style="position: absolute; top:132px;left:152px;z-index: 2;">
                            <button v-on:click="changehp(playercard.number_card,playercard.status,playercard.position_card,playercard.status,-1,opponentPosition)" class="btn btn-success" ></button>
                        </div>
                    </div>
                </div>
            </div>

            <!--         Отображение существ на поле вертикальных   Противник-->
            <!--            playercard.status = cardwars_game_player_cards.Card_type-->
            <div v-if="playercard.status==2 && playercard.position_id!=myPosition">
                <div v-for="cardsImage in cardsImg">
                    <div v-if="cardsImage.deck_type == opponentDeckType && playercard.number_card==cardsImage.number &&cardsImage.card_type==1"
                         :style="'position: absolute;left:'+aTown+'px;top:196px;'">
                        <div :id="'ImgDiv'+playercard.position_id+'_'+playercard.number_card" :style="'position: absolute;left:0px;top:0'">
                        <img :id="'Img'+playercard.position_id+'_'+playercard.number_card" v-on:mousemove.alt="changeSizeImg(playercard.position_id,playercard.number_card)" v-on:mouseleave="changeSizeImgToDefault(playercard.position_id,playercard.number_card)" :src="'/img/cardwars/'+cardsImage.img" width="128" height="176">
                        </div>
                        <div style="position: absolute; top:50px;left:50px;z-index: 2;">
                            <button v-on:click="changehp(playercard.number_card,playercard.status,playercard.position_card,playercard.status,1,opponentPosition)" class="btn btn-danger"  style="border-radius:70px;">{{playercard.hp}}</button>
                        </div>
                        <div style="position: absolute; top:190px;left:152px;z-index: 2;">
                            <button v-on:click="changehp(playercard.number_card,playercard.status,playercard.position_card,playercard.status,-1,opponentPosition)" class="btn btn-success" ></button>
                        </div>

                    </div>
                </div>
            </div>

            <!--         Отображение существ на поле в Флюпнуты   Противник-->
            <!--            playercard.status = cardwars_game_player_cards.Card_type-->
            <div v-if="playercard.status==4 && playercard.position_id!=myPosition">
                <div v-for="cardsImage in cardsImg">
                    <div  v-if="cardsImage.deck_type == opponentDeckType && playercard.number_card==cardsImage.number &&cardsImage.card_type==1"
                         :style="'position: absolute;left:'+aTown+'px;top:135px;'">
                        <div :id="'ImgDiv'+playercard.position_id+'_'+playercard.number_card" :style="'position: absolute;left:0px;top:0'">
                        <img :src="'/img/cardwars/'+cardsImage.img" :id="'Img'+playercard.position_id+'_'+playercard.number_card" v-on:mousemove.alt="changeSizeImgFight(playercard.position_id,playercard.number_card)" v-on:mouseleave="changeSizeImgToDefaultFight(playercard.position_id,playercard.number_card)" width="128" height="176" style="transform: rotate(-90deg);">
                        </div>
                        <div style="position: absolute; top:111px;left:50px;z-index: 2;">
                            <button v-on:click="changehp(playercard.number_card,playercard.status,playercard.position_card,playercard.status,1,opponentPosition)" class="btn btn-danger"  style="border-radius:70px;">{{playercard.hp}}</button>
                        </div>
                        <div style="position: absolute; top:251px;left:152px;z-index: 2;">
                            <button v-on:click="changehp(playercard.number_card,playercard.status,playercard.position_card,playercard.status,-1,opponentPosition)" class="btn btn-success" ></button>
                        </div>
                    </div>
                </div>
            </div>

            <!--         Отображение строений   Противник-->
            <!--            playercard.status = cardwars_game_player_cards.Card_type-->
            <div v-if="playercard.status==5 && playercard.position_id!=myPosition">
                <div v-for="cardsImage in cardsImg">
                    <div v-if="cardsImage.deck_type == opponentDeckType && playercard.number_card==cardsImage.number &&cardsImage.card_type==1"
                         :style="'position: absolute;left:'+aTown+'px;top:-23px;'">
                        <div :id="'ImgDiv'+playercard.position_id+'_'+playercard.number_card" :style="'position: absolute;left:0px;top:0'">
                        <img :id="'Img'+playercard.position_id+'_'+playercard.number_card" v-on:mousemove.alt="changeSizeImg(playercard.position_id,playercard.number_card)" v-on:mouseleave="changeSizeImgToDefault(playercard.position_id,playercard.number_card)" :src="'/img/cardwars/'+cardsImage.img" width="128" height="176">
                        </div>
                    </div>
                </div>
            </div>


















            <!--         Отображение моих карт-->
            <!--            playercard.status = cardwars_game_player_cards.Card_type-->
            <div v-if="playercard.status==1 && playercard.position_id==myPosition">
                <div v-for="cardsImage in cardsImg">
                    <div v-if="cardsImage.deck_type == myDeckType && playercard.number_card==cardsImage.number &&cardsImage.card_type==1"
                         :style="'position: absolute;left:'+b+'px;top:'+c+'px;'">
                        <div style="display: none;">
                            {{b=b+135}}
                            <div v-if="b==1440">{{c=c+200}} {{b=900}}</div>
                        </div>
                        <div :id="'ImgDiv'+playercard.position_id+'_'+playercard.number_card" :style="'position: absolute;left:0px;top:0'">
                        <img :id="'Img'+playercard.position_id+'_'+playercard.number_card" v-on:mousemove.alt="changeSizeImg(playercard.position_id,playercard.number_card)" v-on:mouseleave="changeSizeImgToDefault(playercard.position_id,playercard.number_card)" v-on:click="openMenuCardPlayer(playercard.number_card)"  :src="'/img/cardwars/'+cardsImage.img" width="128" height="176" style="height: 176px;width: 128px;" >
                        </div>

                        <div :id="'MenuCardPlayer'+playercard.number_card"  :style="'z-index: 100;display:none; position: absolute; top:30px; left:14px;'">
                            <button v-on:click="openMenuCardPlayerFight(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">В бой</button>
                            <button v-on:click="openMenuCardPlayerTown(playercard.number_card)" class="btn btn-success" style="width: 100px; ">Здание</button>
                            <button v-on:click="cardWithHand(playercard.number_card,7,0,1),closeMenuCardPlayer(playercard.number_card)" class="btn btn-warning" style="width: 100px; ">На стол</button>
                            <button v-on:click="cardWithHand(playercard.number_card,8,playercard.position_card,1),closeMenuCardPlayer(playercard.number_card)" class="btn btn-dark" style="width: 100px; ">Сбросить</button>
                            <button v-on:click="closeMenuCardPlayer(playercard.number_card)" class="btn btn-danger" style="width: 100px; ">Закрыть</button>
                            <div :id="'MenuCardPlayerFight'+playercard.number_card"  :style="'z-index: 100;display:none; position: absolute; top:0px; left:100px;'">
                                <button v-on:click="cardWithHand(playercard.number_card,2,1,1),closeMenuCardPlayer(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">1 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,2,2,1),closeMenuCardPlayer(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">2 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,2,3,1),closeMenuCardPlayer(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">3 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,2,4,1),closeMenuCardPlayer(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">4 позиция</button>
                            </div>
                            <div :id="'MenuCardPlayerTown'+playercard.number_card"  :style="'z-index: 100;display:none; position: absolute; top:36px; left:100px;'">
                                <button v-on:click="cardWithHand(playercard.number_card,5,1,1),closeMenuCardPlayer(playercard.number_card)" class="btn btn-success" style="width: 100px; ">1 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,5,2,1),closeMenuCardPlayer(playercard.number_card)" class="btn btn-success" style="width: 100px; ">2 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,5,3,1),closeMenuCardPlayer(playercard.number_card)" class="btn btn-success" style="width: 100px; ">3 позиция</button>
                                <button v-on:click="cardWithHand(playercard.number_card,5,4,1),closeMenuCardPlayer(playercard.number_card)" class="btn btn-success" style="width: 100px; ">4 позиция</button>
                            </div>
<!--                            <button class="btn btn-danger"  style="width: 100px;">Закрыть</button>-->
<!--                            <button  class="btn" style="width: 100px;background: #1b1e21;color: white;">Удалить</button>-->
                        </div>

                        <!--              кнопка для вызова меню постройки -->
<!--                 //       <button  class="button_active" :id="'button_active_card'+playercard.number_card" :style="'z-index: 99; position: absolute; top:'+ c +'px; left:'+ b +'px; height: 30px; width: 30px; border-radius: 30px; color: transparent;background-color: transparent; border-color: transparent; cursor: pointer;'"></button>-->


                    </div>
                </div>
            </div>


            <!--         Отображение карт на столе-->
            <!--            playercard.status = cardwars_game_player_cards.Card_type-->
            <div v-if="playercard.status==7 ">
                <div v-for="cardsImage in cardsImg">
                    <div :id="'ImgDiv'+playercard.position_id+'_'+playercard.number_card" v-if="cardsImage.deck_type == myDeckType && playercard.number_card==cardsImage.number &&cardsImage.card_type==1 && playercard.position_id==myPosition"
                         :style="'position: absolute;left:'+d+'px;top:10px;'">
                        <div style="display: none;">
                            {{d=d+135}}
                        </div>
                        <img :id="'Img'+playercard.position_id+'_'+playercard.number_card" v-on:mousemove.alt="changeSizeImg(playercard.position_id,playercard.number_card)" v-on:mouseleave="changeSizeImgToDefault(playercard.position_id,playercard.number_card)" v-on:dblclick="cardWithHand(playercard.number_card,8,0,7)" :src="'/img/cardwars/'+cardsImage.img" width="128" height="176">


                    </div>

<!--                    когда сбрасывает противник-->
                    <div :id="'ImgDiv'+playercard.position_id+'_'+playercard.number_card" v-if="cardsImage.deck_type == opponentDeckType && playercard.number_card==cardsImage.number &&cardsImage.card_type==1 && playercard.position_id!=myPosition"
                         :style="'position: absolute;left:'+d+'px;top:10px;'">
                        <div style="display: none;">
                            {{d=d+135}}
                        </div>
                        <img :id="'Img'+playercard.position_id+'_'+playercard.number_card" v-on:mousemove.alt="changeSizeImg(playercard.position_id,playercard.number_card)" v-on:mouseleave="changeSizeImgToDefault(playercard.position_id,playercard.number_card)" v-on:dblclick="cardWithHand(playercard.number_card,8,0,7)" :src="'/img/cardwars/'+cardsImage.img" width="128" height="176">


                    </div>

                </div>
            </div>




        </div>


<div v-if="player1position!=0 && player2position!=0" style="position: absolute;top:225px;left:1105px;">
    <button v-on:click="addCardToPlayer()" class="btn btn-success" style="width:120px;" >Взять карту</button>
    <div style="position: absolute;top:5px;left:125px;">
        <button v-on:click="openDiscardDeck()" class="btn btn-dark" style="width:20px;" ></button>
    </div>

</div>



        <!--         Отображение моих сброшенных карт-->
        <div id="DiscardDeck" style="position: absolute; display: none;
                    top:-50px;
                    left:-200px;
                    width: 1450px;
                    height: 850px;
                    background: #fff;

                    border-radius:100px;
                    box-shadow: 0 12px 6px -6px #666, 0 0 3px 0 #ccc;z-index: 3;">
            <div style="position: absolute;top:7px;left:665px;">
                <button v-on:click="closeDiscardDeck()" class="btn btn-danger" style="width: 100px; ">Закрыть</button>
            </div>
            <div style="display: none;"> {{b=50}} {{c=50}}  </div>
            <div v-if="player1position!=0 && player2position!=0" v-for="playercard in playerscards">
                <!--         Отображение моих сброшенных карт-->
                <!--            playercard.status = cardwars_game_player_cards.Card_type-->
                <div v-if="playercard.status==8 && playercard.position_id==myPosition">
                    <div v-for="cardsImage in cardsImg">
                        <div :id="'ImgDiv'+playercard.position_id+'_'+playercard.number_card" v-if="cardsImage.deck_type == myDeckType && playercard.number_card==cardsImage.number &&cardsImage.card_type==1"
                             :style="'position: absolute;left:'+b+'px;top:'+c+'px;'">
                            <div style="display: none;">
                                {{b=b+135}}
                                <div v-if="b==1400">{{c=c+200}} {{b=50}}</div>
                            </div>

                            <img :id="'Img'+playercard.position_id+'_'+playercard.number_card" v-on:mousemove.alt="changeSizeImg(playercard.position_id,playercard.number_card)" v-on:mouseleave="changeSizeImgToDefault(playercard.position_id,playercard.number_card)" v-on:click="openMenuCardPlayer(playercard.number_card)"  :src="'/img/cardwars/'+cardsImage.img" width="128" height="176" style="height: 176px;width: 128px;" >

                            <div :id="'MenuCardPlayer'+playercard.number_card"  :style="'z-index: 100;display:none; position: absolute; top:30px; left:14px;'">
                                <button v-on:click="openMenuCardPlayerFight(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">В бой</button>
                                <button v-on:click="openMenuCardPlayerTown(playercard.number_card)" class="btn btn-success" style="width: 100px; ">Здание</button>
                                <button v-on:click="cardWithHand(playercard.number_card,7,0,8),closeMenuCardPlayer(playercard.number_card)" class="btn btn-warning" style="width: 100px; ">На стол</button>
                                <button v-on:click="cardWithHand(playercard.number_card,9,playercard.position_card,8),closeMenuCardPlayer(playercard.number_card)" class="btn btn-dark" style="width: 100px; ">Вернуть в колоду</button>
                                <button v-on:click="closeMenuCardPlayer(playercard.number_card)" class="btn btn-danger" style="width: 100px; ">Закрыть</button>
                                <div :id="'MenuCardPlayerFight'+playercard.number_card"  :style="'z-index: 100;display:none; position: absolute; top:0px; left:100px;'">
                                    <button v-on:click="cardWithHand(playercard.number_card,2,1,8),closeMenuCardPlayer(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">1 позиция</button>
                                    <button v-on:click="cardWithHand(playercard.number_card,2,2,8),closeMenuCardPlayer(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">2 позиция</button>
                                    <button v-on:click="cardWithHand(playercard.number_card,2,3,8),closeMenuCardPlayer(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">3 позиция</button>
                                    <button v-on:click="cardWithHand(playercard.number_card,2,4,8),closeMenuCardPlayer(playercard.number_card)" class="btn btn-primary" style="width: 100px; ">4 позиция</button>
                                </div>
                                <div :id="'MenuCardPlayerTown'+playercard.number_card"  :style="'z-index: 100;display:none; position: absolute; top:36px; left:100px;'">
                                    <button v-on:click="cardWithHand(playercard.number_card,5,1,8),closeMenuCardPlayer(playercard.number_card)" class="btn btn-success" style="width: 100px; ">1 позиция</button>
                                    <button v-on:click="cardWithHand(playercard.number_card,5,2,8),closeMenuCardPlayer(playercard.number_card)" class="btn btn-success" style="width: 100px; ">2 позиция</button>
                                    <button v-on:click="cardWithHand(playercard.number_card,5,3,8),closeMenuCardPlayer(playercard.number_card)" class="btn btn-success" style="width: 100px; ">3 позиция</button>
                                    <button v-on:click="cardWithHand(playercard.number_card,5,4,8),closeMenuCardPlayer(playercard.number_card)" class="btn btn-success" style="width: 100px; ">4 позиция</button>
                                </div>
                                <!--                            <button class="btn btn-danger"  style="width: 100px;">Закрыть</button>-->
                                <!--                            <button  class="btn" style="width: 100px;background: #1b1e21;color: white;">Удалить</button>-->
                            </div>

                            <!--              кнопка для вызова меню постройки -->
                            <!--                 //       <button  class="button_active" :id="'button_active_card'+playercard.number_card" :style="'z-index: 99; position: absolute; top:'+ c +'px; left:'+ b +'px; height: 30px; width: 30px; border-radius: 30px; color: transparent;background-color: transparent; border-color: transparent; cursor: pointer;'"></button>-->


                        </div>
                    </div>
                </div>
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
                players: [],
                player1position: 0,
                player2position: 0,
                selectedDeck: '',
                playerscards: [],
                myPosition: '',
                opponentPosition: '',
                myDeckType: '',
                opponentDeckType: '',
                cardsImg: [],



            }
        },

        created() {

            this.fetchPlayers();
            this.fetchPlayersCards();
            this.fetchСardsImg();
          //  this.fetchPlayersPositions();
            // this.fetchCoordinate();
            // this.fetchPosition();
            // this.fetchPlayerColors();
            // this.fetchBuildings();
            // this.fetchPlayerCards();
            // this.fetchKnightPosition();
            // this.fetchPlayers();

            Echo.join('cardwars-main')
                .listen('CardWarsMain', (event) => {
                    if(event.cardwars.game_number == this.item.game_number){

                        console.log('1111');
                        console.log(event.cardwars);
                        console.log(this.user);

                        if(this.playerscards.length<8){
                            window.location.href = this.item.game_number;
                        }

                        //выбрали цвет за столом и карты
                        if(event.cardwars.position ==1){
                            this.player1position=1;
                            if(event.cardwars.user_id == this.user.id)
                            {
                                console.log('1222111');
                                this.myPosition =event.cardwars.position;
                                console.log(this.myPosition);

                            }

                        }
                        if(event.cardwars.position ==2){
                            this.player2position=1;
                            if(event.cardwars.user_id == this.user.id)
                            {
                                console.log('1222111');
                                this.myPosition =event.cardwars.position;
                                console.log(this.myPosition);

                            }

                        }


                        // if(event.cardwars.number)
                        // {
                        //   //  this.playerscards = response.data;
                        //     console.log('1111');
                        //  this.cardsImg.push(event.cardwars);
                        // }
                        //
                        // if(this.playerscards.length<8 ){
                        //
                        //   //  this.playercards.push(event.cardwars);
                        //     this.playerscards.push(event.cardwars);
                        // }





                        var j=0;
                        // if(this.players.length<2)
                        // {
                        //     console.log('this.players.first.event');
                        //     this.players.push(event.cardwars);
                        // }

                        if(event.cardwars.active_deck_status && !event.cardwars.position)
                        {
                            for(var i=0;i<this.playerscards.length;i++){
                                if((this.playerscards[i].position_id==event.cardwars.position_id)&&(this.playerscards[i].number_card==event.cardwars.card_position)&&(this.playerscards[i].card_type==1))
                                {
                                    console.log("УДАЛИЛИ!!!!!!!!!!!!!!!!!!!!!")
                                    this.playerscards[i].status=9;
                                }
                            }
                        }
                        if(!event.cardwars.active_deck_status && !event.cardwars.position) {
                            for (var i = 0; i < this.playerscards.length; i++) {
                                if ((this.playerscards[i].position_id == event.cardwars.position_id) && (this.playerscards[i].number_card == event.cardwars.number_card) && (this.playerscards[i].card_type == event.cardwars.card_type)) {
                                    this.playerscards[i].status = event.cardwars.status;
                                    this.playerscards[i].shirt_card = event.cardwars.shirt_card;
                                    this.playerscards[i].position_card = event.cardwars.position_card;
                                    this.playerscards[i].hp = event.cardwars.hp;
                                    j = 1;
                                }
                            }
                            if (j == 0) {
                                this.playerscards.push(event.cardwars);
                            }
                        }

                        if(event.cardwars.position){
                            for(var i=0;i<this.players.length;i++) {
                                if(this.players[i].position==event.cardwars.position)
                                {
                                    this.players[i].hp=event.cardwars.hp;
                                    console.log(event.cardwars.game_number);

                                }
                            }
                        }

                    }




                    console.log(this.playerscards);
                    console.log('this.playerscards');
                    console.log(event.cardwars);
                    console.log('event.cardwars');
                });
        },

        methods: {
            //получаем игроков за столом cardwars_game_position_players

            //получаем карты игроков за столом  cardwars_game_player_cards + // получаем img колод игроков за столом cardwars_deck_cards

            //получаем колоды игроков за столом cardwars_game_deck_cards



            // получаем игроков за столом
            fetchPlayers() {
                axios.get('/games/cardwars/getplayers/'+this.item.game_number).then(response =>{
                    console.log('this.players');
                    console.log(response.data);

                    this.players = response.data;

                    for(var i=0;i<this.players.length;i++)
                    {
                        if(this.players[i].position==1){
                            this.player1position=1;
                        }
                        if(this.players[i].position==2){
                            this.player2position=1;
                        }

                        //узнаем свою позицию за столом
                        if(this.players[i].user_id == this.user.id){
                            this.myPosition = this.players[i].position;
                            this.myDeckType = this.players[i].deck_type;
                        }
                        else{
                            this.opponentPosition = this.players[i].position;
                            this.opponentDeckType = this.players[i].deck_type;
                        }
                    }
                    console.log(' this.myPosition');
                    console.log( this.myPosition);
                    console.log(' this.opponentDeckType');
                    console.log( this.opponentDeckType);
                    console.log(' this.myDeckType');
                    console.log( this.myDeckType);
                   // if(this.players.user_id == this.user.id)
                });
            },
            //игрок выбрал цвет
            ChosePlayerPosition(colorPlayer,position,selectedDeck){
                axios.post('choseplayerposition',{game_number: this.item.game_number, position: position, color_id:colorPlayer, deck_type:selectedDeck});
            },

            //получаем текущие карты игрока (+ стартовую карту (4 шт) + иконку (кем играет))
            fetchPlayersCards() {
                axios.get('/games/cardwars/getplayerscards/'+this.item.game_number).then(response =>{
                  //  console.log(response.data);
                    this.playerscards = response.data;
                     console.log('this.playerscards');
                     console.log(this.playerscards);
                });
            },
            //получаем картинки карт
            fetchСardsImg() {
                axios.get('/games/cardwars/getcardsimg/'+this.item.game_number).then(response =>{
                      console.log('getcardsimg');
                    console.log(response.data);
                    this.cardsImg = response.data;

                });
            },
            addCardToPlayer(){
                axios.post('addcardtoplayer',{game_number: this.item.game_number, position: this.myPosition});
            },
            //меню при клике на карту с руки
            openMenuCardPlayer(id){
                console.log(id);
                document.getElementById('MenuCardPlayer'+id).style.display = 'block';
            },
            //меню при клике на карту с руки (доп для)
            openMenuCardPlayerFight(id){
                console.log(id);
                document.getElementById('MenuCardPlayerFight'+id).style.display = 'block';
                document.getElementById('MenuCardPlayerTown'+id).style.display = 'none'
            },
            //меню при клике на карту с руки (доп для)
            openMenuCardPlayerTown(id){
                console.log(id);
                document.getElementById('MenuCardPlayerTown'+id).style.display = 'block';
                document.getElementById('MenuCardPlayerFight'+id).style.display = 'none';
            },
            closeMenuCardPlayer(id){
                console.log(id);
                document.getElementById('MenuCardPlayer'+id).style.display = 'none';
                document.getElementById('MenuCardPlayerTown'+id).style.display = 'none';
                document.getElementById('MenuCardPlayerFight'+id).style.display = 'none';
            },
            cardWithHand(id,status,position_card,start_status){
                console.log('sss');
                console.log(id);
                console.log(status);
                console.log(position_card);
                console.log('sss');
                console.log(this.item.game_number);
                console.log( this.myPosition);

                axios.post('cardwithhand',{game_number: this.item.game_number, position: this.myPosition,number_card: id, status:status, position_card:position_card, start_status: start_status});

            },

            openMenuCardField(id){
                console.log(id);
                document.getElementById('MenuCardField'+id).style.display = 'block';
              //  document.getElementById('MenuCardFieldFight'+id).style.display = 'none';
            },
            openMenuCardFieldFight(id){
                console.log(id);
                document.getElementById('MenuCardFieldFight'+id).style.display = 'block';
                //  document.getElementById('MenuCardPlayerFight'+id).style.display = 'none';
            },
            closeMenuCardField(id){
                console.log(id);
                document.getElementById('MenuCardFieldFight'+id).style.display = 'none';
                  document.getElementById('MenuCardField'+id).style.display = 'none';
            },

            openMenuCardBuilding(id){
                console.log(id);
                document.getElementById('MenuCardBuilding'+id).style.display = 'block';
                //  document.getElementById('MenuCardFieldFight'+id).style.display = 'none';
            },
            openMenuCardBuildingChangePosition(id){
                console.log(id);
                document.getElementById('MenuCardBuildingChangePosition'+id).style.display = 'block';
                //  document.getElementById('MenuCardFieldFight'+id).style.display = 'none';
            },
            closeMenuCardBuilding(id){
                console.log(id);
                document.getElementById('MenuCardBuilding'+id).style.display = 'none';
                document.getElementById('MenuCardBuildingChangePosition'+id).style.display = 'none';
            },
            openDiscardDeck(){
                document.getElementById('DiscardDeck').style.display = 'block';
            },
            closeDiscardDeck(){
                document.getElementById('DiscardDeck').style.display = 'none';
            },

            changehp(id,status,position_card,start_status,hp,position){
            console.log('sss');
            console.log(id);
            console.log(status);
            console.log(position_card);
            console.log('sss');
            console.log(this.item.game_number);
            console.log( this.myPosition);

            axios.post('cardwithhand',{game_number: this.item.game_number, position: position,number_card: id, status:status, position_card:position_card, start_status: start_status, hp:hp});

            },
            bigCardBack(id,status,position_card,shirt_card){
                axios.post('cardwithhand',{game_number: this.item.game_number,
                    position: this.myPosition,
                    number_card: id,
                    status:status,
                    position_card:position_card,
                    shirt_card: shirt_card
                });
            },
            changeHpPlayer(position,changeHpCount){
                axios.post('changehpplayer',{
                    game_number: this.item.game_number,
                    position: position,
                    changeHpCount: changeHpCount
                });
            },
            changeSizeImg(position_id,number_card){
                document.getElementById('Img'+position_id+'_'+number_card).style.height = '352px';
                document.getElementById('Img'+position_id+'_'+number_card).style.width = '256px';
                document.getElementById('ImgDiv'+position_id+'_'+number_card).style.zIndex = 999;


            },
            changeSizeImgToDefault(position_id,number_card){
                document.getElementById('Img'+position_id+'_'+number_card).style.height = '176px';
                document.getElementById('Img'+position_id+'_'+number_card).style.width = '126px';
                document.getElementById('ImgDiv'+position_id+'_'+number_card).style.zIndex = 1;

            },
            changeSizeImgFight(position_id,number_card){
                document.getElementById('Img'+position_id+'_'+number_card).style.height = '352px';
                document.getElementById('Img'+position_id+'_'+number_card).style.width = '256px';
                document.getElementById('Img'+position_id+'_'+number_card).style.transform = 'rotate(0)';
                document.getElementById('ImgDiv'+position_id+'_'+number_card).style.zIndex = 999;
            },
            changeSizeImgToDefaultFight(position_id,number_card){
                document.getElementById('Img'+position_id+'_'+number_card).style.height = '176px';
                document.getElementById('Img'+position_id+'_'+number_card).style.width = '126px';
                document.getElementById('Img'+position_id+'_'+number_card).style.transform = 'rotate(-90deg)';
                document.getElementById('ImgDiv'+position_id+'_'+number_card).style.zIndex = 1;
            },
            changeSizeImgToDefaultFightMe(position_id,number_card){
                document.getElementById('Img'+position_id+'_'+number_card).style.height = '176px';
                document.getElementById('Img'+position_id+'_'+number_card).style.width = '126px';
                document.getElementById('Img'+position_id+'_'+number_card).style.transform = 'rotate(90deg)';
                document.getElementById('ImgDiv'+position_id+'_'+number_card).style.zIndex = 1;
            },






    }
    }
</script>




