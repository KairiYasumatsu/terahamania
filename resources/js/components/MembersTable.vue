<template>
    <table 　border="1">
        <tr class='boys-row'>
            <td  v-for="boy in members.boys" v-bind:key="boy.id">
                <input type="radio" v-bind:id="boy.id" v-bind:value="boy.id" v-model="picked_boy_id">
                <label v-bind:for="boy.id">{{ boy.name }}</label>
                <div><img style="width:10rem;" v-bind:src='boy.image_src' alt='boy.name'></div>
            </td>
        </tr>
        <tr class='girls-row'>
            <td v-for="girl in members.girls" v-bind:key="girl.id">
                <input type="radio" v-bind:id="girl.id" v-bind:value="girl.id" v-model="picked_girl_id">
                <label v-bind:for="girl.id">{{ girl.name }}</label>
                <div><img style="width:10rem;"  v-bind:src='girl.image_src' alt='girl.name'></div>
            </td>
        </tr>
        <button v-on:click="vote">投票する</button>
    </table>
</template>
<script>
export default {
    props:{
        members: Object,
    },
    data(){
        return{
            picked_boy_id: String,
            picked_girl_id:String,
        }
    },
    methods:{
        vote: function(){
            this.$emit("vote", this.picked_boy_id, this.picked_girl_id)
        }
    },
    name:'MembersTable'
}
</script>