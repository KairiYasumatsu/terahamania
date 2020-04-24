<template>
    <div>
        <MembersCard v-bind:episodes="episodes"></MembersCard>
    </div>
</template>

<script>
import MembersCard from '../components/MembersCard.vue'
export default {
    data(){
        return{
            episodes: []
        }
    },
    created: function () {
        console.log(this.episodes)
        axios.get('/api/episodes/')
        .then(response => this.episodes = response.data.episodes)
        .catch(response => console.log(response))
    },
    name: 'top',
    components: {
        MembersCard,
    }
}
</script>