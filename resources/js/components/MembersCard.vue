<template>
    <div>
        <div v-for="episode in episodes" v-bind:key="episode.id">
            <div>{{ episode.number }}</div>
            <div>{{ episode.series_id }}</div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        episodes:{
            type: Array
        },
    },
    name:'MembersCard'
}
</script>