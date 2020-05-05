<template>
    <table 　border="1">
        <tr class='boys-row'>
            <td  v-for="boy in members.boys" v-bind:key="boy.id">
                <input type="radio" v-bind:id="boy.id" v-bind:value="boy.id" v-model="picked_boy">
                <label v-bind:for="boy.id">{{ boy.name }}</label>
            </td>
        </tr>
        <tr class='girls-row'>
            <td v-for="girl in members.girls" v-bind:key="girl.id">
                <input type="radio" v-bind:id="girl.id" v-bind:value="girl.id" v-model="picked_girl">
                <label v-bind:for="girl.id">{{ girl.name }}</label>
            </td>
        </tr>
        <button v-on:click="vote">投票する</button>
    </table>
</template>
<script>
export default {
    props:{
        members: Object
    },
    data(){
        return{
            picked_boy: String,
            picked_girl:String,
        }
    },
    methods:{
        vote: function(){
            console.log(this.picked_boy, this.picked_girl)
        }
    },
    name:'MembersTable'
}
</script>