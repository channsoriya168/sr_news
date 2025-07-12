<template>
    <HeadApp title="Home" />
    <v-container class="mt-4">
        <v-row>
            <v-col cols="12" md="3">
                <v-card bg="primary" class="text-white">
                    <v-card-title class="text-h5">User Menu</v-card-title>
                    <v-list>
                        <v-list-item to="/user/profile">
                            <v-list-item-title>Profile</v-list-item-title>
                        </v-list-item>
                        <v-list-item to="/user/settings">
                            <v-list-item-title>Settings</v-list-item-title>
                        </v-list-item>
                        <v-list-item to="/user/logout">
                            <v-list-item-title>Logout</v-list-item-title>
                            
                        </v-list-item>
                    </v-list>
                </v-card>
            </v-col>
            
            <v-col cols="12" md="9">
                <v-card>
                    <v-card-title class="text-h5">Welcome to the Dashboard</v-card-title>
                    <v-card-text>
                        This is the user dashboard where you can manage your account and view your activities.
                    </v-card-text>

                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-card-title class="text-h5">Recent Activities</v-card-title>
                    <v-card-text>
                        <!-- Placeholder for recent activities -->
                        <p>No recent activities to display.</p>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>

</template>

<script setup>

import HeadApp from '../../components/Admin/HeadApp.vue';

</script>
