<template>
	<div class="container">
  		<div class="card">
  			<div class="card-header">Login</div>
  			<div class = "card-body">
  				<div class="col-md-6 offset-md-3">
  					
  					<form @submit.prevent="login">
  						
  						<div class="form-group">
  							<label>Email</label>
  							<input type="email" v-model="email"class ="form-control" name="email">
  							
  						</div>
  						
  						<div class="form-group">
  							<label>Password</label>
  							<input type="password" v-model = "password" class ="form-control" name="password">
  							
  						</div>
  						<div class="form-group">
  							<button class="btn btn-dark btn-md">Login</button>
						</div>
  					</form>
  				</div>
  			
  			
  		</div>
	</div>
 	</div>
</template>

<script type="text/javascript">
	
	import EventBus from './EventBus'
	

	export default {
		name:'user',
		data(){
			return{
				email:'',
				password:''
			}
		},
		methods:{
			login(){
				axios.post('api/user/login',{
					email:this.email,
					password:this.password
				})
				.then((res)=>{
					console.log(res)
					localStorage.setItem('userToken',res.data.token)
					this.email =''
					this.password=''
					this.$router.push({name:"Hobby"})
				})
				.catch((err)=>{
					console.log(err)
				})

				this.emit()
			},
			emit(){
				EventBus.$emit('logged-in','loggedin');
				console.log('emmited')
			}
		}

	}
</script>