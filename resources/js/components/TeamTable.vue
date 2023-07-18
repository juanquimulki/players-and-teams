<template>
    <div>
        <b-table bordered small :items="items" :fields="fieldsToShow">          
        </b-table>
    </div>
</template>

<script>
    export default {
        name: 'team-table',
        props: ['items'],
        data() {
            return {
                fieldsToShow: [
                    'full_name',
                    'ranking',
                    {
                        key: 'can_play_goalie',
                        label: 'Is Goalie',
                        formatter: (value, key, item) => {
                            return value == 1 ? "Yes" : ""
                        }
                    }
                ]
            }
        }
    }
</script>

<style>
    th[role=columnheader] {
        background-color: #E9ECEF;
    }
</style>
