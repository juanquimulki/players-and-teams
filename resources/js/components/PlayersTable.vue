<template>
    <div>
        <b-table striped hover :items="items" :fields="fieldsToShow">          
        </b-table>
    </div>
</template>

<script>
    export default {
        name: 'players-table',
        props: ['items'],
        data() {
            return {
                fieldsToShow: [
                    'id',
                    'first_name',
                    'last_name',
                    'ranking',
                    {
                        key: 'can_play_goalie',
                        label: 'Can Play Goalie',
                        formatter: (value, key, item) => {
                            return value == 1 ? "Yes" : "No"
                        }
                    }
                ]
            }
        }
    }
</script>
