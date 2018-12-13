<template>
    <div>
        <!--<v-toolbar>
            <v-btn color="primary" dark small @click="addDialog=true">Add New
                <v-icon dark right>add_circle</v-icon>
            </v-btn>
        </v-toolbar>-->

        <v-card-title>
            <v-flex xs12 md2>
                <v-text-field label="Solo" solo></v-text-field>
            </v-flex>
            <v-flex xs12 md2>
                <v-text-field label="Solo" solo></v-text-field>
            </v-flex>
            <v-flex xs12 md2>
                <v-text-field label="Solo" solo></v-text-field>
            </v-flex>
            <!--<v-flex xs12 md2>
                <v-text-field label="Solo" solo></v-text-field>
            </v-flex>-->
            <!--<v-flex xs12 md4>
                <v-btn color="success">Success</v-btn>
                <v-btn color="error">Error</v-btn>
                <v-btn color="warning">Warning</v-btn>
                <v-btn color="info">Info</v-btn>
            </v-flex>-->
        </v-card-title>
        <v-data-table
                :headers="headers"
                :items="dataList"
                :pagination.sync="pagination"
                :total-items="totalRecords"
                :rows-per-page-items="[5,10,20]"
                :loading="loading"
                v-model="selected"
                class="elevation-1"
                select-all
        >
            <template slot="items" slot-scope="props">
                <td>
                    <v-checkbox
                            v-model="props.selected"
                            primary
                            hide-details
                    ></v-checkbox>
                </td>
                <td class="text-xs-center">{{ props.item.id }}</td>
                <td class="text-xs-center">{{ props.item.name }}</td>
                <td class="text-xs-center">{{ props.item.icon }}</td>
                <td class="text-xs-center">{{ props.item.href }}</td>
                <td class="text-xs-center">{{ props.item.parent_id }}</td>
                <td class="text-xs-center">{{ props.item.created_at }}</td>
                <td class="text-xs-center">
                    <!--<v-speed-dial :fab="true" :open-on-hover="true" direction="left" transition="slide-x-reverse-transition">
                        <v-btn slot="activator" small color="blue darken-2" dark :fab="true">
                            <v-icon>account_circle</v-icon>
                            <v-icon>close</v-icon>
                        </v-btn>
                        <v-btn fab dark small color="green">
                            <v-icon>edit</v-icon>
                        </v-btn>
                        <v-btn fab dark small color="indigo">
                            <v-icon>add</v-icon>
                        </v-btn>
                        <v-btn fab dark small color="red">
                            <v-icon>delete</v-icon>
                        </v-btn>
                    </v-speed-dial>-->
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
        <!--<div class="text-xs-center pt-2">
            <v-pagination v-model="pagination.page" :length="pages"></v-pagination>
        </div>-->
        <v-dialog v-model="addDialog" persistent max-width="600px">
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
        <v-dialog v-model="editDialog" persistent max-width="600px">
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
                    {text: 'ID', align: 'center', value: 'id'},
                    { text: 'Name',align:'center', value: 'name' },
                    { text: 'Icon', align:'center', value: 'icon' },
                    { text: 'Href', align:'center', value: 'href' },
                    { text: 'Parent ID', align:'center', value: 'parent_id' },
                    { text: 'Created At', align:'center', value: 'created_at' },
                    { text: 'Action', align:'center',sortable:false, value: 'id' },
                ],
                addDialog: false,
                addForm:new Form({
                    name: '',
                    icon: '',
                    href: '',
                }),
                editDialog:false,
                editForm:new Form({
                    name: '',
                    icon: '',
                    href: '',
                })
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
                        }).catch(({response})=>{
                            if(response.status === 500){
                                toast({
                                    type: 'error',
                                    title: response.data.message
                                });
                                this.$Progress.fail();
                            }else{
                                let ServerErrors = [];
                                $.each(response.data, function(field,message) {
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
                this.addDialog=false;
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
