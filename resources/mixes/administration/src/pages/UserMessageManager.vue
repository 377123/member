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
                        type: 'selection',
                        width: 60,
                    },
                    {
                        align: 'center',
                        key: 'sort',
                        render(h, data) {
                            const { row } = data.row;
                            return h('tooltip', {
                                props: {
                                    placement: 'right-end',
                                },
                                scopedSlots: {
                                    content() {
                                        return '回车更新数据';
                                    },
                                    default() {
                                        return h('i-input', {
                                            on: {
                                                'on-change': event => {
                                                    row.sort = event.target.value;
                                                },
                                                'on-enter': () => {
                                                    self.update(row);
                                                },
                                            },
                                            props: {
                                                value: self.list[data.index].sort,
                                            },
                                            style: {
                                                width: '84px',
                                            },
                                        });
                                    },
                                },
                            });
                        },
                        title: '排序',
                        width: 160,
                    },
                    {
                        align: 'center',
                        key: 'name',
                        title: '信息项名称',
                        width: 200,
                    },
                    {
                        align: 'center',
                        key: 'enabled',
                        render(h, data) {
                            const { row } = data.row;
                            return h('checkbox', {
                                on: {
                                    'on-change': value => {
                                        row.enabled = value;
                                    },
                                },
                            });
                        },
                        title: '是否必填',
                        width: 160,
                    },
                    {
                        align: 'center',
                        key: 'show',
                        render(h, data) {
                            const { row } = data.row;
                            return h('checkbox', {
                                on: {
                                    'on-change': value => {
                                        row.show = value;
                                    },
                                },
                            });
                        },
                        title: '注册是否显示',
                        width: 160,
                    },
                    {
                        key: 'is_show',
                        render(h, data) {
                            const { row } = data.row;
                            return h('checkbox', {
                                on: {
                                    'on-change': value => {
                                        row.is_show = value;
                                    },
                                },
                            });
                        },
                        title: '资料页是否显示',
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
                                                path: '/member/user/message/create',
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
                                            self.modal1 = true;
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
                        enabled: false,
                        id: 123,
                        is_show: false,
                        name: '视频链接',
                        show: false,
                        sort: null,
                    },
                    {
                        enabled: false,
                        id: 123,
                        is_show: false,
                        name: '视频链接',
                        show: false,
                        sort: null,
                    },
                ],
                modal1: false,
                modal2: false,
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
            batchRemove() {
                const self = this;
                const deletesMeg = [];
                self.selection.forEach(item => {
                    deletesMeg.push(item.id);
                });
                self.deleteModal.num = deletesMeg.length;
                if (deletesMeg.length < 1) {
                    self.$notice.open({
                        title: '请选择要删除的信息!',
                    });
                } else {
                    self.modal2 = true;
                }
            },
            submitCancel(data) {
                if (data === 1) {
                    this.modal1 = false;
                }
                if (data === 2) {
                    this.modal2 = false;
                }
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
                <tab-pane label="信息管理" name="name">
                    <card :bordered="false">
                        <div class="top-btn-action">
                            <router-link :to="{
                                path: '/member/user/message/create',
                                query: {
                                    type: '0',
                                },
                            }">
                                <i-button class="btn-action" type="ghost">+新增信息</i-button>
                            </router-link>
                            <i-button class="btn-action" @click.native="batchRemove"
                                      type="ghost">批量删除</i-button>
                            <i-button class="btn-action" type="ghost">刷新</i-button>
                        </div>
                        <i-table :columns="columns"
                                 class="message-table"
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
                    v-model="modal1"
                    title="删除" class="setting-modal-delete">
                <div>
                    <i-form ref="deleteModal" :model="deleteModal" :label-width="120">
                        <row>
                            <i-col class="first-row-title delete-file-tip">
                                <span>
                                    确定要删除信息项"{{ deleteModal.name }}"吗？</span>
                            </i-col>
                        </row>
                        <row>
                            <i-col class="btn-group">
                                <i-button type="ghost" class="cancel-btn"
                                          @click.native="submitCancel(1)">取消</i-button>
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
            <modal
                    v-model="modal2"
                    title="删除" class="setting-modal-delete">
                <div>
                    <i-form ref="deleteModal" :model="deleteModal" :label-width="120">
                        <row>
                            <i-col class="first-row-title delete-file-tip">
                                <span>
                                    确定要删除这{{ deleteModal.num }}项信息吗？
                                </span>
                            </i-col>
                        </row>
                        <row>
                            <i-col class="btn-group">
                                <i-button type="ghost" class="cancel-btn"
                                          @click.native="submitCancel(2)">取消</i-button>
                                <i-button :loading="loading" type="primary" class="cancel-btn"
                                          @click.native="batchRemovesure">
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