<template>
 <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
      
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                     

                    </ul>

 
                </div>
            </div>
        </nav>

        <div class="d-flex" id="wrapper">

            <!-- Sidebar -->
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading"> ARB - Nikko </div>

                <div id="app">
                <div class="list-group list-group-flush  "   >
                    
                    <div v-if="!$auth.user().id" >
                    <router-link class="list-group-item list-group-item-action bg-light" to="/login">Login</router-link>
                    <router-link class="list-group-item list-group-item-action bg-light" to="/register">Register</router-link>
                    </div>
           
                    <div v-if="$auth.user().id >= 1" > 

                    <router-link class="list-group-item list-group-item-action bg-light" to="/">Expense</router-link>
                    <div v-if="$auth.user().role == 1">
                    <router-link class="list-group-item list-group-item-action bg-light" to="/expensecategory">Expense Category</router-link>
                    <router-link class="list-group-item list-group-item-action bg-light" to="/roles">Roles</router-link>
                    <router-link class="list-group-item list-group-item-action bg-light" to="/userroles">User Roles</router-link>
                    <router-link class="list-group-item list-group-item-action bg-light" to="/changepassword">Change Password</router-link>
                                      
                    </div>

                    <router-link class="list-group-item list-group-item-action bg-light" to="/logout">Logout</router-link>
                    
                </div>
                </div>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">

                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom p-0">

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                </nav>

                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </div>

        </div>


    </div>
</template>