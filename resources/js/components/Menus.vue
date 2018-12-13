<template>
    <div>
        <v-toolbar>
            <v-btn color="primary" dark small @click="dialog=true">Add New
                <v-icon dark right>add_circle</v-icon>
            </v-btn>
        </v-toolbar>
        <v-data-table
                :headers="headers"
                :items="dataList"
                :pagination.sync="pagination"
                :total-items="totalRecords"
                :rows-per-page-items="[5,10,20]"
                :loading="loading"
                class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td><v-checkbox v-model="props.selected" primary hide-details></v-checkbox></td>
                <td class="text-xs-center">{{ props.item.id }}</td>
                <td class="text-xs-center">{{ props.item.name }}</td>
                <td class="text-xs-center">{{ props.item.icon }}</td>
                <td class="text-xs-center">{{ props.item.href }}</td>
                <td class="text-xs-center">{{ props.item.parent_id }}</td>
                <td class="text-xs-center">{{ props.item.created_at }}</td>
                <td class="text-xs-center">
                    <v-icon small @click="editItem(props.item)">edit</v-icon>
                    <v-icon small @click="deleteItem(props.item)">delete</v-icon>
                </td>
            </template>
        </v-data-table>
        <!--<div class="text-xs-center pt-2">
            <v-pagination v-model="pagination.page" :length="pages"></v-pagination>
        </div>-->
        <v-dialog v-model="dialog" persistent max-width="600px">
            <v-card>
                <v-card-title>
                    <span class="headline">User Profile</span>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <form>
                            <v-text-field v-validate="'required|max:32'" v-model="addForm.name" :counter="32" :error-messages="errors.collect('name')" label="Name" data-vv-name="name" required></v-text-field>
                            <v-text-field v-validate="'required|max:32'" v-model="addForm.icon" :counter="32" :error-messages="errors.collect('icon')" label="Icon" data-vv-name="icon" required></v-text-field>
                            <v-text-field v-validate="'required|max:32'" v-model="addForm.href" :counter="32" :error-messages="errors.collect('href')" label="Href" data-vv-name="href" required></v-text-field>
                            <v-btn @click="submit">submit</v-btn>
                            <v-btn @click="close">Close</v-btn>
                        </form>
                    </v-container>
                    <!--<small>*indicates required field</small>-->
                </v-card-text>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                selected: [],
                totalRecords: 0,
                dataList: [],
                loading: true,
                pagination: {},
                headers: [
                    {text: 'ID', align: 'center', sortable:false, value: 'id'},
                    {text: 'ID', align: 'center', value: 'id'},
                    { text: 'Name',align:'center', value: 'name' },
                    { text: 'Icon', align:'center', value: 'icon' },
                    { text: 'Href', align:'center', value: 'href' },
                    { text: 'Parent ID', align:'center', value: 'parent_id' },
                    { text: 'Created At', align:'center', value: 'created_at' },
                    { text: 'Action', align:'center',sortable:false, value: 'id' },
                ],
                dialog: false,
                addForm:new Form({
                    name: '',
                    icon: '',
                    href: '',
                }),
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
            }
        },
        /*computed: {
            pages () {
                if (this.pagination.rowsPerPage === null ||
                    this.pagination.totalItems === null
                ) return 0;

                return Math.ceil(this.totalRecords / this.pagination.rowsPerPage)
            }
        },*/
        beforeCreate(){
            this.$Progress.start();
        },
        mounted(){
            this.$Progress.finish();
        },
        methods: {
            submit () {
                this.$validator.validateAll().then(result=>{
                    if(result){
                        this.$Progress.start();
                        this.addForm.post('api/menu').then((res)=>{
                            this.$Progress.finish();
                            this.dialog=false;
                        }).catch((responseErrors)=>{
                            if(responseErrors.response.status === 500){
                                toast({
                                    type: 'error',
                                    title: responseErrors.response.data.message
                                });
                                this.$Progress.fail();
                            }else{
                                let ServerErrors = [];
                                $.each(responseErrors.response.data, function(field,message) {
                                    ServerErrors.push({field:field,msg:message[0]})
                                });
                                this.errors.add(ServerErrors);
                                this.$Progress.fail();
                            }
                        });
                    }
                })
            },
            close () {
                this.addForm.reset();
                this.$validator.reset();
                this.dialog=false;
            },
            editItem(item){
                console.log(item);
            },
            getDataFromApi () {
                this.loading = true;
                return new Promise((resolve,reject)=>{
                    const { sortBy, descending, page, rowsPerPage } = this.pagination;
                    axios.get('api/menu',{params:{
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
