<template>

    <div class="container pt-3">


        <div class="d-flex justify-content-center">
            <div v-if="loading === true" class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <h2 class="text-success" v-if="message.status == 200"> Success ! </h2>

        <div>

            <h2>User Roles</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="data in userRoles" :key="data.id">

                        <th scope="row">{{data.id}}</th>
                        <td>{{data.name}}</td>
                        <td>{{data.email}}</td>
                        <td>{{data.roles[0].role_name}}</td>
                        <td>{{data.created_at}}</td>
                        <td v-if="data.roles[0].id !== 1">
                            <button type="button" class="btn btn-primary" data-toggle="modal" @click="sendData(data)"
                                data-target="#updateUserRole">
                                Update User
                            </button>

                            <form @submit.prevent="deleteUserRole(data)" method="delete">
                                <button type="submit" class="btn btn-danger"> Delete User
                                </button>
                            </form>

                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserRole">
                Create User
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="createUserRole" tabindex="-1" role="dialog" aria-labelledby="createUserRoleLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserRoleLabel">Create User with Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createUserRole" method="post">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input v-model="userRole.name" class="form-control" type="text" name="name" id="name"
                                    >
                            </div>

                            <div class="form-group">
                                <label for="name">Email</label>
                                <input v-model="userRole.email" class="form-control" type="text" name="email" id="email"
                                    >
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select v-model="userRole.role" class="form-control" type="text" name="role" id="role">
                                    <option v-for="data in roles" :key="data.id" :value="data.id">{{data.role_name}}</option>
                                </select>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <p v-if="loading === true" class="text-success"> Creating . . . </p>
                            <div v-if="loading === true" class="spinner-border text-success" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button @click="hideModal" type="submit" class="btn btn-success">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="updateUserRole" tabindex="-1" role="dialog" aria-labelledby="updateUserRoleLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateUserRoleLabel">Update User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form v-if="selectedUserRole != null" @submit.prevent="updateUserRole" method="put">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="selectedUserRole_name">Name</label>
                                <input v-model="selectedUserRole.name" class="form-control" type="text"
                                    name="selectedUserRole_name" id="selectedUserRole_name" >
                            </div>

                            <div class="form-group">
                                <label for="selectedUserRole_email">Role Email</label>
                                <input v-model="selectedUserRole.email" class="form-control" type="text"
                                    name="selectedUserRole_email" id="selectedUserRole_email" placeholder="Enter Role email">
                            </div>
                            
                             <div class="form-group">
                                <label for="role">Role</label>
                                <select v-model="selectedUserRole.role" class="form-control" type="text" name="role" id="role">
                                    <option :value="selectedUserRole.roles[0].id">Current Role: {{selectedUserRole.roles[0].role_name}}</option>
                                    <option v-for="data in roles" :key="data.id" :value="data.id">{{data.role_name}}</option>
                                    </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <p v-if="loading === true" class="text-success"> Updating . . . </p>
                            <div v-if="loading === true" class="spinner-border text-success" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button @click="hideModal" id="btnSave" type="submit" class="btn btn-success">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>


</template>

<script>
    import axios from 'axios';
    import _ from 'lodash';

    export default {

        data() {
            return {
                userRoles: {},
                userRole: {},
                loading: true,
                message: '',
                selectedUserRole: null,
                roles: {},
            }
        },

        beforeMount() {
            this.getUserRoles();
            this.getRoles();
        },

        methods: {

            async getRoles() {
                await axios.get('/get/roles').then(response => {
                    this.roles = response.data;
                    this.loading = false;
                });
            },

            hideModal() {
                $('#updateUserRole').modal('hide');
                $('#createUserRole').modal('hide');
            },

            async getUserRoles() {
                await axios.get('/get/userroles').then(response => {
                    this.userRoles = response.data;
                    this.loading = false;
                })
            },

            async createUserRole() {
                this.loading = true;
                await axios.post('/insert/userroles', this.userRole).then(response => {
                    this.message = response;
                    this.getUserRoles();
                });

            },

            async updateUserRole() {
                this.loading = true;
                await axios.put('/update/userroles', this.selectedUserRole).then(response => {
                    this.message = response;
                    this.getUserRoles();
                });
            },

            async deleteUserRole(data) {


                this.loading = true;
                await axios.delete('/delete/userroles', {
                    params: {
                        'id': data.id
                    }
                }).then(response => {
                    console.log(data);

                    this.message = response;
                   this.getUserRoles();

                });
            },

            sendData(userRole) {

                console.log(userRole);


                this.selectedUserRole = userRole;

            }


        }



    }

</script>

<style>

</style>
