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
                        key: 'is_goalie',
                        label: 'Is Goalie',
                        formatter: (value, key, item) => {
                            return value ? "Yes" : "No"
                        }
                    }
                ]
            }
        }
    }
</script>
