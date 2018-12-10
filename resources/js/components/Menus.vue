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
        /*$_veeValidate: {
            validator: 'new'
        },*/

        data () {
            return {
                dialog: false,
                /*dropdown_font: [
                    { text: 'Arial' },
                    { text: 'Calibri' },
                    { text: 'Courier' },
                    { text: 'Verdana' }
                ],
                dropdown_edit: [
                    { text: '100%' },
                    { text: '75%' },
                    { text: '50%' },
                    { text: '25%' },
                    { text: '0%' }
                ],
                toggle_exclusive: 2,
                toggle_multiple: [1, 2, 3],
                headers: [
                    {
                        text: 'Dessert (100g serving)',
                        align: 'left',
                        sortable: false,
                        value: 'name'
                    },
                    { text: 'Calories', value: 'calories' },
                    { text: 'Fat (g)', value: 'fat' },
                    { text: 'Carbs (g)', value: 'carbs' },
                    { text: 'Protein (g)', value: 'protein' },
                    { text: 'Iron (%)', value: 'iron' }
                ],
                desserts: [
                    {
                        value: false,
                        name: 'Frozen Yogurt',
                        calories: 159,
                        fat: 6.0,
                        carbs: 24,
                        protein: 4.0,
                        iron: '1%'
                    },
                    {
                        value: false,
                        name: 'Ice cream sandwich',
                        calories: 237,
                        fat: 9.0,
                        carbs: 37,
                        protein: 4.3,
                        iron: '1%'
                    },
                    {
                        value: false,
                        name: 'Eclair',
                        calories: 262,
                        fat: 16.0,
                        carbs: 23,
                        protein: 6.0,
                        iron: '7%'
                    },
                    {
                        value: false,
                        name: 'Cupcake',
                        calories: 305,
                        fat: 3.7,
                        carbs: 67,
                        protein: 4.3,
                        iron: '8%'
                    },
                    {
                        value: false,
                        name: 'Gingerbread',
                        calories: 356,
                        fat: 16.0,
                        carbs: 49,
                        protein: 3.9,
                        iron: '16%'
                    },
                    {
                        value: false,
                        name: 'Jelly bean',
                        calories: 375,
                        fat: 0.0,
                        carbs: 94,
                        protein: 0.0,
                        iron: '0%'
                    },
                    {
                        value: false,
                        name: 'Lollipop',
                        calories: 392,
                        fat: 0.2,
                        carbs: 98,
                        protein: 0,
                        iron: '2%'
                    },
                    {
                        value: false,
                        name: 'Honeycomb',
                        calories: 408,
                        fat: 3.2,
                        carbs: 87,
                        protein: 6.5,
                        iron: '45%'
                    },
                    {
                        value: false,
                        name: 'Donut',
                        calories: 452,
                        fat: 25.0,
                        carbs: 51,
                        protein: 4.9,
                        iron: '22%'
                    },
                    {
                        value: false,
                        name: 'KitKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7,
                        iron: '6%'
                    }
                ],*/
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
                        this.addForm.post('api/menu').then((res)=>{
                            console.log(res)
                        }).catch((responseErrors)=>{
                            let ServerErrors = [];
                            $.each(responseErrors.response.data.errors, function(field,message) {
                                ServerErrors.push({field:field,msg:message[0]})
                            });
                            this.errors.add(ServerErrors);
                        });
                    }
                })
            },
            close () {
                this.name = '';
                this.icon = '';
                this.href = '';
                this.$validator.reset();
                this.dialog=false;
            }
        }
    }
</script>
