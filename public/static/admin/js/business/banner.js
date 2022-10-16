define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'business.banner/index',
        add_url: 'business.banner/add',
        edit_url: 'business.banner/edit',
        delete_url: 'business.banner/delete',
        export_url: 'business.banner/export',
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
                    // {field: 'blockchain', minWidth: 80, title: '鏈'},
                    {field: 'start_date', minWidth: 80, title: '開始日', search: 'range'},
                    {field: 'end_date', minWidth: 80, title: '結束日', search:'range'},
                    {field: 'banner_url', minWidth: 80, title: '廣告圖', search: false, templet: ea.table.image},
                    {field: 'ind', minWidth: 80, title: '廣告位置', search: false},
                    {field: 'description', minWidth: 80, title: '廣告文字', search: false},
                    {field: 'ext_url', minWidth: 80, title: '廣告連結', search: false},
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