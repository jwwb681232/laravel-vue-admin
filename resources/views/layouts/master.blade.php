
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
                <template>
                    <v-navigation-drawer :clipped="$vuetify.breakpoint.lgAndUp" v-model="drawer" fixed app dark>
                    <v-list>
                        <v-list-tile>
                            <v-list-tile-action>
                                <v-icon>home</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-title>Home</v-list-tile-title>
                        </v-list-tile>

                        <v-list-group prepend-icon="settings">
                            <v-list-tile slot="activator">
                                <v-list-tile-title>Management</v-list-tile-title>
                            </v-list-tile>

                            <v-list-tile to="/menus">
                                <v-list-tile-action style="padding-left: 5px;">
                                    <v-icon small>fas fa-calendar-minus</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-title>Menu</v-list-tile-title>
                            </v-list-tile>

                            <v-list-tile to="/users">
                                <v-list-tile-action style="padding-left: 5px;">
                                    <v-icon small>fas fa-user</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-title>User</v-list-tile-title>
                            </v-list-tile>
                        </v-list-group>
                        <v-list-group prepend-icon="account_circle">
                            <v-list-tile slot="activator">
                                <v-list-tile-title>Actions</v-list-tile-title>
                            </v-list-tile>

                            <v-list-tile>
                                <v-list-tile-action>
                                    <v-icon v-text="'add'"></v-icon>
                                </v-list-tile-action>
                                <v-list-tile-title v-text="'Create'"></v-list-tile-title>
                            </v-list-tile>

                            <v-list-tile>
                                <v-list-tile-action>
                                    <v-icon v-text="'insert_drive_file'"></v-icon>
                                </v-list-tile-action>
                                <v-list-tile-title v-text="'Read'"></v-list-tile-title>
                            </v-list-tile>

                            <v-list-tile>
                                <v-list-tile-action>
                                    <v-icon v-text="'update'"></v-icon>
                                </v-list-tile-action>
                                <v-list-tile-title v-text="'Update'"></v-list-tile-title>
                            </v-list-tile>
                        </v-list-group>

                        <v-list-tile class="v-list__tile--link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <v-list-tile-action>
                                <v-icon>logout</v-icon>
                            </v-list-tile-action>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <v-list-tile-title>Logout</v-list-tile-title>
                        </v-list-tile>
                    </v-list>
                </v-navigation-drawer>
                </template>
                <v-toolbar :clipped-left="$vuetify.breakpoint.lgAndUp" color="blue darken-3" dark app fixed>
                    <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
                        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
                        <span class="hidden-sm-and-down">Google Contacts</span>
                    </v-toolbar-title>
                    {{--<v-text-field flat solo-inverted hide-details prepend-inner-icon="search" label="Search" class="hidden-sm-and-down"></v-text-field>--}}
                    <v-spacer></v-spacer>
                    <v-btn icon><v-icon>apps</v-icon></v-btn>
                    <v-btn icon><v-icon>notifications</v-icon></v-btn>
                    <v-btn icon large>
                        <v-avatar size="32px" tile>
                            <img src="https://cdn.vuetifyjs.com/images/logos/logo.svg" alt="Vuetify">
                        </v-avatar>
                    </v-btn>
                </v-toolbar>
                <v-container fluid>
                    <v-content>
                        <router-view><router-view/>
                    </v-content>
                </v-container>
            </v-app>
        </template>
    </v-app>
</div>
</body>
<script src="/js/app.js"></script>
</body>
</html>
