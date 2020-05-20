<template>
    <div>
        <div>
	<h1>ユーザ詳細</h1>
	<ul>
		<li>User name: {{ member.name }}</li>
        <li>User occupation: {{ member.occupation }}</li>
        <li>User birth date: {{ member.birth_date }}</li>
        <li>User image url: {{ member.image_src }}</li>
	</ul>
	</div>
    </div>
</template>

<script>
	export default {
		data(){
			return {
				id: this.$route.params.id,
				member: ''
			}
		},
		created(){
            axios.get('/api/member/'+this.id)
            .then(response => this.member = response.data.member)
            .catch((response)=>{
                console.log(response)
            })
		}
	}
</script>