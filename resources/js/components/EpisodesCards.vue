<template>
    <div>
        <div v-for="(episode, index) in episodes" v-bind:key="episode.id">
            <span>シリーズ番号{{ episode.series_id }}</span>
            <button v-on:click="$emit('selectEpisode', index+1)">エピソード番号{{ episode.number }}</button>
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
    name:'EpisodesCards'
}
</script>