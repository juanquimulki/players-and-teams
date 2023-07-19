<template>
    <div class="row">
        <div class="col-3" v-for="team in items">
            {{ team.name }}
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
</style>
