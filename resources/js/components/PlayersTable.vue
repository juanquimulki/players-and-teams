<template>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Ranking</th>
                    <th>Is Goalie</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in items" :key="item.id">
                    <td>
                        {{ item.id }}
                    </td>
                    <td>
                        {{ item.first_name }}
                    </td>
                    <td>
                        {{ item.last_name }}
                    </td>
                    <td>
                        {{ item.ranking }}
                    </td>
                    <td>
                        {{ showIsGoalie(item.is_goalie) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'players-table',
        props: ['items'],
        data() {
            return {
                // fieldsToShow: [
                //     'id',
                //     'first_name',
                //     'last_name',
                //     'ranking',
                //     {
                //         key: 'is_goalie',
                //         label: 'Is Goalie',
                //         formatter: (value, key, item) => {
                //             return value ? "Yes" : "No"
                //         }
                //     }
                // ]
            }
        },
        methods: {
            showIsGoalie(value) {
                return value ? "Yes" : "No";
            },
        }
    }
</script>

<style scoped>
    table {
        margin-top: 20px;
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid black;
    }
    th {
        text-align: center;
        padding: 10px;
    }
    td {
        padding: 5px;
    }
</style>
