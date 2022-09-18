define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'business.news/index',
        add_url: 'business.news/add',
        edit_url: 'business.news/edit',
        delete_url: 'business.news/delete',
        export_url: 'business.news/export',
    };

    var Controller = {
        index: function () {
            ea.table.render({
                init: init,
                cols: [[
                    {type: "checkbox"},
                    {field: 'id', width: 80, title: 'ID'},
                    {field: 'title', minWidth: 80, title: '主標(繁)', searchOp:'*%'},
                    {field: 'sub_title', minWidth: 80, title: '副標(繁)', searchOp:'*%'},
                    {field: 'content', minWidth: 80, title: '內文', search:false},
                    {field: 'start_date', minWidth: 80, title: '上架日', search:false},
                    {field: 'photo_url', minWidth: 80, title: '圖', search: false, templet: ea.table.image},
                    {field: 'source', minWidth: 80, title: '來源'},
                    {field: 'valid', title: '狀態', width: 85, search: 'select', selectList: {2: '作廢', 1: '正常'}, templet: ea.table.switch},
                    {field: 'createName', minWidth: 80, title: '建單人員', search:false},
                    {field: 'create_time', minWidth: 120, title: '新增時間', search:false},
                    {field: 'update_time', minWidth: 120, title: '修改時間', search:false},
                    {width: 140, title: '操作', templet: ea.table.tool}
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