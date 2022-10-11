define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'business.projects/index',
        add_url: 'business.projects/add',
        edit_url: 'business.projects/edit',
        modify_url: 'business.projects/modify',
        delete_url: 'business.projects/delete',
        update_nft_url: 'business.projects/updateNft',
        ad_url: 'business.adverts/index',
        export_url: 'business.projects/export',
    };

    var Controller = {
        index: function () {
            ea.table.render({
                init: init,
                cols: [[
                    {type: "checkbox"},
                    {field: 'id', width: 80, title: 'ID'},
                    {field: 'blockchain', minWidth: 80, title: '鏈'},
                    {field: 'name', minWidth: 80, title: '項目', searchOp:'%*%'},
                    {field: 'photo_url', minWidth: 80, title: '圖', search: false, templet: ea.table.image},
                    {field: 'contract', minWidth: 80, title: '合約', search:false},
                    {field: 'item_qty', minWidth: 80, title: '總數', search:false},
                    {field: 'introduction', minWidth: 80, title: '簡介', search:false},

                    {field: 'update_ind', minWidth: 130, title: '24h交易前300項目', search: 'select', selectList: {2: '否', 1: '是'}, hide:true},
                    {field: 'level_ind', minWidth: 80, title: '重點項目', search: 'select', selectList: {2: '否', 1: '是'}, hide:true},

                    {field: 'valid', title: '狀態', width: 85, search: 'select', selectList: {2: '作廢', 1: '正常'}, templet: ea.table.switch},
                    {field: 'create_time', minWidth: 120, title: '新增時間', search:false},
                    {field: 'update_time', minWidth: 120, title: '修改時間', search:false},
                    {
                        width: 300,
                        title: '操作',
                        templet: ea.table.tool,
                        operat: [
                            [{
                                text: '广告图',
                                url: init.ad_url,
                                method: 'open',
                                auth: 'list',
                                class: 'layui-btn layui-btn-xs layui-btn-primary',
                                extend: 'data-full="true"'
                            },{
                                text: '更新NFT資訊',
                                url: init.update_nft_url,
                                method: 'request',
                                auth: 'edit',
                                class: 'layui-btn layui-btn-xs layui-btn-normal',
                            }, {
                                text: '编辑',
                                url: init.edit_url,
                                method: 'open',
                                auth: 'edit',
                                class: 'layui-btn layui-btn-xs layui-btn-success',
                                extend: 'data-full="true"',
                            }],
                            'delete'
                        ]
                    }
                ]],
            });

            ea.table.listenSwitch({filter: 'valid', url: init.modify_url});
            ea.table.listenEdit(init, 'currentTable', init.table_render_id, true);
            ea.listen();
        },
        add: function () {
            ea.listen();
        },
        edit: function () {
            ea.listen();
        }
    };
    return Controller;
});