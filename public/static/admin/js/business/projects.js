define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'business.projects/index',
        add_url: 'business.projects/add',
        edit_url: 'business.projects/edit',
        delete_url: 'business.projects/delete',
        update_nft_url: 'business.projects/updateNft',
        ad_url: 'business.adverts/index',
        export_url: 'business.projects/export',
    };

    //鏈			blockchain		1:以太鏈
    // 項目			name
    // 圖			photo_url		取出為：圖片絕對路徑, 顯示50*50縮圖,
    // 點了另開新窗看大圖片(400*400)
    // 合約			contract         取出只顯示8碼, mouse over tip顯示完整字符
    // 總數			item_qty
    // 簡介			introduction		寬度固定為400px, 多出寬度給 項目、編輯
    //                              最多顯示100個字, 超過後面加上 …
    //                              Mouse hover上方就tipt出完整文字
    // 修改時間		editTime

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
                    {field: 'contract', minWidth: 80, title: '合約'},
                    {field: 'item_qty', minWidth: 80, title: '總數'},
                    {field: 'introduction', minWidth: 80, title: '簡介'},
                    {field: 'valid', title: '狀態', width: 85, search: 'select', selectList: {2: '作廢', 1: '正常'}, templet: ea.table.switch},
                    {field: 'process', title: '審核', width: 85, search: 'select', selectList: {2: '已審核 ', 1: '未審核'}, templet: ea.table.switch},
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

            ea.listen();
        },
        add: function () {
            ea.listen();
        },
        edit: function () {
            ea.listen();
        },
    };
    return Controller;
});