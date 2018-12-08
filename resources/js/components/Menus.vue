<template>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fa fa-edit"></i>
                Menu Component
            </h3>
        </div>
        <div class="card-body pad table-responsive">
            <p>
                <Button text-color="blue" icon="h-icon-plus">Add New</Button>
            </p>
            <Table :datas="datas" ref="table" @select="onselect" checkbox @trclick="trClick" @trdblclick="trdblclick" selectWhenClickTr>
                <TableItem title="ID"  prop="id" align="center" :width="80" fixed="left"></TableItem>
                <TableItem title="年龄" prop="age" align="center" :width="150"></TableItem>
                <TableItem title="地址" prop="address" align="center" :width="150"></TableItem>
                <TableItem title="姓名" prop="name" align="center" :width="150"></TableItem>
                <TableItem title="年龄" prop="age" align="center" :width="150"></TableItem>
                <TableItem title="地址" prop="address" align="center" :width="150"></TableItem>
                <TableItem title="姓名" prop="name" align="center" :width="150"></TableItem>
                <TableItem title="年龄" prop="age" align="center" :width="150"></TableItem>
                <TableItem title="地址" prop="address" align="center" :width="150"></TableItem>
                <TableItem title="操作" align="center" :width="80" fixed="right"><template slot-scope="{data}"><button class="h-btn h-btn-s h-btn-red" @click="remove(datas, data)"><i class="h-icon-trash"></i></button></template></TableItem>
                <div slot="empty">自定义提醒：暂时无数据</div>
            </Table>
        </div>
        <!-- /.card -->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                datas : [{ id: 5, name: '测试5', age: 12, address: "上海" },
                    { id: 6, name: '测试6', age: 12, address: "上海" },
                    { id: 7, name: '测试7', age: 12, address: "上海" },
                    { id: 5, name: '测试5', age: 12, address: "上海" },
                    { id: 6, name: '测试6', age: 12, address: "上海" },
                    { id: 7, name: '测试7', age: 12, address: "上海" },
                    { id: 7, name: '测试7', age: 12, address: "上海" },
                    { id: 5, name: '测试5', age: 12, address: "上海" },
                    { id: 6, name: '测试6', age: 12, address: "上海" },
                    { id: 7, name: '测试7', age: 12, address: "上海" },
                    { id: 7, name: '测试7', age: 12, address: "上海" },
                    { id: 7, name: '测试7', age: 12, address: "上海" },
                    { id: 5, name: '测试5', age: 12, address: "上海" },
                    { id: 6, name: '测试6', age: 12, address: "上海" },
                    { id: 7, name: '测试7', age: 12, address: "上海" },]
            }
        },
        mounted() {

        },
        methods: {
            setOddSelection() {
                this.$refs.table.setSelection(this.datas.filter((item, index) => (index + 1) % 2 === 1))
            },
            remove(datas, data) {
                datas.splice(datas.indexOf(data), 1);
            },
            add(datas) {
                datas.push({ id: 7, name: '添加', age: 12, address: "然后添加的" });
            },
            invereSelection() {
                this.$refs.table.invereSelection();
            },
            onselect(data, event) {
                //log('onselect', data, event);
            },
            trClick(data, event) {
                //log('trClick', data, event);
            },
            trdblclick(data, event) {
                //log('trdblclick', data, event);
            }
        }
    }
</script>
