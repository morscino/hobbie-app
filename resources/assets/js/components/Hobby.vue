<template>
    <div class = "container">
    	<div class="card">
  			<div class="card-header">Hobbies</div>
  				<button type="button" @click="addHobby" class="btn btn-sm btn-success offset-md-9 mb-3 mt-2 mr-4">Add hobby</button>
		        <table class="table table-striped">
				  <thead>
				    <tr>
				      
				      <th scope="col">Name</th>
				      <th scope="col">Category</th>
				      <th scope="col">Created</th>
				      <th scope="col">Updated</th>
				      <th scope="col">Operations</th>
				    </tr>
				  </thead>
				  <tbody>
				  	
					  	<tr v-for="hobby in hobbies" v-bind:key="hobby.id">
					      
					      <td>{{hobby.name}}</td>
					      <td>{{hobby.category}}</td>
					      <td>{{hobby.created_at}}</td>
					      <td>{{hobby.updated_at}}</td>
					      <td><button @click="editHobby(hobby.id)" class="btn btn-sm btn-primary">edit</button>
					      	<button @click="deleteHobby(hobby.id)" class="btn btn-sm btn-danger">delete</button>
					      </td>


					    </tr>
				  	
				    
				   
				  </tbody>
				</table>
			</div>	
    </div> 
</template>


<script type="text/javascript">
	
	import EventBus from './EventBus'
	

	export default {
		name:'hobby',
		props:['Hobby'],
		data(){
			return{
				hobbies:[],
				
			}
		},
		created(){
			this.getHobbies()
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
			deleteHobby(id){
				if(confirm("Are you sure you want to delete hobby")){
						axios.delete('api/hobby/delete/'+id,{
						headers:{
							Authorization:`Bearer ${localStorage.getItem('userToken')}`
						}
						
					})
					.then((res)=>{
					console.log(res.data)
					alert("Hobby Deleted");
					this.getHobbies()
					
					
				})
				.catch((err)=>{
					console.log(err)
				})	
				}
			},
			addHobby(){
				this.$router.push({name:"Add_Hobby"})
			},
			editHobby(id){
				this.$router.push({name:"Edit_Hobby"})
			}

		}

	}
</script>