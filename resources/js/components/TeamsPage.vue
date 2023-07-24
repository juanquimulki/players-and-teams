<template>
    <div class="row">
        <div class="col" v-for="(team, index) in items" :key="index">
            <div class="team-name">Team #{{ index + 1 }}: {{ team.name }}</div>
            <div>
                <team-table :items="team.players"></team-table>
            </div>
            <div class="team-results">
                <div class="row">
                    <div class="col">Team Size:</div>
                    <div class="col team-results-value">{{ team.size }}</div>
                </div>
                <div class="row">
                    <div class="col">Total Ranking:</div>
                    <div class="col team-results-value">{{ team.totalRanking }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'teams-page',
        props: ['items'],
    }
</script>

<style scoped>
    .team-name {
        background-color: #9A8C98;
        color: #FFFFFF;
        padding: 15px;
        font-weight: 500;
        border-radius: 20px 20px 0px 0px;
        min-height: 80px;
    }
    .team-results {
        padding: 10px;
        background-color: #C9ADA7;
        color: #FFFFFF;
        font-weight: 500;
        border-radius: 0px 0px 5px 5px;
    }
    .team-results-value {
        text-align: right;
    }
</style>
