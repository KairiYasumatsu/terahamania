<template>
    <div>
        <count-line-chart 
            v-bind:jsonData="jsonData"
            v-bind:range="range"
        ></count-line-chart>
        <members-table 
            v-bind:members="selectedMembers"
            v-on:vote="postSelectedMemberIDs"
        ></members-table>
        <episodes-cards 
            v-on:selectEpisode="showEpisodeDetail" 
            v-bind:episodes="episodes"
        ></episodes-cards>
        <router-view/>
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
            range:{},
            selectedEpisodeID: Number,
        }
    },
    created: function () {
        axios.get('/api/episodes/')
        .then((response) => {
            this.episodes = response.data.episodes
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
            this.range = response.data[0].range
            this.jsonData = response.data[0].selectedInfo
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
            axios.post('/api/vote', {
                episode_id: this.selectedEpisodeID,
                boys_id: picked_boy_id,
                girls_id: picked_girl_id
            })
            .then((response) => {
                    console.log(response)
                    axios.get('/api/latestpair/')
                    .then((response)=>{
                        this.range = response.data[0].range
                        this.jsonData = response.data[0].selectedInfo
                    })
                    .catch((response)=>{
                        console.log(response)
                    })
                })
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