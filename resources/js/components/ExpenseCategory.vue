<template>

    <div class="container pt-3">


        <div class="d-flex justify-content-center">
            <div v-if="loading === true" class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <h2 class="text-success" v-if="message.status == 200"> Saved At Database ! </h2>
         <h2 class="text-danger" v-if="message.exception && message.status != 200"> {{ message }} </h2>

        <div>

            <h2>Expense Category</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Display Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="data in expenseCategories" :key="data.id">
                        <th scope="row">{{data.id}}</th>
                        <td>{{data.display_name}}</td>
                        <td>{{data.description}}</td>
                        <td>{{data.created_at}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" @click="sendData(data)"
                                data-target="#updateExpenseCategory">
                                Update Expense Category
                            </button>


                            <form @submit.prevent="deleteExpenseCategory(data)" method="delete">
                                <button type="submit" class="btn btn-danger"> Delete Expense Category
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createExpenseCategory">
                Create ExpenseCategory
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="createExpenseCategory" tabindex="-1" role="dialog"
            aria-labelledby="createExpenseCategoryLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createExpenseCategoryLabel">Create ExpenseCategory</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createExpenseCategory" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="expense_category_name">Expense Category Name</label>
                                <input v-model="expenseCategory.display_name" class="form-control" type="text"
                                    name="expense_category_name" id="expense_category_name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea v-model="expenseCategory.description" class="form-control" name="description"
                                    id="description" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <p v-if="loading === true" class="text-success"> Creating . . . </p>
                            <div v-if="loading === true" class="spinner-border text-success" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="updateExpenseCategory" tabindex="-1" role="dialog"
            aria-labelledby="updateExpenseCategoryLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateExpenseCategoryLabel">Create ExpenseCategory</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateExpenseCategory" method="put">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="selectedExpenseCategory_name">ExpenseCategory Name</label>
                                <input v-model="selectedExpenseCategory.display_name" class="form-control" type="text"
                                    name="selectedExpenseCategory_name" id="selectedExpenseCategory_name">
                            </div>
                            <div class="form-group">
                                <label for="selectedExpenseCategory_description">Description</label>
                                <textarea v-model="selectedExpenseCategory.description" class="form-control"
                                    name="selectedExpenseCategory_description" id="selectedExpenseCategory_description"
                                    cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <p v-if="loading === true" class="text-success"> Updating . . . </p>
                            <div v-if="loading === true" class="spinner-border text-success" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button id="btnSave" type="submit" class="btn btn-success">Save
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
                expenseCategories: {},
                expenseCategory: {},
                loading: true,
                message: '',
                selectedExpenseCategory: {},
            }
        },

        beforeMount() {
            this.getExpenseCategory();
        },

        methods: {

            hideModal() {
                $('#updateExpenseCategory').modal('hide');
                $('#createExpenseCategory').modal('hide');
            },

            async getExpenseCategory() {
                await axios.get('/get/expensecategory').then(response => {
                    this.expenseCategories = response.data;
                    this.loading = false;
                });
            },

            async createExpenseCategory() {
                this.loading = true;
                await axios.post('/insert/expensecategory', this.expenseCategory).then(response => {
                    this.message = response;
                    this.getExpenseCategory();
                });

            },

            async updateExpenseCategory() {
                this.loading = true;
                await axios.put('/update/expensecategory', this.selectedExpenseCategory).then(response => {
                    this.message = response;
                    this.getExpenseCategory();

                });
            },

            async deleteExpenseCategory(data) {


                this.loading = true;
                await axios.delete('/delete/expensecategory', {
                    params: {
                        'id': data.id
                    }
                }).then(response => {
                    console.log(data);

                    this.message = response;
                    this.getExpenseCategory();

                }).catch(error => {
                    this.message = error;
                });
            },

            sendData(role) {

                console.log(role);
                this.selectedExpenseCategory = role;
            }


        }



    }

</script>

<style>

</style>
