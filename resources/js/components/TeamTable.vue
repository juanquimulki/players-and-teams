<template>
    <div>
        <b-table bordered small :items="items" :fields="fieldsToShow">
            <template #cell(is_goalie)="data">
                <div class="is-goalie" v-if="data.item.is_goalie">✓</div>
            </template>
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
                    {
                        key: 'full_name',
                        label: 'Name'
                    },
                    'ranking',
                    {
                        key: 'is_goalie',
                        label: 'Goalie',
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
    .is-goalie {
        text-align: center;
    }
    table {
        font-size: 12px;
    }
</style>
