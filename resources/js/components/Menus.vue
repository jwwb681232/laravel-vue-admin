<template>
    <div>
        <v-toolbar>
            <v-btn color="primary" dark small @click="dialog=true">Add New
                <v-icon dark right>add_circle</v-icon>
            </v-btn>
        </v-toolbar>
        <!--<v-data-table
                :headers="headers"
                :items="desserts"
                class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td>{{ props.item.name }}</td>
                <td class="text-xs-right">{{ props.item.calories }}</td>
                <td class="text-xs-right">{{ props.item.fat }}</td>
                <td class="text-xs-right">{{ props.item.carbs }}</td>
                <td class="text-xs-right">{{ props.item.protein }}</td>
                <td class="text-xs-right">{{ props.item.iron }}</td>
            </template>
        </v-data-table>-->
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
                    <small>*indicates required field</small>
                </v-card-text>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                dialog: false,
                addForm:new Form({
                    name: '',
                    icon: '',
                    href: '',
                }),
            }
        },
        beforeCreate(){
            this.$Progress.start();
        },
        mounted(){
            console.log('Component mounted.');
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
                            let ServerErrors = [];
                            $.each(responseErrors.response.data, function(field,message) {
                                ServerErrors.push({field:field,msg:message[0]})
                            });
                            this.errors.add(ServerErrors);
                            this.$Progress.fail();
                        });
                    }
                })
            },
            close () {
                this.addForm.reset();
                this.$validator.reset();
                this.dialog=false;
            }
        }
    }
</script>
