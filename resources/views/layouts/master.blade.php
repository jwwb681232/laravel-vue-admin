
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminLTE 3 | Starter</title>

    <link rel="stylesheet" href="/css/app.css">

</head>
<body>
<div id="app">
    <v-app>
        <template>
            <v-app id="inspire">
                <v-navigation-drawer :clipped="$vuetify.breakpoint.lgAndUp" fixed app disable-route-watcher>
                    <v-list>
                        <v-list-tile>
                            <v-list-tile-action>
                                <v-icon>home</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-title>Home</v-list-tile-title>
                        </v-list-tile>

                        <v-list-group prepend-icon="account_circle">
                            <v-list-tile slot="activator">
                                <v-list-tile-title>Users</v-list-tile-title>
                            </v-list-tile>

                            <v-list-group no-action sub-group>
                                <v-list-tile slot="activator">
                                    <v-list-tile-title>Admin</v-list-tile-title>
                                </v-list-tile>

                                <v-list-tile>
                                    <v-list-tile-title v-text="'Management'"></v-list-tile-title>
                                    <v-list-tile-action>
                                        <v-icon v-text="'people_outline'"></v-icon>
                                    </v-list-tile-action>
                                </v-list-tile>

                                <v-list-tile>
                                    <v-list-tile-title v-text="'Settings'"></v-list-tile-title>
                                    <v-list-tile-action>
                                        <v-icon v-text="'settings'"></v-icon>
                                    </v-list-tile-action>
                                </v-list-tile>

                            </v-list-group>

                            <v-list-group sub-group no-action>
                                <v-list-tile slot="activator">
                                    <v-list-tile-title>Actions</v-list-tile-title>
                                </v-list-tile>

                                <v-list-tile>
                                    <v-list-tile-title v-text="'Create'"></v-list-tile-title>
                                    <v-list-tile-action>
                                        <v-icon v-text="'add'"></v-icon>
                                    </v-list-tile-action>
                                </v-list-tile>

                                <v-list-tile>
                                    <v-list-tile-title v-text="'Read'"></v-list-tile-title>
                                    <v-list-tile-action>
                                        <v-icon v-text="'insert_drive_file'"></v-icon>
                                    </v-list-tile-action>
                                </v-list-tile>

                                <v-list-tile>
                                    <v-list-tile-title v-text="'Update'"></v-list-tile-title>
                                    <v-list-tile-action>
                                        <v-icon v-text="'update'"></v-icon>
                                    </v-list-tile-action>
                                </v-list-tile>
                            </v-list-group>
                        </v-list-group>
                    </v-list>
                </v-navigation-drawer>
                <v-toolbar :clipped-left="$vuetify.breakpoint.lgAndUp" color="blue darken-3" dark app fixed>
                    <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
                        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
                        <span class="hidden-sm-and-down">Google Contacts</span>
                    </v-toolbar-title>
                    <v-text-field flat solo-inverted hide-details prepend-inner-icon="search" label="Search" class="hidden-sm-and-down"></v-text-field>
                    <v-spacer></v-spacer>
                    <v-btn icon><v-icon>apps</v-icon></v-btn>
                    <v-btn icon><v-icon>notifications</v-icon></v-btn>
                    <v-btn icon large>
                        <v-avatar size="32px" tile>
                            <img src="https://cdn.vuetifyjs.com/images/logos/logo.svg" alt="Vuetify">
                        </v-avatar>
                    </v-btn>
                </v-toolbar>
                <v-content>
                    <router-view><router-view/>
                </v-content>
                <v-btn fab bottom right color="pink" dark fixed @click="dialog = !dialog">
                    <v-icon>add</v-icon>
                </v-btn>
                <v-dialog v-model="dialog" width="800px">
                    <v-card>
                        <v-card-title class="grey lighten-4 py-4 title">
                            Create contact
                        </v-card-title>
                        <v-container grid-list-sm class="pa-4">
                            <v-layout row wrap>
                                <v-flex xs12 align-center justify-space-between>
                                    <v-layout align-center>
                                        <v-avatar size="40px" class="mr-3">
                                            <img src="//ssl.gstatic.com/s2/oz/images/sge/grey_silhouette.png" alt="">
                                        </v-avatar>
                                        <v-text-field placeholder="Name"></v-text-field>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs6>
                                    <v-text-field prepend-icon="business" placeholder="Company"></v-text-field>
                                </v-flex>
                                <v-flex xs6><v-text-field placeholder="Job title"></v-text-field></v-flex>
                                <v-flex xs12>
                                    <v-text-field prepend-icon="mail" placeholder="Email"></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field type="tel" prepend-icon="phone" placeholder="(000) 000 - 0000" mask="phone"></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field prepend-icon="notes" placeholder="Notes"></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-container>
                        <v-card-actions>
                            <v-btn flat color="primary">More</v-btn>
                            <v-spacer></v-spacer>
                            <v-btn flat color="primary" @click="dialog = false">Cancel</v-btn>
                            <v-btn flat @click="dialog = false">Save</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-app>
        </template>
    </v-app>
</div>
</body>
<script src="/js/app.js"></script>
</body>
</html>
