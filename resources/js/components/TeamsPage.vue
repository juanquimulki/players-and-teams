<template>
    <div class="row">
        <div class="col-3" v-for="(team, index) in items" :key="index">
            <div class="team-name">Team #{{ index + 1 }}: {{ team.name }}</div>
            <div>
                <team-table :items="team.players"></team-table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'teams-page',
        props: ['items'],
        data() {
            return {}
        }
    }
</script>

<style scoped>
    .team-name {
        background-color: #9A8C98;
        color: white;
        padding: 10px;
        font-weight: 500;
        margin: 5px;
        border-radius: 3px;
    }
</style>
