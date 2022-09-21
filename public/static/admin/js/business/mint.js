define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'business.mint/index',
        add_url: 'business.mint/add',
        edit_url: 'business.mint/edit',
        delete_url: 'business.mint/delete',
        export_url: 'business.mint/export',
    };

    //鏈	    	blockchain		菜單項目取配置blockchain數組, 用value搜
    // 項目			collection%%
    // 日期區間     date
    //TBA          菜單            菜單項目取: 全部/TBA/非TBA
    //                              TAB取 is_tba=2,    非TBA取is_tba=1
    var Controller = {
        index: function () {
            ea.table.render({
                init: init,
                cols: [[
                    {type: "checkbox"},
                    {field: 'id', width: 80, title: 'ID'},
                    {field: 'blockchain', minWidth: 80, title: '鏈'},
                    {field: 'collection', minWidth: 80, title: '項目', searchOp:'%*%'},
                    {field: 'date', minWidth: 80, title: '日期區間', search:'range'},
                    {field: 'is_tab', minWidth: 80, title: 'TAB', selectList: {2: 'TAB', 1: '非TBA'},},
                    {field: 'collection_url', minWidth: 80, title: '圖', search: false, templet: ea.table.image},
                    {field: 'price', minWidth: 80, title: '價格', search: false},
                    {field: 'total', minWidth: 80, title: '總數', search: false},
                    {field: 'website', minWidth: 80, title: '網站', search: false},
                    {field: 'twitter', minWidth: 80, title: 'Twitter', search: false},
                    {field: 'discord', minWidth: 80, title: 'Discord', search: false},
                    {field: 'introduction', minWidth: 80, title: '簡介', search: false},
                    {field: 'createName', minWidth: 80, title: '建單人員', search:false},
                    {field: 'create_time', minWidth: 120, title: '新增時間', search:false},
                    {field: 'update_time', minWidth: 120, title: '修改時間', search:false},
                    {
                        width: 300,
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