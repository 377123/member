<script>
    import injection from '../helpers/injection';

    export default {
        beforeRouteEnter(to, from, next) {
            injection.loading.start();
            injection.http.post(`${window.api}/member/administration/ban/list`).then(response => {
                next(vm => {
                    window.console.log(response.data);
                    vm.list = response.data.data;
                    injection.loading.finish();
                });
            }).catch(() => {
                injection.loading.error();
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
                        key: 'avatar',
                        render(h, data) {
                            if (data.row.member.avatar) {
                                return h('img', {
                                    domProps: {
                                        class: {
                                            'user-list-image': true,
                                        },
                                        src: data.row.member.avatar,
                                    },
                                });
                            }
                            return '';
                        },
                        title: injection.trans('member.user.table.avatar'),
                        width: 66,
                    },
                    {
                        key: 'name',
                        title: injection.trans('member.user.table.title'),
                        render(row) {
                            return row.member.name;
                        },
                        width: 130,
                    },
                    {
                        key: 'created_at',
                        title: injection.trans('member.ban.table.date'),
                    },
                    {
                        key: 'handle',
                        render(h, data) {
                            return h('div', [
                                h('router-link', {
                                    props: {
                                        to: `/member/user/${data.row.id}/group`,
                                    },
                                    style: {
                                        marginLeft: '10px',
                                    },
                                }, [
                                    h('i-button', {
                                        props: {
                                            size: 'small',
                                            type: 'default',
                                        },
                                    }, '用户组'),
                                ]),
                                h('router-link', {
                                    props: {
                                        to: `/member/user/${data.row.id}/integral`,
                                    },
                                    style: {
                                        marginLeft: '10px',
                                    },
                                }, [
                                    h('i-button', {
                                        props: {
                                            size: 'small',
                                            type: 'default',
                                        },
                                    }, '积分'),
                                ]),
                                h('router-link', {
                                    props: {
                                        to: `/member/user/${data.row.id}/edit`,
                                    },
                                    style: {
                                        marginLeft: '10px',
                                    },
                                }, [
                                    h('i-button', {
                                        props: {
                                            size: 'small',
                                            type: 'default',
                                        },
                                    }, '编辑详情'),
                                ]),
                                h('router-link', {
                                    props: {
                                        to: `/member/user/${data.row.id}/ban`,
                                    },
                                    style: {
                                        marginLeft: '10px',
                                    },
                                }, [
                                    h('i-button', {
                                        props: {
                                            size: 'small',
                                            type: 'default',
                                        },
                                    }, '封禁'),
                                ]),
                                h('i-button', {
                                    on: {
                                        click() {
                                            self.remove(data.index);
                                        },
                                    },
                                    props: {
                                        size: 'small',
                                        type: 'error',
                                    },
                                    style: {
                                        marginLeft: '10px',
                                    },
                                }, '删除'),
                            ]);
                        },
                        title: injection.trans('member.user.table.handle'),
                        width: 300,
                    },
                ],
                groups: [],
                keyword: '',
                list: [],
                modal: {
                    loading: true,
                    visible: false,
                },
                pagination: {
                    last_page: 1,
                },
                selections: [],
                self: this,
                trans: injection.trans,
                user: {},
            };
        },
        methods: {
            output() {
                window.console.log('Output done!');
            },
            remove(index) {
                this.user = this.list[index];
                this.modal.visible = true;
            },
            selection(items) {
                this.selections = items;
            },
        },
        mounted() {
            this.$store.commit('title', '用户管理 - 用户中心');
        },
    };
</script>
<template>
    <div class="member-warp">
        <div class="user-ban">
            <tabs value="name">
                <tab-pane label="封禁用户" name="name">
                    <card :bordered="false">
                        <div class="header-search-module">
                            <div class="search">
                                <i-input :placeholder="trans('content.global.search.placeholder')" v-model="keyword">
                                    <i-select v-model="select3" slot="prepend" style="width: 80px">
                                        <i-option value="day">日活</i-option>
                                        <i-option value="month">月活</i-option>
                                    </i-select>
                                    <i-button slot="append" icon="ios-search" @click.native="search"></i-button>
                                </i-input>
                            </div>
                        </div>
                        <i-table :columns="columns"
                                 :context="self"
                                 :data="list"
                                 @on-selection-change="selection"></i-table>
                        <modal class-name="user-list-modal"
                               :loading="modal.loading"
                               :mask-closable="false"
                               title="删除用户"
                               :value="modal.visible"
                               :width="772"
                               @on-cancel="modal.visible = false"
                               @on-ok="remove">
                            <p>本操作不可恢复，您确定要删除用户 <strong>{{ user.name }}</strong> 吗？</p>
                            <i-form label-position="right" :label-width="148" :model="user" ref="form">
                                <form-item label="删除用户的理由">
                                    <i-input type="textarea" placeholder="请输入删除用户的理由" v-model="user.reason"
                                             :autosize="{minRows: 5,maxRows: 9}"></i-input>
                                    <p class="info">请输入操作理由，系统将把理由记录在用户删除记录中，以供日后查看。</p>
                                </form-item>
                            </i-form>
                        </modal>
                    </card>
                </tab-pane>
            </tabs>
        </div>
    </div>
</template>