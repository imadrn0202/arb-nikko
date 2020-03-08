<template>

    <div class="container pt-3">


        <div class="d-flex justify-content-center">
            <div v-if="loading === true" class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <h2 class="text-success" v-if="message.status == 200"> Saved At Database ! </h2>

        <div>

            <h2>Expense</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Expense Category</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Entry Date</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="data in expenses" :key="data.id">
                        <th scope="row">{{data.id}}</th>
                        <td>{{data.expense_category.display_name}}</td>
                        <td>{{data.amount}}</td>
                        <td>{{data.entry_date}}</td>
                        <td>{{data.created_at}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" @click="sendData(data)"
                                data-target="#updateExpense">
                                Update Expense
                            </button>


                            <form @submit.prevent="deleteExpense(data)" method="delete">
                                <button type="submit" class="btn btn-danger"> Delete Expense
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createExpense">
                Create Expense
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="createExpense" tabindex="-1" role="dialog" aria-labelledby="createExpenseLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createExpenseLabel">Create Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createExpense" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="expense_category_name">Expense Category Name</label>
                                <select v-model="expense.category_id" class="form-control" type="text"
                                    name="expense_category_name" id="expense_category_name">

                                    <option v-for="expenseCategory in expenseCategories" :key="expenseCategory.id"
                                        :value="expenseCategory.id">{{expenseCategory.display_name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input v-model="expense.amount" class="form-control" type="number" name="amount"
                                    id="amount" />
                            </div>

                            <div class="form-group">
                                <label for="entry_date" class="col-2 col-form-label">Date</label>
                                <div class="col-10">
                                    <input v-model="expense.entry_date" class="form-control" type="date"
                                        id="entry_date">
                                </div>
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
        <div class="modal fade" id="updateExpense" tabindex="-1" role="dialog" aria-labelledby="updateExpenseLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateExpenseLabel">Create Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateExpense" method="put">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="expense_category_name">Expense Category Name</label>
                                <select v-model="selectedExpense.category_id" class="form-control" type="text" name="expense_category_name"
                                    id="expense_category_name">

                                    <option v-for="expenseCategory in expenseCategories" :key="expenseCategory.id" :value="expenseCategory.id">{{expenseCategory.display_name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input v-model="selectedExpense.amount" class="form-control" type="number" name="amount"
                                    id="amount" />
                            </div>

                            <div class="form-group">
                                <label for="entry_date" class="col-2 col-form-label">Date</label>
                                <div class="col-10">
                                    <input v-model="selectedExpense.entry_date" class="form-control" type="date"
                                        id="entry_date">
                                </div>
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
                expenses: {},
                expense: {},
                expenseCategories: {},
                loading: true,
                message: '',
                selectedExpense: {},
            }
        },

        beforeMount() {
            this.getExpense();
            this.getExpenseCategory();
        },

        methods: {

            hideModal() {
                if (this.message == 200) {
                $('#updateExpense').modal('hide');
                $('#createExpense').modal('hide');
                }
            },

            async getExpenseCategory() {
                await axios.get('/get/expensecategory').then(response => {
                    this.expenseCategories = response.data;
                    this.loading = false;
                });
            },


            async getExpense() {
                await axios.get('/show/expense/'+this.$auth.user().id).then(response => {
                    this.expenses = response.data;
                    this.loading = false;
                });
            },

            async createExpense() {
                this.message = '';
                this.loading = true;
                this.expense['user_id'] = this.$auth.user().id;
                await axios.post('/insert/expense', this.expense).then(response => {
                    this.message = response;
                    this.getExpense();
                });

            },

            async updateExpense() {
                this.message = '';
                this.loading = true;
                await axios.put('/update/expense', this.selectedExpense).then(response => {
                    this.message = response;
                    this.getExpense();

                });
            },

            async deleteExpense(data) {


                this.loading = true;
                await axios.delete('/delete/expense', {
                    params: {
                        'id': data.id
                    }
                }).then(response => {
                    console.log(data);

                    this.message = response;
                    this.getExpense();

                }).catch(error => {
                    this.message = error;
                });
            },

            sendData(role) {

                console.log(role);
                this.selectedExpense = role;
            }


        }



    }

</script>

<style>

</style>
