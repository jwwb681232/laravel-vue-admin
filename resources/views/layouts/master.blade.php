
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
                <v-navigation-drawer :clipped="$vuetify.breakpoint.lgAndUp" v-model="drawer" fixed app>
                    <v-list dense>
                        <template>
                            {{--<v-list-group v-if="item.children" v-model="item.model" :key="item.text" :prepend-icon="item.model ? item.icon : item['icon-alt']" append-icon="">
                                <v-list-tile slot="activator">
                                    <v-list-tile-content>
                                        <v-list-tile-title>
                                            @{{ item.text }}
                                        </v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-list-tile v-for="(child, i) in item.children" :key="i" @click="">
                                    <v-list-tile-action v-if="child.icon">
                                        <v-icon>@{{ child.icon }}</v-icon>
                                    </v-list-tile-action>
                                    <v-list-tile-content>
                                        <v-list-tile-title>
                                            @{{ child.text }}
                                        </v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                            </v-list-group>
                            <v-list-tile v-else :key="item.text" @click="">
                                <v-list-tile-action>
                                    <v-icon>@{{ item.icon }}</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        @{{ item.text }}
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>--}}
                            <v-list-tile @click="">
                                <v-list-tile-action>
                                    <v-icon>contacts</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        Contacts
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-group :prepend-icon="false ? 'keyboard_arrow_up' : 'keyboard_arrow_down'" append-icon="">
                                <v-list-tile slot="activator">
                                    <v-list-tile-content>
                                        <v-list-tile-title>
                                            Labels
                                        </v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-list-tile @click="">
                                    <v-list-tile-action>
                                        <v-icon>add</v-icon>
                                    </v-list-tile-action>
                                    <v-list-tile-content>
                                        <v-list-tile-title>
                                            Create label
                                        </v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                            </v-list-group>
                        </template>
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
