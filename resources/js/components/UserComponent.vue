<template>
    <div class="mx-5 my-5"  v-if="view">
        <div class="mx-12">
            <div class="flex justify-cente sm:justify-end my-4">
                <div class="flex flex-col">
                    <h2 class="text-3xl font-bold my-4 shadow-2xl">AMOBASOFTWARE</h2>
                    <button @click="getOut()" v-text="userActive" class="py-2 px-4 shadow-md no-underline rounded-full bg-blue-600 text-white font-sans font-semibold text-sm border-blue btn-primary hover:text-white hover:bg-blue-light focus:outline-none active:shadow-none mr-2"></button>
                   
                </div>
                
            </div>  

            <div class="flex flex-col sm:flex-row justify-between">
                <div class="h-15 ">  
                    <div class="h-full flex flex-row rounded-2xl bg-white mx-3 px-2 py-2 mt-2 shadow-2xl">      
                       
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-20 my-2 text-orange-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                            <input type="text" class="h-14 w-full pr-4 pl-2 rounded-lg z-0 focus:shadow focus:outline-none text-2xl" placeholder="Buscar, click enter" v-on:keyup.enter="search()" v-model="searchData"> 
                       
                         
                    </div>                         
                </div>
                <div class="h-15 ">
                    <div class="h-full flex md:justify-center  mx-3 rounded-2xl bg-white px-2 py-2 mt-2 shadow-2xl">      
                        
                        <div date-rangepicker class="flex items-center flex-col md:flex-row">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input name="start" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Fecha Inicial" @change="filterDate()" v-model="dateStart">
                            </div>
                            <span class="mx-4 text-gray-500">to</span>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input name="end" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Fecha Final" @change="filterDate()" v-model="dateEnd">
                            </div>
                        </div>  
                            
                       
                         
                    </div>
                </div>
                <div class="h-15 ">
                    
                        <button class="flex flex-row justify-around items-center h-full w-full rounded-2xl  mx-3 bg-orange-600 px-2 py-2 pl-10 text-white mt-2 shadow-2xl" @click="showing = true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Nuevo Contacto
                        </button>
                    
                    
                </div>
            </div>

            

            <paginate name="users" :list="users" :per="10">
                

                <div class="mt-10 px-5 py-5" style="height:60vh;overflow-y:scroll;">
                    <div v-for="(user, index) in paginated('users')" v-bind:key="user.id">
                        <div v-if="user == 'No hay registros'">
                            <h2 v-text="user"></h2>
                        </div>
                        <div v-else>
                            <div v-if="editActive == user.id" class="flex flex-col flex-around sm:flex-row  bg-white py-2 rounded-lg mt-4 shadow-2xl">                        

                                <div class="flex flex-grow-0 justify-center items-center px-4">
                                
                                <img  v-bind:src="'img/'+user.ima_profile" alt="" class="rounded-full w-10 h-10">
                            
                                </div>                    

                                <div class="flex flex-col flex-grow-0 justify-start items-center px-4"> 
                                    <div>
                                        <label for="first_name">Nombre</label>                                  
                                        <input type="text" name="first_name"  v-model="first_name" class="border">  
                                    </div>
                                    <div>
                                        <label for="last_name">Apellido</label>                                  
                                        <input type="text" name="last_name"  v-model="last_name" class="border">           
                                    </div>
                                </div>
                                <div class="flex flex-auto  justify-start items-center px-4 col-span-5 text-justify">              
                                    <textarea id="" style="width:100%" rows="4" name="description" v-model="description"></textarea>                      
                                </div>
                                <div class="flex flex-grow-0 justify-end items-center px-4">
                                
                                    <button @click="updateUser(user.id, index)">
                                        <i class="far fa-save"></i>
                                    </button>
                                                
                                </div>

                            

                            </div>
                            <div v-else class="flex flex-col flex-around sm:flex-row  bg-white py-2 rounded-lg mt-4">
                                <div class="flex flex-grow-0 justify-center items-center px-4">
                                <img v-bind:src="'img/'+user.ima_profile" alt="" class="rounded-full w-10 h-10">
                                </div>
                                <div class="flex flex-col flex-grow-0 justify-start items-center px-4">                    
                                    <h4 class="font-bold text-lg">{{ user.first_name }} {{ user.last_name }}</h4>
                                    <button class="text-orange-600 text-sm" v-on:click="onClickDelete(index,user.id)">Eliminar</button>
                                </div>
                                <div class="flex flex-auto  justify-start items-center px-4 col-span-5 text-justify">                
                                    <p class="text-lg" v-text="user.description">
                                    
                                    </p>
                                </div>
                                <div class="flex flex-grow-0 justify-end items-center px-4">              
                                    <button @click="editing(user)">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" style="color:blue;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>                 
                                </div>

                            </div>
                        </div>
                
                        
                    
                    </div>             
                
                
                </div>
            </paginate>
           
          
            <paginate-links class="flex flex-row justify-between my-5 bg-gray-400" for="users" :simple="{
            next: 'Siguiente página',
            prev: 'Página Anterior'
            }"></paginate-links>
            <span v-if="$refs.paginator">
            Viewing {{$refs.paginator.pageItemsCount}} results
            </span>

            <div style="width:20vw;background:green;" class="rounded-2xl" v-if="alertSuccess">

                <div class="bg-lime-600 border text-white px-4 py-6 rounded relative" role="alert">
                    <div class="flex flex-row">
                        <strong class="font-bold">
                            Registro completado                       
                        </strong>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                 
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                      
                        <button  @click="alertSuccess = false">
                            <svg  class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </button>                              

                    </span>
                </div>
            </div>

            <div style="width:20vw;background:red;" class="rounded-2xl" v-if="alertDelete">

                <div class="bg-lime-600 border text-white px-4 py-6 rounded relative" role="alert">
                    <div class="flex flex-row">
                        <strong class="font-bold">
                            Registro eliminado                       
                        </strong>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                 
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                      
                        <button  @click="alertDelete = false">
                            <svg  class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </button>                             

                    </span>
                </div>
            </div>
 

        </div>
        


        <div
            v-if="showing"
            class="fixed inset-0 w-full h-screen  flex items-center justify-center bg-semi-75"
            
        >
            <div class="relative bg-white shadow-2xl rounded-lg bg-gray-200" style="height:80vh;width:60vw;">

                <div style="height:10vh;" class="flex flex-row justify-between bg-white py-4 px-4">
                    <h4 class="text-md my-2">Agregar nuevo contacto</h4>
                    <button
                        aria-label="close"  
                        class="mt-0 mr-0"                      
                        @click="showing = false"
                    >
                        x
                    </button>                    
                </div>

                <div style="height:30vh;" class="flex flex-col justify-start py-8 px-6">
                    <p v-if="errors.length">
                        <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
                        <ul>
                        <li class="text-red-600" v-for="error in errors"  v-bind:key="error.id">{{ error }}</li>
                        </ul>
                    </p>

                    <form v-on:submit.prevent="addUser()" enctype="multipart/form-data">

                        <div class="flex flex-row items-center">
                            <span>Cargar imagen</span>
                            <label
                                class="
                                    w-26
                                    flex flex-col
                                    items-center
                                    mx-2
                                    px-2
                                    py-2                              
                                    rounded-md
                                    shadow-md
                                    tracking-wide
                                    uppercase
                                    border-dashed
                                    border-4
                                    border-l-gray-600
                                    cursor-pointer
                                    hover:bg-purple-600 hover:text-white
                                    text-purple-600
                                    ease-linear
                                    transition-all
                                    duration-150
                                "
                                >          
                                <div class="my-1 mx-1 px-1 py-1 border-2 border-gray-600" style="border-right:none;border-bottom:none;"> 

                                    <div class="my-1 mx-1 py-1 px-1 border-2 border-green-600">             
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" style="color:green">
                                        <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="mt-2 text-base leading-normal"></span>
                                        <input type="file" class="hidden"  v-on:change="onChange" />
                                    </div> 
                                </div>
                                </label>
                        </div>
                        <div class="flex flex-col my-2">
                            <label for="">
                                Nombre
                                <span class="mx-1 text-red-600">
                                    *
                                </span>
                            </label>
                            <input type="text" name="first_name" v-model="user.first_name">
                        </div>
                        <div class="flex flex-col my-2">
                            <label for="">
                                Apellido
                                <span class="mx-1 text-red-600">
                                    *
                                </span>
                            </label>
                            <input type="text" name="last_name" v-model="user.last_name">
                        </div>
                        <div class="flex flex-col my-2">
                            <label for="">
                                Email
                                <span class="mx-1 text-red-600">
                                    *
                                </span>
                            </label>
                            <input type="email" name="email" v-model="user.email">
                        </div>
                        <div class="flex flex-col my-2">
                            <label for="">
                                Contraseña
                                <span class="mx-1 text-red-600">
                                    *
                                </span>
                            </label>
                            <input type="password" name="password" v-model="user.password">
                        </div>
                        <div class="flex flex-col my-2">
                            <label for="">
                                Descripción
                                <span class="mx-1 text-red-600">
                                    *
                                </span>
                            </label>
                            <textarea id="" cols="2" rows="4" name="description" v-model="user.description"></textarea>
                        </div>
                        <div class="flex justify-center">
                            <button class="bg-orange-600 mt-2 py-4 px-8 text-white">
                                Guardar
                            </button>
                        </div>
                    </form>
                    
                    
                   
                </div>


           
            </div>
        </div>
       
    </div>


    

    
</template>

<script>
   
    
    import VuePaginate from 'vue-paginate'
    Vue.use(VuePaginate)

    

    export default {
        
        data() {
            return {
              users: [],
              errors: [],
              user: {
                first_name:'',
                last_name:'',
                description:'',
                email:'',
                password:'',
                ima_profile:'',
              },
              first_name:'',
              description:'',
              last_name:'',
              searchData:'',
              dateStart:'',
              dateEnd:'',
              paginate: ['users'],
              view: false,
              showing: false,
            alertSuccess: false,
            alertDelete: false,
            editActive: false,
            userActive:'',
            validateEmail:false
              
              
        
             
            }
        },

      
        props: {
                      
        },    
           
        
        methods: {   
                      
            getUsers(){
                axios.get(this.$url + '/api/users/')
                     .then((response)=>{ 
                       this.users = response.data
                     })
            },
            getUserActive(){                
                this.userActive = localStorage.getItem("userActive") + ' Salir'                   
            },
             addUser() {   

                 this.errors = [];

                if (!this.user.first_name) {
                    this.errors.push('El nombre es obligatorio.');
                }
                if (!this.user.last_name) {
                    this.errors.push('El apellido es obligatoria.');
                }
                if (!this.user.description) {
                    this.errors.push('La descripción es obligatoria.');
                }
                if (!this.user.email) {
                    this.errors.push('El email es obligatori.');
                }
                if (!this.user.password) {
                    this.errors.push('La contraseña es obligatoria.');
                }                


                if (!this.errors.length) {    
                    this.validateEma(this.user.email)
               
                    if(this.validateEmail) {
                 
                        axios.post(this.$url + '/api/users', this.user)
                        .then((res) => {         
                            this.users.push(
                            {
                            first_name: this.user.first_name,
                            last_name: this.user.last_name,
                            description: this.user.description,
                            email: this.user.email,
                            password: this.user.password,
                            ima_profile:'user.png'
                            })                      
                            
                            this.chargeImage()
                        })
                        .catch((error) => {
                            
                        }).finally(() => {
                            
                        })
                    }
                    else
                    {
                        
                        this.errors.push('El email existe.')
                        
                    }

                }
                 
                 
            },
            onChange(e){ 
                this.user.ima_profile = e.target.files[0]; 
            },
            chargeImage(){
             
                var data = new  FormData();             
                data.append('images', this.user.ima_profile);         
                data.append('_method', 'POST');              
                axios.post(this.$url + '/api/profile',data)
                .then(response => {   
                    this.showing = false                
                    this.alertSuccess = true
                })
           
            },
            updateUser(id,index) { 
                this.user.first_name = this.first_name;
                this.user.description = this.description;
                this.user.last_name = this.last_name;
              
                axios.put(this.$url + '/api/users/'+id, this.user)
                    .then((res) => { 

                    this.getUsers()       
                    this.editActive = false   
                    
                   
                }); 
            },
            onClickDelete(index,id) { 
                
                axios.delete(this.$url + '/api/users/'+id)
                    .then((res) => {
                    this.editActive = user.id.pop(index)
                     this.alertDelete = true
                });     
                           
            },
            editing(user) {
                this.editActive = user.id;
                this.first_name = user.first_name;
                this.description = user.description;
                this.last_name = user.last_name;
            },
            search() {  
               
                axios.get(this.$url + '/api/search/'+this.searchData)
                     .then((response)=>{ 
                      this.users = response.data  
                        if(this.users.length == 0){
                            this.users.push('No hay registros')
                            
                        }                 

                     })  
                            
            },
            filterDate() {  
               if(this.dateStart != '' && this.dateEnd != '')
                axios.get(this.$url + '/api/date/'+this.dateStart+'/'+this.dateEnd)
                     .then((response)=>{ 
                        this.users = response.data
                        if(this.users.length == 0){
                            this.users.push('No hay registros')
                            
                        } 
                     }) 
            },
            viewActive() {
                this.view = true
            },
            getOut() {
                localStorage.removeItem('userActive')
                localStorage.removeItem('token')
                window.location.replace(this.$url + "/viewLogin")    
            },
            validateEma(email) {
             axios.get(this.$url + '/api/validate/email/'+email)
                .then((response)=>{ 
                   
                    this.validateEmail = response.data
                })

            }
           
         
           
        },
        created() {
            const access = axios.defaults.headers.common["authorization"] = localStorage.getItem("token")
            if(access)
            {
                this.getUsers()
                this.viewActive()
                this.getUserActive()           
                
            }
            else
            {
                window.location.replace(this.$url + "/viewLogin")     
            }   
        }
        
        
        
                
       
    }
</script>
<style lang="sass">



.paginate-list
  width: 159px
  margin: 0 auto
  text-align: left
  li
    display: block
    &:before
      content: '⚬ '
      font-weight: bold
      color: slategray
    
.paginate-links.items
  user-select: none
  a
    cursor: pointer
  
  li.active a
    font-weight: bold
  
  li.next:before
    content: ' | '
    margin-right: 13px
    color: #ddd
  
  li.disabled a
    color: #ccc
    cursor: no-drop
  
a
  color: black
  
  padding: 10px
  border: 2px solid black
  border-radius: 25px
  box-shadow: 10px 5px 5px black

::-webkit-scrollbar 
  -webkit-appearance: none
  width: 7px

::-webkit-scrollbar-thumb 
  border-radius: 4px
  background-color: rgba(0, 0, 0, .5)
  -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5)


</style>
