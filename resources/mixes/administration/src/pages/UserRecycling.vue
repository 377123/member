<script>
    export default {
        beforeRouteEnter(to, from, next) {
            next(() => {
            });
        },
        data() {
            const self = this;
            return {
                columns: [
                    {
                        align: 'center',
                        type: 'selection',
                        width: 60,
                    },
                    {
                        align: 'center',
                        key: 'name',
                        title: '姓名',
                        width: 120,
                    },
                    {
                        align: 'center',
                        key: 'user_name',
                        title: '用户名',
                        width: 140,
                    },
                    {
                        align: 'center',
                        key: 'id',
                        title: 'ID',
                        width: 140,
                    },
                    {
                        key: 'email',
                        title: '邮箱',
                        width: 240,
                    },
                    {
                        key: 'phone',
                        title: '手机',
                    },
                    {
                        align: 'center',
                        key: 'action',
                        render(h, data) {
                            return h('div', [
                                h('i-button', {
                                    on: {
                                        click() {},
                                    },
                                    props: {
                                        size: 'small',
                                        type: 'ghost',
                                    },
                                }, '还原'),
                                h('i-button', {
                                    on: {
                                        click() {
                                            self.deleteModal.name = data.row.name;
                                            self.deleteModal.type = 0;
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
                deleteModal: {
                    name: 'ibenchu',
                    num: 2,
                    mode: 0,
                    type: 0,
                },
                modal1: false,
                modal2: false,
                page: {
                    count: 3,
                    current: 1,
                    paginate: 2,
                },
                list: [
                    {
                        email: '3265256564@ibenchu.com',
                        id: 1323,
                        name: 'benchu',
                        phone: 3137264,
                        user_name: 'admin',
                    },
                    {
                        email: '3265256564@ibenchu.com',
                        id: 1323,
                        name: 'benchu',
                        phone: 3137264,
                        user_name: 'admin',
                    },
                    {
                        email: '3265256564@ibenchu.com',
                        id: 1323,
                        name: 'benchu',
                        phone: 3137264,
                        user_name: 'admin',
                    },
                ],
                selection: [],
            };
        },
        methods: {
            changePage() {},
            batchRemove() {
                const self = this;
                const deletesRet = [];
                self.deleteModal.mode = -2;
                self.selection.forEach(item => {
                    deletesRet.push(item.id);
                });
                self.deleteModal.num = deletesRet.length;
                if (deletesRet.length < 1) {
                    self.$notice.open({
                        title: '请选择要删除的用户!',
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
                <tab-pane label="回收站" name="name">
                    <card :bordered="false">
                        <div class="top-btn-action">
                            <i-button class="btn-action" type="ghost">批量还原</i-button>
                            <i-button class="btn-action" @click.native="batchRemove"
                                      type="ghost">批量删除</i-button>
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
                    v-model="modal1"
                    title="删除" class="setting-modal-delete">
                <div>
                    <i-form ref="deleteModal" :model="deleteModal" :label-width="120">
                        <row>
                            <i-col class="first-row-title delete-file-tip">
                                <span>
                                    确定要删除用户"{{ deleteModal.name }}"吗？</span>
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
                                    确定要删除这{{ deleteModal.num }}个用户吗？
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