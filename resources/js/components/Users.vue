<template>
    <div>
        <v-data-table :headers="headers" :items="dataList" :pagination.sync="pagination" :total-items="totalRecords" :rows-per-page-items="[5,10,20]" :loading="loading" v-model="selected" class="elevation-1" select-all>
            <template slot="items" slot-scope="props">
                <td>
                    <v-checkbox v-model="props.selected" primary hide-details></v-checkbox>
                </td>
                <td class="text-xs-center">{{ props.item.id }}</td>
                <td class="text-xs-center">{{ props.item.name }}</td>
                <td class="text-xs-center">{{ props.item.email }}</td>
                <td class="text-xs-center">{{ props.item.created_at }}</td>
                <td class="text-xs-center">
                    <v-tooltip top>
                        <v-icon slot="activator" small @click="editItem(props.item)" color="blue">edit</v-icon>
                        <span>Edit</span>
                    </v-tooltip>
                    <v-tooltip top>
                        <v-icon slot="activator" small @click="editItem(props.item)" color="red">delete</v-icon>
                        <span>Delete</span>
                    </v-tooltip>
                </td>
            </template>
        </v-data-table>
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
    </div>
</template>

<script>
    export default {
        data () {
            return {
                dialog: false,
                selected: [],
                totalRecords: 0,
                dataList: [],
                loading: true,
                pagination: {},
                headers: [
                    {text: 'ID', align: 'center', value: 'id',width:'20%'},
                    { text: 'Name',align:'center', value: 'name' ,width:'20%'},
                    { text: 'Email', align:'center', value: 'email' ,width:'20%'},
                    { text: 'Created At', align:'center', value: 'created_at' ,width:'20%'},
                    { text: 'Action', align:'center',sortable:false, value: 'id' ,width:'20%'},
                ],
            }
        },
        watch: {
            pagination: {
                handler () {
                    this.getDataFromApi()
                        .then(data => {
                            this.dataList = data.dataList;
                            this.totalRecords = data.totalRecords
                        })
                },
                deep: true
            },
            selected:{
                handler () {
                    let ids = [];
                    this.selected.map(({id})=>{
                        ids.push(id);
                    });
                    console.log(ids)
                },
                deep: true
            }
        },
        beforeCreate(){
        },
        mounted(){
        },
        methods: {
            close () {
            },
            editItem(item){
                console.log(item);
            },
            getDataFromApi () {
                this.loading = true;
                return new Promise((resolve,reject)=>{
                    const { sortBy, descending, page, rowsPerPage } = this.pagination;
                    axios.get('api/user',{params:{
                        orderBy : sortBy ? sortBy : 'id',
                        order : descending ? 'DESC' : 'ASC',
                        start : (page - 1) * rowsPerPage,
                        length : rowsPerPage,
                    }}).then((response)=>{
                        let dataList = response.data.dataList;
                        let totalRecords = response.data.totalRecords;
                        resolve({dataList,totalRecords});
                        this.loading = false;
                    }).catch((err)=>{
                        reject(err);
                    });
                })
            },
        }
    }
</script>
