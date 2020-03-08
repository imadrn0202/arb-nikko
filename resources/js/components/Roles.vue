<template>

    <div class="container pt-3">


        <div class="d-flex justify-content-center">
            <div v-if="loading === true" class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <h2 class="text-success" v-if="message.status == 200"> Success ! </h2>

        <div>

            <h2>Roles</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="data in roles" :key="data.id">
                        <th scope="row">{{data.id}}</th>
                        <td>{{data.role_name}}</td>
                        <td>{{data.description}}</td>
                        <td>{{data.created_at}}</td>
                        <td v-if="data.id !== 1">
                            <button type="button" class="btn btn-primary" data-toggle="modal" @click="sendData(data)"
                                data-target="#updateRole">
                                Update Role
                            </button>


                            <form @submit.prevent="deleteRole(data)" method="delete">
                                <button type="submit" class="btn btn-danger"> Delete Role
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createRole">
                Create Role
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="createRole" tabindex="-1" role="dialog" aria-labelledby="createRoleLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createRoleLabel">Create Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createRole" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="role_name">Role Name</label>
                                <input v-model="role.role_name" class="form-control" type="text" name="role_name"
                                    id="role_name" >
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea v-model="role.description" class="form-control" name="description"
                                    id="description" cols="30" rows="10"></textarea>
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
        <div class="modal fade" id="updateRole" tabindex="-1" role="dialog" aria-labelledby="updateRoleLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateRoleLabel">Create Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateRole" method="put">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="selectedRole_name">Role Name</label>
                                <input v-model="selectedRole.role_name" class="form-control" type="text"
                                    name="selectedRole_name" id="selectedRole_name" >
                            </div>
                            <div class="form-group">
                                <label for="selectedRole_description">Description</label>
                                <textarea v-model="selectedRole.description" class="form-control"
                                    name="selectedRole_description" id="selectedRole_description" cols="30"
                                    rows="10"></textarea>
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
                roles: {},
                role: {},
                loading: true,
                message: '',
                selectedRole: {},
            }
        },

        beforeMount() {
            this.getRoles();
        },

        methods: {

            hideModal() {
                $('#updateRole').modal('hide');
                $('#createRole').modal('hide');
            },

            async getRoles() {
                await axios.get('/get/roles').then(response => {
                    this.roles = response.data;
                    this.loading = false;
                });
            },

            async createRole() {
                this.loading = true;
                await axios.post('/insert/roles', this.role).then(response => {
                    this.message = response;
                    this.getRoles();
                });

            },

            async updateRole() {
                this.loading = true;
                await axios.put('/update/roles', this.selectedRole).then(response => {
                    this.message = response;
                    this.getRoles();

                });
            },

            async deleteRole(data) {


                this.loading = true;
                await axios.delete('/delete/roles', {
                    params: {
                        'id': data.id
                    }
                }).then(response => {
                    console.log(data);

                    this.message = response;
                    this.getRoles();

                });
            },

            sendData(role) {

                console.log(role);
                this.selectedRole = role;
            }


        }



    }

</script>

<style>

</style>
