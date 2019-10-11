<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <router-link to="/" class="nav-link">Hobie-App</router-link>
      </li>
    </ul>

    <ul v-if="auth =='loggedin'" class = "navbar nav">
      <!-- </li  class = "nav-item"><router-link to="/register" class="nav-link">{{auth}}</router-link></li> -->
       </li class = "nav-item nav-link"><a @click="logout" class="nav-link" style="color: white">Logout</a></li>
      
    </ul>   
    <ul v-else class = "navbar nav">
        </li  class = "nav-item"><router-link to="/register" class="nav-link">Register</router-link></li>
       </li  class = "nav-item"><router-link to="/login" class="nav-link">Login</router-link></li>
    </ul>

    
    
  </div>
</nav>

    </div>
</template>

<script>
import EventBus from './EventBus'

export default{
    name:'navbar',
    props:['User'],
    data(){
        return {
            auth:'',
            user:''
        }
    },
    methods:{
      logout(){
        localStorage.removeItem('userToken');
        this.auth ='';
        this.$router.push({name:"Login"})
      }
    },
    mounted(){
      EventBus.$on('logged-in', status=>{
        this.auth = status;
        console.log(this.auth)
      });
      
      console.log(this.auth)
    }
}
</script>  