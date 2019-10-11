<template>
	
  	<div class="container">
  		<div class="card">
  			<div class="card-header">Register</div>
  			<div class = "card-body">
  				<div class="col-md-6 offset-md-3">
  					
  					<form  @submit.prevent="register">
  						<h2 class="h3 mb-3 font-weight-normal text-centre">Fill The Form Below To Register</h2>
  						<div class="form-group">
  							<label>Name</label>
  							<input v-model="name" type="text" class ="form-control" name="name">
  							
  						</div>
  						<div class="form-group">
  							<label>Email</label>
  							<input v-model="email" type="email" class ="form-control" name="email">
  							
  						</div>
  						<div class="form-group">
  							<label>Phone Number</label>
  							<input v-model="phone_num" type="number" class ="form-control" name="phone_num">
  							
  						</div>
  						<div class="form-group">
  							<label>Password</label>
  							<input v-model="password" type="password" class ="form-control" name="password">
  							
  						</div>
  						<div class="form-group">
  							<button class="btn btn-dark btn-lg btn-block">Register</button>
						</div>
  					</form>
  				</div>
  			<div class="col-md-6 offset-md-6"></div>	
  			</div>
  			
  		</div>

 	</div>

</template>	

<script type="text/javascript">
	
	import EventBus from './EventBus'
	

	export default {
		name:'register',
		data(){
			return{
				email:'',
				password:'',
				name:'',
				phone_num:''
			}
		},
		methods:{
			register(){
				axios.post('api/user/register',{
					email:this.email,
					password:this.password,
					name:this.name,
					phone_num:this.phone_num
				})
				.then((res)=>{
					console.log(res)
					// localStorage.setItem('userToken',res.data.token)
					// this.email =''
					// this.password=''
					// this.name =''
					// this.phone_num=''
					this.$router.push({name:"Login"})
				})
				.catch((err)=>{
					console.log(err)
				})

				//this.emit()
			}
			// emit(){
			// 	EventBus.$emit('logged-in','loggedin');
			// 	console.log('emmited')
			// }
		}

	}
</script>
