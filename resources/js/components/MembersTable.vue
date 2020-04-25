<template>
    <table 　border="1">
        <tr class='boys-row'>
            <td  v-for="boy in members.boys" v-bind:key="boy.id">名前:{{ boy.name }}</td>
        </tr>
        <tr class='girls-row'>
            <td v-for="girl in members.girls" v-bind:key="girl.id">名前:{{ girl.name }}</td>
        </tr>
    </table>
</template>
<script>
export default {
    props:{
        members: Object
    },
    name:'MembersTable'
}
</script>