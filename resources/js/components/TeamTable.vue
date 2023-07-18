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
                        key: 'is_goalie',
                        label: 'Is Goalie',
                        formatter: (value, key, item) => {
                            return value ? "Yes" : ""
                        }
                    }
                ]
            }
        }
    }
</script>

<style scoped>
    th[role=columnheader] {
        background-color: #E9ECEF;
    }
</style>
