<style>
    .h-modal .h-notify-content {
        padding: 0!important;
    }
    .card{
        margin-bottom:0!important;
    }
</style>
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
                <Button @click="addNewModalOpened=true" text-color="blue" icon="h-icon-plus">Add New</Button>
            </p>
            <Table :datas="datas" ref="table" @select="onselect" checkbox @trclick="trClick" @trdblclick="trdblclick" selectWhenClickTr>
                <TableItem title="ID"  prop="id" align="center" :width="80" fixed="left"></TableItem>
                <TableItem title="年龄" prop="age" align="center" :width="150"></TableItem>
                <TableItem title="地址" prop="address" align="center" :width="150"></TableItem>
                <TableItem title="操作" align="center" :width="80" fixed="right">
                    <template slot-scope="{data}">
                        <button class="h-btn h-btn-s h-btn-red" @click="remove(datas, data)"><i class="h-icon-trash"></i></button>
                    </template>
                </TableItem>
                <div slot="empty">自定义提醒：暂时无数据</div>
            </Table>
        </div>
        <!-- /.card -->
        <Modal v-model="addNewModalOpened">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div>
                        <Form ref="form" :label-position="labelPosition" :label-width="90" :rules="validationRules" :model="model">
                            <FormItem label="菜单名" prop="menuName">
                                <input type="text" v-model="model.menuName" />
                            </FormItem>
                            <FormItem label="菜单链接" prop="menuPath">
                                <input type="text" v-model="model.menuPath" />
                            </FormItem>
                            <FormItem>
                                <Button color="primary" :loading="isLoading" @click="submit">提交</Button>&nbsp;&nbsp;&nbsp;
                                <Button @click="reset">取消</Button>
                            </FormItem>
                        </Form>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!--<div slot="footer">
                <Button color="primary">确认</Button>
                <Button @click="addNewModalOpened=false">关闭</Button>
                <Button color="red" @click="addNewModalOpened=false">删除</Button>
            </div>-->
        </Modal>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                addNewModalOpened:false,
                isLoading: false,
                labelPosition: "left",
                labels: {
                    left: 'Label左对齐',
                    right: 'Label右对齐',
                },
                model: {
                    menuName: "",
                    menuPath: ""
                },
                validationRules: {
                    required: [
                        'menuName',
                        'menuPath'
                    ]
                },
                datas : [
                    { id: 5, name: '测试5', age: 12, address: "上海" },
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
            },
            submit() {
                this.isLoading = true;
                let validResult = this.$refs.form.valid();
                if (validResult.result) {
                    this.$Message("验证成功");
                    setTimeout(() => {
                        this.isLoading = false;
                    }, 1000);
                } else {
                    this.isLoading = false;
                }
            },
            reset() {
                this.$refs.form.reset();
                this.addNewModalOpened = false;
            }
        }
    }
</script>
