<template>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="card-title" v-if="insert">Add New Student</h5>
                <h5 class="card-title" v-else="insert">Student Id: {{selectedStudent?.ID}}</h5>
                <button class="btn btn-default" @click="closeModalClick">
                    <font-awesome icon="remove" />
                </button>
            </div>
        </div>
        <div class="card-body">
            <div v-if="working">
                <Spinner class="p-5" />
            </div>
            <div v-else="loading">
                <form>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="firstName" class="form-label">First Name*</label>
                            <input type="text" class="form-control" id="firstName" v-model="selectedStudent.FirstName" required>
                        </div>
                        <div class="col">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" v-model="selectedStudent.LastName">
                        </div>
                    </div>                
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="gender" class="form-label">Gender*</label>
                            <select class="form-select" id="gender" v-model="selectedStudent.Gender" required>
                                <option selected>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="age" class="form-label">Age*</label>
                            <input type="number" class="form-control" id="age" v-model="selectedStudent.Age" required/>
                        </div>
                        <div class="col">
                            <label for="height" class="form-label">Height*</label>
                            <input type="number" min="0" max="1000" class="form-control" id="height" v-model="selectedStudent.Height" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" v-model="selectedStudent.City">
                        </div>
                        <div class="col">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" v-model="selectedStudent.State">
                        </div>
                        <div class="col">
                            <label for="country" class="form-label">Country*</label>
                            <input type="text" class="form-control" id="country" v-model="selectedStudent.Country" required>
                        </div>
                    </div>  
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="major" class="form-label">Major*</label>
                            <input type="text" class="form-control" id="major" v-model="selectedStudent.Major" required>
                        </div>
                        <div class="col">
                            <label for="status" class="form-label">Status*</label>
                            <select class="form-select" id="status" v-model="selectedStudent.StudentStatus" required>
                                <option selected>Undergraduate</option>
                                <option>Graduate</option>
                            </select>
                        </div>                    
                    </div> 
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="grade" class="form-label">Grade*</label>
                            <input type="number" min="0" max="100" class="form-control" id="grade" v-model="selectedStudent.Grade" required>
                        </div>
                        <div class="col">
                            <label for="satscore" class="form-label">SAT Score*</label>
                            <input type="number" min="0" max="2400" class="form-control" id="satscore" v-model="selectedStudent.SAT" required>
                        </div>
                    </div>
                    <div class="mb-3" v-if="!insert">
                        <div v-if="selectedStudent.created_at"> Created At: {{showDateTime(selectedStudent.created_at)}} </div>
                        <div v-if="selectedStudent.updated_at"> Updated At: {{showDateTime(selectedStudent.updated_at)}} </div>
                    </div>
                    <div class="btn btn-primary" v-if="insert" @click="addStudent">Add</div>
                    <div class="btn btn-danger" v-if="!insert" @click="deleteStudent">Delete</div>
                    <div :class="[working? 'd-none':'btn btn-primary float-end']" v-if="!insert" @click="updateStudent">Update</div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import moment from 'moment';
    import {closeModal} from "jenesius-vue-modal"
    import Spinner from './spinner.vue';

    export default {
        components: { Spinner },
        props: {
            selectedStudent: {},
            insert: Boolean,
        },
        data:function(){
            return {
                working:false,
            }
        },
        methods: {
            addStudent(event) {
                if (this.selectedStudent.ID != null) {
                    closeModal();
                }
                this.working=true;
                axios.post("api/student/store", this.selectedStudent).then(response => {
                    if (response.status == 201) {                        
                        this.refreshTable();
                        closeModal();
                    }
                    this.working=false;
                });
            },
            updateStudent(event) {
                if (this.selectedStudent.ID == null) {
                    closeModal();
                }
                this.working=true;
                axios.put("api/student/" + this.selectedStudent.ID, this.selectedStudent).then(response => {
                    if (response.status == 200) {                        
                        this.refreshTable();
                        closeModal();
                    }
                    this.working=false;
                });
            },
            deleteStudent(event) {
                if (this.selectedStudent.ID == null) {
                    closeModal();
                }
                this.working=true;
                axios.delete("api/student/" + this.selectedStudent.ID).then(response => {
                    if (response.status == 200) {
                        this.refreshTable();
                        closeModal();
                    }
                    this.working=false;
                });                
            },
            showDateTime(value) {
                if (value != null)
                    return moment(String(value)).format("MM/DD/YYYY hh:mm");
                else
                    return "";
            },
            refreshTable() {
                this.$emit("tableRefresh");
            },
            closeModalClick(event) {
                closeModal();
            }
        },    
    }
</script>

<style scoped>
    .card{
        min-width:30vw;
    }
</style>