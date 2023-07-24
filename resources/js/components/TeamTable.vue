<template>
    <div>
        <table>
            <thead>
              <tr>
                  <th>
                      Name
                  </th>
                  <th>
                      Ranking
                  </th>
                  <th>
                      Goalie
                  </th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="item in items" :key="item.id">
                    <td>
                        {{ item.full_name }}
                    </td>
                    <td>
                        {{ item.ranking }}
                    </td>
                    <td>
                        <div class="is-goalie" v-if="item.is_goalie">✓</div>
                    </td>
                </tr>
            </tbody>
<!--            <template #cell(is_goalie)="data">-->
<!--                <div class="is-goalie" v-if="data.item.is_goalie">✓</div>-->
<!--            </template>-->
        </table>
    </div>
</template>

<script>
    export default {
        name: 'team-table',
        props: ['items'],
        data() {
            return {
                // fieldsToShow: [
                //     {
                //         key: 'full_name',
                //         label: 'Name'
                //     },
                //     'ranking',
                //     {
                //         key: 'is_goalie',
                //         label: 'Goalie',
                //     }
                // ]
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
