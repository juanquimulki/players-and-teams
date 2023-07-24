<template>
    <div class="navbar">
        Players and Teams
        <div>
            <a href="players">Go to Players</a>
            <a href="teams">Go to Teams</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'navbar-component',
    }
</script>

<style scoped>
    .navbar {
        color: white;
        background-color: #4A4E69;
        padding: 20px;
        font-size: 18px;
        border-radius: 5px;
        margin-top: 5px;
    }
</style>
