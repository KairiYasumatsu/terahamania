<template>
    <div>
        <members-table v-bind:members="selectedMembers"></members-table>
        <episodes-cards v-on:selectEpisode="showEpisodeDetail" v-bind:episodes="episodes"></episodes-cards>
    </div>
</template>

<script>
import membersTable from '../components/MembersTable.vue'
import episodesCards from '../components/EpisodesCards.vue'
export default {
    data(){
        return{
            episodes: [],
            selectedMembers: {}
        }
    },
    created: function () {
        console.log(this.episodes)
        axios.get('/api/episodes/')
        .then((response) => {
            this.episodes = response.data.episodes
            console.log(response.data.episodes[response.data.episodes.length-2].id)
            return response.data.episodes[response.data.episodes.length-2].id
        })
        .then((id)=>{
            console.log(id)
            axios.get('/api/episode/'+id)
            .then(response => this.selectedMembers = response.data)
        })
        .catch(response => console.log(response))
    },
    methods: {
        showEpisodeDetail: function(index){
            console.log(index)
            axios.get('/api/episode/'+index)
            .then(response => this.selectedMembers = response.data)
            .catch(response => console.log(response))
        }
    },
    name: 'Top',
    components: {
        episodesCards,
        membersTable,
    }
}
</script>