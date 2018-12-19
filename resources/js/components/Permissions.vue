<template>
    <div>
        <!--<v-toolbar dark color="success">
            <v-toolbar-side-icon></v-toolbar-side-icon>
            <v-toolbar-title class="white&#45;&#45;text">Title</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon><v-icon>search</v-icon></v-btn>
            <v-btn icon><v-icon>apps</v-icon></v-btn>
            <v-btn icon><v-icon>refresh</v-icon></v-btn>
            <v-btn icon><v-icon>more_vert</v-icon></v-btn>
        </v-toolbar>-->
        <v-expansion-panel>
            <v-expansion-panel-content>
                <div slot="header">ToolBar</div>
                <!--<v-icon slot="actions" color="primary">$vuetify.icons.expand</v-icon>-->
                <v-icon slot="actions" color="primary" small>fa-filter</v-icon>
                <v-card>
                    <v-card-text class="grey lighten-3">
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md2 dense>
                                    <v-text-field v-model="tableData.filter.keyword" append-icon="search" label="Keyword"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md2 dense>
                                    <v-checkbox label="DELETED" v-model="tableData.filter.deleted"></v-checkbox>
                                </v-flex>
                            </v-layout>
                            <v-card-actions class="pl-0">
                                <v-btn small color="indigo" class="white--text" @click="tableFilter">Filter
                                    <v-icon right small>fa-filter</v-icon>
                                </v-btn>
                                <v-btn small @click="tableFilterReset">Reset
                                    <v-icon color="teal" right small>fa-broom</v-icon>
                                </v-btn>
                            </v-card-actions>
                        </v-container>
                    </v-card-text>
                </v-card>
            </v-expansion-panel-content>
        </v-expansion-panel>
        <v-data-table :headers="tableData.headers" :items="tableData.dataList" :pagination.sync="tableData.pagination" :total-items="tableData.totalRecords" :rows-per-page-items="[5,10,20]" :loading="tableData.loading" v-model="tableData.selected" class="elevation-1" select-all>
            <template slot="items" slot-scope="props">
                <td>
                    <v-checkbox v-model="props.selected" primary hide-details></v-checkbox>
                </td>
                <td class="text-xs-center text-no-wrap">{{ props.item.id }}</td>
                <td class="text-xs-center text-no-wrap">{{ props.item.name }}</td>
                <td class="text-xs-center text-no-wrap">{{ props.item.guard_name }}</td>
                <td class="text-xs-center text-no-wrap">{{ props.item.created_at }}</td>
                <td class="text-xs-center text-no-wrap">
                    <v-tooltip top>
                        <v-icon slot="activator" small @click="editItem(props.item)" color="blue">edit</v-icon>
                        <span>Edit</span>
                    </v-tooltip>
                    <v-tooltip top>
                        <v-icon slot="activator" small @click="deleteItem(props.item)" color="red">delete</v-icon>
                        <span>Delete</span>
                    </v-tooltip>
                </td>
            </template>
        </v-data-table>
        <v-btn fab bottom right color="pink" dark fixed @click="createDialogForm.createDialog = !createDialogForm.createDialog">
            <v-icon>add</v-icon>
        </v-btn>
        <v-dialog v-model="createDialogForm.createDialog" persistent max-width="500px">
            <v-card>
                <v-card-title class="grey lighten-4 py-4 title">
                    Create User
                </v-card-title>
                <v-container grid-list-sm class="pa-4">
                    <form data-vv-scope="create">
                        <v-text-field v-validate="'required|min:3|max:255'" v-model="createDialogForm.form.name" :error-messages="errors.collect('create.name')" label="Name" data-vv-name="name" required></v-text-field>
                        <v-autocomplete v-validate="'required'" :items="publicData.guard_name" v-model="createDialogForm.form.guard_name" item-value="value" :error-messages="errors.collect('create.guard_name')"  label="Guard Name" data-vv-name="guard_name" required></v-autocomplete>
                    </form>
                </v-container>
                <v-card-actions>
                    <!--<v-btn flat color="primary">More</v-btn>-->
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="createDialogFormSubmitClose">Cancel</v-btn>
                    <v-btn flat @click="createDialogFormSubmit">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="editDialogForm.editDialog" persistent max-width="500px">
            <v-card>
                <v-card-title class="grey lighten-4 py-4 title">
                    Create User
                </v-card-title>
                <v-container grid-list-sm class="pa-4">
                    <form data-vv-scope="edit">
                        <v-text-field v-validate="'required|min:3|max:255'" v-model="editDialogForm.form.name" :error-messages="errors.collect('edit.name')" label="Name" data-vv-name="name" required></v-text-field>
                        <v-autocomplete v-validate="'required'" :items="publicData.guard_name" v-model="editDialogForm.form.guard_name" item-value="value" :error-messages="errors.collect('edit.guard_name')"  label="Guard Name" data-vv-name="guard_name" required></v-autocomplete>
                    </form>
                </v-container>
                <v-card-actions>
                    <!--<v-btn flat color="primary">More</v-btn>-->
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="editDialogFormSubmitClose">Cancel</v-btn>
                    <v-btn flat @click="editDialogFormSubmit">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                publicData: {
                    guard_name: [
                            {text: 'Admin', value: 'admin'}
                        ]
                },
                tableData :{
                    create: true,
                    filter:{keyword:'',deleted:false},
                    selected: [],
                    totalRecords: 0,
                    dataList: [],
                    pagination: {},
                    headers: [
                        {text: 'ID', align: 'center', value: 'id',width:'20%'},
                        { text: 'Name',align:'center', value: 'name' ,width:'20%'},
                        { text: 'Guard Name', align:'center', value: 'guard_name' ,width:'20%'},
                        { text: 'Created At', align:'center', value: 'created_at' ,width:'20%'},
                        { text: 'Action', align:'center',sortable:false, value: 'id' ,width:'20%'},
                    ],
                },
                createDialogForm:{
                    createDialog:false,
                    form: new Form({
                        name: '',
                        guard_name: '',
                    })
                },
                editDialogForm:{
                    editDialog:false,
                    form: new Form({
                        id:'',
                        name: '',
                        guard_name: '',
                    })
                }
            }
        },
        computed:{
            tableDataPagination(){
                return this.tableData.pagination;
            },
            tableDataSelected(){
                return this.tableData.pagination;
            }
        },
        watch: {
            tableDataPagination: {
                handler () {
                    this.getDataFromApi()
                        .then(data => {
                            this.tableData.dataList = data.dataList;
                            this.tableData.totalRecords = data.totalRecords
                        })
                },
                deep: true
            },
            tableDataSelected:{
                handler () {
                    let ids = [];
                    this.tableData.selected.map(({id})=>{
                        ids.push(id);
                    });
                },
                deep: true
            }
        },
        methods: {
            deleteItem(item){
                swal({
                    title: 'Are you sure?',
                    text: "Are you sure you want to do this?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.createDialogForm.form.delete('api/permission/'+item.id).then((res)=>{
                            swal('Deleted!', 'Your file has been deleted.', 'success');
                            this.tableFilterReset();
                        }).catch((error)=>{
                            swal('Error!', 'Something went wrong!', 'error');
                            this.tableFilterReset();
                        })
                    }
                })
            },
            editItem(item){
                this.errors.clear('edit');
                console.log(this.$validator.errors);
                this.editDialogForm.form.fill(item);
                this.editDialogForm.editDialog=true;
            },
            tableFilter(){
                this.getDataFromApi()
                    .then(data => {
                        this.tableData.dataList = data.dataList;
                        this.tableData.totalRecords = data.totalRecords
                    });
            },
            tableFilterReset(){
                Object.keys(this.tableData.filter).map((item)=>{
                    this.tableData.filter[item] = ''
                });
                this.createDialogForm.form.reset();
                this.getDataFromApi()
                    .then(data => {
                        this.tableData.dataList = data.dataList;
                        this.tableData.totalRecords = data.totalRecords
                    })
            },
            createDialogFormSubmit () {
                this.$validator.validateAll('create').then(result=>{
                    if(result){
                        this.createDialogForm.form.post('api/permission').then((res)=>{
                            this.createDialogForm.createDialog = false;
                            this.tableFilterReset();
                        }).catch((responseErrors)=>{
                            let ServerErrors = [];
                            $.each(responseErrors.response.data, function(field,message) {
                                ServerErrors.push({field:field,msg:message[0],scope:'create'})
                            });
                            this.errors.add(ServerErrors);
                        });
                    }
                });
            },
            editDialogFormSubmit () {
                this.$validator.validateAll('edit').then(result=>{
                    if(result){
                        this.editDialogForm.form.patch('api/permission/'+this.editDialogForm.form.id).then((res)=>{
                            this.editDialogForm.editDialog = false;
                            this.tableFilterReset();
                        }).catch((responseErrors)=>{
                            let ServerErrors = [];
                            $.each(responseErrors.response.data, function(field,message) {
                                ServerErrors.push({field:field,msg:message[0],scope:'edit'})
                            });
                            this.errors.add(ServerErrors);
                        });
                    }
                })
            },
            createDialogFormSubmitClose() {
                this.errors.clear('create');
                this.createDialogForm.form.reset();
                this.createDialogForm.createDialog = false;
            },
            editDialogFormSubmitClose() {
                this.errors.clear('edit');
                this.editDialogForm.form.reset();
                this.editDialogForm.editDialog = false;
            },
            getDataFromApi () {
                this.tableData.loading = true;
                return new Promise((resolve,reject)=>{
                    const { sortBy, descending, page, rowsPerPage } = this.tableData.pagination;
                    axios.get('api/permission',{params:{
                        orderBy : sortBy ? sortBy : 'id',
                        order : descending ? 'DESC' : 'ASC',
                        start : (page - 1) * rowsPerPage,
                        length : rowsPerPage,
                        keyword:this.tableData.filter.keyword,
                        deleted:this.tableData.filter.deleted,
                    }}).then((response)=>{
                        let dataList = response.data.dataList;
                        let totalRecords = response.data.totalRecords;
                        resolve({dataList,totalRecords});
                        this.tableData.loading = false;
                    }).catch((err)=>{
                        reject(err);
                    });
                })
            },
        }
    }
</script>
