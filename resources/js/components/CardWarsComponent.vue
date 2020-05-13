<template>
    <div class="container">

        Привет play cardwars


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

            // this.fetchCoordinate();
            // this.fetchPosition();
            // this.fetchPlayerColors();
            // this.fetchBuildings();
            // this.fetchPlayerCards();
            // this.fetchKnightPosition();
            // this.fetchPlayers();

            Echo.join('cardwars-main')
                .listen('CardWarsMain', (event) => {
                    console.log(event);
                });
        },

        methods: {
            //получаем игроков за столом cardwars_game_position_players

            //получаем карты игроков за столом  cardwars_game_player_cards + // получаем img колод игроков за столом cardwars_deck_cards

            //получаем колоды игроков за столом cardwars_game_deck_cards

            //получаем расположение гексов
            // fetchPosition() {
            //     axios.get('/games/cardposition/'+this.item.game_number).then(response =>{
            //         this.positions = response.data;
            //     })
            // },

        }
    }
</script>


