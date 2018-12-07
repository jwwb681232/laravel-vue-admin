<style>
    .widget-user-header{
    background-position: center center;
    background-size:cover;
    height:200px;
}
.user-avatar{
    height:80px;
    width: 80px;
}
.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 80%;
    color: red;
}
</style>
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background-image: url('./img/profile_background.png');">
                        <h3 class="widget-user-username">Elizabeth Pierce</h3>
                        <h5 class="widget-user-desc">Web Designer</h5>
                    </div>
                    <div class="widget-user-image">
                        <!--<img class="img-circle" src="./img/user3.jpg" alt="User Avatar">-->
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                        <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane" id="activity">
                            activity
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane active show" id="settings">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Name</label>
                                    <div class="col-sm-12">
                                        <input
                                                v-model="form.name"
                                                type="text"
                                                class="form-control"
                                                :class="{ 'is-invalid': form.errors.has('name') }"
                                                name="name"
                                                id="name"
                                                placeholder="Name"
                                        >
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-12 control-label">Email</label>
                                    <div class="col-sm-12">
                                        <input
                                                v-model="form.email"
                                                type="email"
                                                class="form-control"
                                                :class="{ 'is-invalid': form.errors.has('email') }"
                                                name="email"
                                                id="email"
                                                placeholder="Email"
                                        >
                                        <has-error :form="form" field="email"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bio" class="col-sm-12 control-label">Bio</label>
                                    <div class="col-sm-12">
                                        <textarea
                                                v-model="form.bio"
                                                class="form-control"
                                                :class="{ 'is-invalid': form.errors.has('bio') }"
                                                name="bio"
                                                id="bio"
                                                placeholder="Bio"
                                        ></textarea>
                                        <has-error :form="form" field="bio"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="col-sm-12 control-label">Role</label>
                                    <div class="col-sm-12">
                                        <select
                                                v-model="form.type"
                                                class="form-control"
                                                :class="{ 'is-invalid': form.errors.has('type') }"
                                                name="type"
                                                id="type"
                                        >
                                            <option value="">Select User Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">Standard User</option>
                                            <option value="author">Author</option>
                                        </select>
                                        <has-error :form="form" field="type"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="photo" class="col-sm-12 control-label">Photo</label>
                                    <div class="col-sm-12 form-inline">
                                        <img class="img-circle elevation-2 user-avatar" :src="form.photo" alt="User Avatar">
                                        <input
                                                @change="updateProfile"
                                                class="form-control"
                                                type="file"
                                                name="photo"
                                                id="photo"
                                        >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-12 control-label">Password (leave empty if not changing)</label>
                                    <div class="col-sm-12">
                                        <input
                                                v-model="form.password"
                                                class="form-control"
                                                :class="{ 'is-invalid': form.errors.has('password') }"
                                                type="text"
                                                name="password"
                                                id="password"
                                                placeholder="Enter Password"
                                        >
                                        <has-error :form="form" field="password"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-12">
                                        <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                form: new Form({
                    id:'',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo:''
                })
            }
        },
        created(){
            axios.get('api/user/profile').then(({data})=>{
                this.form.fill(data);
            }).catch();
        },
        methods:{
            updateProfile(e){
                let file = e.target.files[0];
                if(!file){
                    this.form.photo = '';
                    return;
                }

                let limit = 1024 * 1024 * 2;
                if (file.size > limit){
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading too large',
                    });
                    return ;
                }

                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = () => {
                    this.form.photo = reader.result;
                };
            },
            updateInfo(){
                this.$Progress.start();
                this.form.put('api/user/profile').then(()=>{
                    toast({
                        type:'success',
                        title:'Edit Success'
                    });
                    this.$Progress.finish();
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
            console.log('Component mounted.')
        }
    }
</script>
