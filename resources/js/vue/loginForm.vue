<template>
    <div class="mt-5">
        <div class="card d-block mx-auto" id="loginForm" tabindex="-1" aria-labelledby="loginFormLabel">
            <div class="card-content">
                <div class="card-header">
                    <h5 class="card-title text-center" id="loginFormLabel">Please login to continue</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" v-model="loginRequest.email" aria-describedby="emailHelp">                        
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" v-model="loginRequest.password">
                        </div>
                        <div class="btn btn-primary" @click="loginClick">Login</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data:function(){
            return {
                loginRequest:{
                    email:'',
                    password:''
                },
                loading:false,
            }
        },
        methods: {
            loginClick(event){
                this.$emit("loginClick", this.loginRequest);
            }
        }
    }
</script>

<style scoped>
    #loginForm{
        max-width:400px;        
    }
</style>