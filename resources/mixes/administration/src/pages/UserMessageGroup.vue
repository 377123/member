<script>
    export default {
        beforeRouteEnter(to, from, next) {
            next(() => {
            });
        },
        data() {
            const self = this;
            return {
                deleteModal: {
                    name: 'ibenchu',
                    num: 2,
                },
                columns: [
                    {
                        align: 'center',
                        key: 'id',
                        title: 'ID',
                        width: 160,
                    },
                    {
                        align: 'center',
                        key: 'name',
                        title: '分组名称',
                        width: 200,
                    },
                    {
                        key: 'enabled',
                        render(h, data) {
                            const { row } = data.row;
                            return h('i-switch', {
                                on: {
                                    'on-change': value => {
                                        row.status = value;
                                    },
                                },
                                props: {
                                    size: 'large',
                                    value: self.list[data.index].status,
                                },
                                scopedSlots: {
                                    close() {
                                        return h('span', '关闭');
                                    },
                                    open() {
                                        return h('span', '开启');
                                    },
                                },
                            });
                        },
                        title: '显示',
                    },
                    {
                        align: 'center',
                        key: 'action',
                        render(h, data) {
                            return h('div', [
                                h('i-button', {
                                    on: {
                                        click() {
                                            self.$router.push({
                                                path: '/member/user/message/groups/create',
                                                query: {
                                                    type: '1',
                                                },
                                            });
                                        },
                                    },
                                    props: {
                                        size: 'small',
                                        type: 'ghost',
                                    },
                                }, '编辑'),
                                h('i-button', {
                                    on: {
                                        click() {
                                            self.deleteModal.name = data.row.name;
                                            self.modal = true;
                                        },
                                    },
                                    props: {
                                        size: 'small',
                                        type: 'ghost',
                                    },
                                    style: {
                                        marginLeft: '10px',
                                    },
                                }, '删除'),
                            ]);
                        },
                        title: '操作',
                        width: 180,
                    },
                ],
                list: [
                    {
                        id: 123,
                        name: '视频链接',
                        status: false,
                    },
                ],
                modal: false,
                page: {
                    count: 3,
                    current: 1,
                    paginate: 2,
                },
                selection: [],
            };
        },
        methods: {
            changePage() {},
            submitCancel() {
                this.modal = false;
            },
            submitDelete() {},
            selectionChange(selection) {
                const self = this;
                self.selection = selection;
            },
            batchRemovesure() {},
            update() {},
        },
    };
</script>
<template>
    <div class="member-warp">
        <div class="user-manager">
            <tabs value="name">
                <tab-pane label="信息分组" name="name">
                    <card :bordered="false">
                        <div class="top-btn-action">
                            <router-link :to="{
                                path: '/member/user/message/groups/create',
                                query: {
                                    type: '0',
                                },
                            }">
                                <i-button class="btn-action" type="ghost">+新增分组</i-button>
                            </router-link>
                            <i-button class="btn-action" type="ghost">刷新</i-button>
                        </div>
                        <i-table :columns="columns"
                                 :data="list"
                                 @on-selection-change="selectionChange"
                                 ref="list"
                                 highlight-row>
                        </i-table>
                        <div class="ivu-page-wrap">
                            <page :current="page.current"
                                  :page-size="page.paginate"
                                  :total="page.count"
                                  @on-change="changePage"
                                  show-elevator></page>
                        </div>
                    </card>
                </tab-pane>
            </tabs>
            <modal
                    v-model="modal"
                    title="删除" class="setting-modal-delete">
                <div>
                    <i-form ref="deleteModal" :model="deleteModal" :label-width="120">
                        <row>
                            <i-col class="first-row-title delete-file-tip">
                                <span>
                                    确定要删除分组"{{ deleteModal.name }}"吗？</span>
                            </i-col>
                        </row>
                        <row>
                            <i-col class="btn-group">
                                <i-button type="ghost" class="cancel-btn"
                                          @click.native="submitCancel">取消</i-button>
                                <i-button :loading="loading" type="primary" class="cancel-btn"
                                          @click.native="submitDelete">
                                    <span v-if="!loading">确认</span>
                                    <span v-else>正在删除…</span>
                                </i-button>
                            </i-col>
                        </row>
                    </i-form>
                </div>
            </modal>
        </div>
    </div>
</template>