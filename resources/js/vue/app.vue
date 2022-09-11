<template>
  <div v-if="loading">
    <spinner />
  </div>
  <div v-else="loading">
    <div class="p-2" v-if="loggedIn">
      <div class="studentsContainer">
        <div class="heading">
          <h2 id="title">Students List</h2>
        </div>
      </div>

      <div class="mt-2">
        <button class="btn btn-primary btn-sm mb-3" @click="addStudent">
          <font-awesome icon="plus" /> Add New Student
        </button>
      </div>
      
      <list-view @row-click="rowClickHandler" :tableReload="tableReloadTrigger" />  
    </div>

    <div class="p-2" v-if="!loggedIn">
      <login-form @login-click="loginClickHandler" />
    </div>
  </div>
  <widget-container-modal />
</template>
<script>
  import loginForm from './loginForm.vue';
  import listView from './listView.vue';  
  import {container,openModal} from "jenesius-vue-modal";
  import DetailsView from './detailsView.vue';
import Spinner from './spinner.vue';

  export default {
    components:{
    loginForm,
    listView,
    WidgetContainerModal: container,
    Spinner
},
    data:function(){
      return {
        loggedIn:false,
        loading:false,
        selectedStudent:{},
        tableReloadTrigger:false,
      }
    },
    methods:{
      loginClickHandler(loginRequest){
        this.loading=true;
        axios.post('api/account/login',loginRequest).then(
            response=>{
                if(response.status == 200 && response.data == true)
                  this.loggedIn=true;

                this.loading = false;
            }
        );
      },
      async rowClickHandler(data){
        this.selectedStudent = data;
        const modal = await openModal(DetailsView, {'selectedStudent':this.selectedStudent,'insert':false});
        modal.on('tableRefresh', v => {
            this.refreshTableHandler();
        })
      },
      refreshTableHandler(){
        this.tableReloadTrigger = !this.tableReloadTrigger;
      },
      async addStudent(event){
        this.selectedStudent = {};
        const modal = await openModal(DetailsView, {'selectedStudent':this.selectedStudent,'insert':true});
        modal.on('tableRefresh', v => {
          this.refreshTableHandler();
        })
      }
    }
  }
</script>

<style scoped>
  .studentsContainer{
    margin:auto;
  }

  .heading{
    background:#e6e6e6;
    padding: 10px;
  }

  #title{
    text-align: center;
  }
</style>