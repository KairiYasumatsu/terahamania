<template>
    <div>
        <count-line-chart style="width:50%;" v-bind:jsonData="jsonData"></count-line-chart>
        <members-table 
          v-bind:members="selectedMembers"
          v-on:vote="postSelectedMemberIDs"
        ></members-table>
        <episodes-cards v-on:selectEpisode="showEpisodeDetail" v-bind:episodes="episodes"></episodes-cards>
    </div>
</template>

<script>
import membersTable from '../components/MembersTable.vue'
import episodesCards from '../components/EpisodesCards.vue'
import countLineChart from '../components/CountLineChart.vue'
export default {
    data(){
        return{
            episodes: [],
            selectedMembers: {},
            jsonData: {},
            selectedEpisodeID: Number,
        }
    },
    created: function () {
        axios.get('/api/episodes/')
        .then((response) => {
            this.episodes = response.data.episodes
            console.log(response.data.episodes[response.data.episodes.length-2].id)
            return response.data.episodes[response.data.episodes.length-2].id
        })
        .then((id)=>{
            this.selectedEpisodeID = id
            axios.get('/api/episode/'+id)
            .then(response => this.selectedMembers = response.data)
        })
        .catch(response => console.log(response))

        axios.get('/api/latestpair/')
        .then((response)=>{
            this.jsonData = response.data[0]
        })
        .catch((response)=>{
            console.log(response)
        })
    },
    methods: {
        showEpisodeDetail: function(index){
            this.selectedEpisodeID = index
            this.axios.get('/api/episode/'+index)
            .then(response => this.selectedMembers = response.data)
            .catch(response => console.log(response))
        },
        postSelectedMemberIDs: function(picked_boy_id, picked_girl_id){
            console.log(this.selectedEpisodeID)
            this.axios.post('/api/vote?episode_id='+this.selectedEpisodeID+'&boy_id='+picked_boy_id+'&girl_id='+picked_girl_id,null)
            .then(response => console.log(response))
            .catch(response => console.log(response))
        }
    },
    name: 'Top',
    components: {
        episodesCards,
        membersTable,
        countLineChart,
    }
}
</script>