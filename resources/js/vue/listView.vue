<template>  
  <div>
    <div class="tableContainer">
      <div ref="studentsTable">      
      </div>
    </div>
  </div>
  <div v-if="!dataLoaded">
    <Spinner />
  </div>
</template>

<script>  
  import axios from 'axios';
  import {TabulatorFull as Tabulator} from 'tabulator-tables';
import Spinner from './spinner.vue';

  export default {    
    components:{
    Tabulator,
    Spinner
},
    data:function(){
      return{
        tabulatorTable:null,
        studentsList:[],
        dataLoaded:false
      };
    },
    props:{ tableReload:Boolean },
    emits:['rowClick'],
    watch:{
      tableReload(newVal,oldVal){        
        this.getData();
      }
    },
    methods:{
      getData(){        
        axios.get('api/students').then(response=>
        {          
          this.studentsList=[];
          this.dataLoaded=false;
          if(response.status == 200){
            this.studentsList = response.data;
            this.dataLoaded = true;
            this.tabulatorTable = 
              new Tabulator(this.$refs.studentsTable, {
                data: this.studentsList,
                height:"85vh",
                pagination:"local", //enable local pagination.
                responsiveLayout:true, // enable responsive layouts                            
                layout:"fitColumns",
                columns:[
                  { field: 'ID', title: 'Id', responsive:0, headerFilter:true },
                  { field: 'LastName', title: 'Last Name', responsive:0, headerFilter:true },
                  { field: 'FirstName', title: 'First Name', responsive:0, headerFilter:true },
                  { field: 'Gender', title: 'Gender', headerFilter:true },
                  { field: 'Age', title: 'Age', headerFilter:true },
                  { field: 'Height', title: 'Height', headerFilter:true },
                  { field: 'City', title: 'City', headerFilter:true },
                  { field: 'State', title: 'State', headerFilter:true },
                  { field: 'Country', title: 'Country', headerFilter:true },
                  { field: 'Major', title: 'Major', headerFilter:true },
                  { field: 'StudentStatus', title: 'Status', headerFilter:true },
                  { field: 'Grade', title: 'Grade', headerFilter:true },
                  { field: 'SAT', title: 'SAT score', headerFilter:true, headerFilterPlaceholder:"Min Score", headerFilterFunc:">=" },
                  { field: 'created_at', title: 'Created', headerFilter:true, headerFilterPlaceholder:"Min Created", headerFilterFunc:">=" },
                  { field: 'updated_at', title: 'Updated', headerFilter:true, headerFilterPlaceholder:"Min Updated", headerFilterFunc:">=" },
                ]
              });
              this.tabulatorTable.on("rowClick", (e, row)=>{
                this.$emit("rowClick", row.getData());
              });
          }
        });
      }
    },
    mounted:function mounted(){
      this.getData();
    },    
  }
</script>

<style>
  .tableContainer{
    min-width:1000px;
  }
  .tabulator .tabulator-footer .tabulator-paginator{
    flex:0;
  }
</style>