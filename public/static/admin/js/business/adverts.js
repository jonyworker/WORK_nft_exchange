define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'business.adverts/index',
        add_url: 'business.adverts/add',
        edit_url: 'business.adverts/edit',
        delete_url: 'business.adverts/delete',
        export_url: 'business.adverts/export',
    };

    // ID           ad.id
    //   廣告位置     ad.ad_location
    //   廣告圖       ad.ad_photo_url    顯示 300*300的縮圖, 點了彈窗看 原圖
    //   跳轉連結     ad.link
    //   新增時間     ad.createTime

    var Controller = {
        index: function () {
            ea.table.rendxer({
                init: init,
                toolbar:['refresh', 'delete'],
                cols: [[
                    {type: "checkbox"},
                    {field: 'id', width: 80, title: 'ID'},
                    {field: 'ad_location', minWidth: 120, title: '廣告位置', search: false},
                    {field: 'photo_url', minWidth: 80, title: '圖', search: false, templet: ea.table.image},
                    {field: 'link', minWidth: 80, title: '跳轉連結', search: false,},
                    {field: 'create_time', minWidth: 120, title: '新增時間', search:false},
                    {field: 'update_time', minWidth: 120, title: '修改時間', search:false},
                    {
                        width: 120,
                        title: '操作',
                        templet: ea.table.tool,
                        operat: [
                            [{
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