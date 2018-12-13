<template>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fa fa-edit"></i>
                Dashboard Component
            </h3>
        </div>
        <!-- /.card -->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                datas: []
            }
        },
        mounted() {
            axios({
                method:"get",
                url:"http://yyjobs-api-dev.guabean.com/index.php/api/employee/info",
                data:{"action":"refreshToken"},
                headers:{
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/x.yyjobs-api.v3+json',
                    "Authorization":"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC95eWpvYnMtYXBpLWRldi5ndWFiZWFuLmNvbVwvaW5kZXgucGhwXC9hcGlcL2VtcGxveWVlXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU0NDYwMzY2MywiZXhwIjoxNTQ1ODk5NjYzLCJuYmYiOjE1NDQ2MDM2NjMsImp0aSI6IkI2YWlBRmtjUzU0bnhZRkoiLCJzdWIiOjgxMTQsInBydiI6Ijg2NjVhZTk3NzVjZjI2ZjZiOGU0OTZmODZmYTUzNmQ2OGRkNzE4MTgifQ.TzTzj5BA-xWZ6qlGZemlC0Xgz6skWi_YJCQf6ZCm2Fk"
                }
            }).then().catch();

        },
        methods: {

        }
    }
</script>
