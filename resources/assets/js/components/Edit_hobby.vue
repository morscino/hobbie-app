<template>
	<div class="container">
  		<div class="card">
  			<div class="card-header">Edit Hobby</div>
  			<div class = "card-body">
  				<div class="col-md-6 offset-md-3">
  					
  					<form @submit.prevent="addHobby">
  						
  						<div class="form-group">
  							<label>Hobby Name</label>
  							<input type="text" v-model="name"class ="form-control" name="name" value="">
  							
  						</div>
  						
  						<div class="form-group">
  							<label>Hobby Category</label>
  							<input type="text" v-model = "category" class ="form-control" value="" name="category">
  							
  						</div>
  						<div class="form-group">
  							<button class="btn btn-dark btn-lg btn-block">Save</button>
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
		name:'hobby',
		
		data(){
			return{
				name:'',
				category:'',
				hobby:[]
				
			}
		},
		
		methods:{
			getHobbies(){
				axios.get('api/hobby',{
					headers:{
						Authorization:`Bearer ${localStorage.getItem('userToken')}`
					}
				})
				.then((res)=>{
					console.log(res.data)
					this.hobbies = res.data.hobbies;
					
					
				})
				.catch((err)=>{
					console.log(err)
				})

				
			},
			editHobby(){
				var data = {
					name:this.name,
					category:this.category
				}
				axios.post('api/hobby/create',data,{
					
					
					headers:{

						'Authorization':`Bearer ${localStorage.getItem('userToken')}`
					}
					
				})
				.then((res)=>{
					console.log(res.data)
					this.hobby = res.data;
					this.$router.push({name:"Hobby"})
					
				})
				.catch((err)=>{
					console.log(err)
				})

			}

		}

	}
</script>