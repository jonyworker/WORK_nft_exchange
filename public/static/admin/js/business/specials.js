define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'business.specials/index',
        add_url: 'business.specials/add',
        edit_url: 'business.specials/edit',
        delete_url: 'business.specials/delete',
        export_url: 'business.specials/export',
    };

    var Controller = {
        index: function () {
            ea.table.render({
                init: init,
                cols: [[
                    {type: "checkbox"},
                    {field: 'id', width: 80, title: 'ID'},
                    {field: 'title', minWidth: 80, title: '主標(繁)'},
                    // {field: 'sub_title', minWidth: 80, title: '副標(繁)'},
                    // {field: 'content', minWidth: 80, title: '內文', search:false},
                    //
                    // {field: 'title_en', minWidth: 80, title: '主標(英/原文)', search:false},
                    // {field: 'content_en', minWidth: 80, title: '內文(英/原文)', search:false},
                    // {field: 'title_en_public', minWidth: 80, title: '主標(英//對外)', search:false},
                    // {field: 'content_en_public', minWidth: 80, title: '內文(英//對外)', search:false},
                    //
                    {field: 'start_date', minWidth: 80, title: '上架日', search:false},
                    {field: 'large_photo_url', minWidth: 80, title: '專欄大圖', search: false, templet: ea.table.image},
                    {field: 'small_photo_url', minWidth: 80, title: '專欄小圖', search: false, templet: ea.table.image},
                    {field: 'source', minWidth: 80, title: '來源'},
                    {field: 'valid', title: '狀態', width: 85, search: 'select', selectList: {2: '作廢', 1: '正常'}, templet: ea.table.switch},
                    {field: 'createName', minWidth: 80, title: '建單人員', search:false},
                    {field: 'create_time', minWidth: 120, title: '新增時間', search:false},
                    {field: 'update_time', minWidth: 120, title: '修改時間', search:false},
                    {
                        width: 140,
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