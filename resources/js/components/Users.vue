<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>
                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModel()">Add New <i
                                    class="fas fa-user-plus"></i></button>
                            <!--<div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Created At</th>
                                <th>Modify</th>
                            </tr>
                            <tr v-for="user in users" :key="user.id">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.type | upText}}</td>
                                <td>{{user.created_at | myDate}}</td>
                                <td>
                                    <a href="javascript:void (0)" @click="editModel(user)"><i class="fa fa-edit blue"></i></a>
                                    /
                                    <a href="javascript:void (0)" @click="deleteUser(user.id)"><i class="fa fa-trash red"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewModalLabel">{{editMode ? 'Update User\'s Info' : 'Add New'}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input
                                        v-model="form.name"
                                        name="name"
                                        type="text"
                                        id="name"
                                        class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('name') }"
                                        placeholder="Name"
                                >
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <input
                                        v-model="form.email"
                                        name="email"
                                        type="email"
                                        id="email"
                                        class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('email') }"
                                        placeholder="Email Address"
                                >
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <input
                                        v-model="form.password"
                                        name="password"
                                        type="password"
                                        id="password"
                                        class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('password') }"
                                        placeholder="Enter Password"
                                >
                                <has-error :form="form" field="password"></has-error>
                            </div>
                            <div class="form-group">
                                <select
                                        v-model="form.type"
                                        name="type"
                                        id="type"
                                        class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('type') }"
                                >
                                    <option value="">Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">Standard User</option>
                                    <option value="author">Author</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                            <div class="form-group">
                                <textarea
                                        v-model="form.bio"
                                        name="bio"
                                        id="bio"
                                        class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('bio') }"
                                        placeholder="Short bio for user(Option)"
                                >
                                </textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editMode" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                editMode:false,
                users:{},
                form: new Form({
                    id:'',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                })
            }
        },
        methods:{
            updateUser(){
                this.$Progress.start();
                this.form.put('api/user/'+this.form.id).then(()=>{
                    $('#addNewModal').modal('hide');
                    toast({
                        type:'success',
                        title:'User Created In Successfully.'
                    });
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                }).catch(()=>{
                    toast({
                        type:'error',
                        title:'failed'
                    });
                    this.$Progress.fail();
                });
            },
            editModel(user){
                this.editMode = true;
                this.form.reset();
                this.form.fill(user);
                $('#addNewModal').modal('show');
            },
            newModel(){
                this.editMode = false;
                this.form.reset();
                $('#addNewModal').modal('show');
            },
            deleteUser(id){
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.$Progress.start();
                        this.form.delete('api/user/'+id).then(()=>{
                            toast({type:'success', title:'Deleted!'});
                            Fire.$emit('AfterCreate');
                            this.$Progress.finish();
                        }).catch(()=>{
                            toast({type:'error', title:'failed'});
                            this.$Progress.fail();
                        });
                    }
                })
            },
            loadUsers(){
                axios.get('api/user').then(({data})=>{
                    this.users = data.data
                });
            },
            createUser(){
                this.$Progress.start();
                this.form.post('api/user').then((res)=>{
                    $('#addNewModal').modal('hide');
                    toast({
                        type:'success',
                        title:'User Created In Successfully.'
                    });
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                }).catch(()=>{
                    toast({
                        type:'error',
                        title:'failed'
                    });
                    this.$Progress.fail();
                });
            }
        },
        mounted() {
            this.loadUsers();
            Fire.$on('AfterCreate', () => {
                this.loadUsers();
            });
        }
    }
</script>
