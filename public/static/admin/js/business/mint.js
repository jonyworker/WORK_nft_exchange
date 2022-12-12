define(["jquery", "easy-admin"], function ($, ea) {
    var form = layui.form;
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
                    // {field: 'blockchain', minWidth: 80, title: '鏈'},
                    {field: 'collection', minWidth: 80, title: '項目', searchOp:'%*%'},
                    {field: 'date', minWidth: 80, title: '日期區間', search:'range'},
<<<<<<< HEAD
                    {field: 'is_tab', minWidth: 80, title: 'TBA', selectList: {2: 'TBA', 1: '非TBA'},},
=======
                    {field: 'is_tba', minWidth: 80, title: 'TAB', selectList: {2: 'TAB', 1: '非TBA'},},
>>>>>>> 7d3611e0f33cc5c74cb36999aeb8290d1e54c809
                    {field: 'collection_url', minWidth: 80, title: '圖', search: false, templet: ea.table.image},
                    {field: 'price', minWidth: 80, title: '價格', search: false},
                    {field: 'total', minWidth: 80, title: '總數', search: false},
                    // {field: 'website', minWidth: 80, title: '網站', search: false},
                    // {field: 'twitter', minWidth: 80, title: 'Twitter', search: false},
                    // {field: 'discord', minWidth: 80, title: 'Discord', search: false},
                    // {field: 'introduction', minWidth: 80, title: '簡介', search: false},
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

    form.on('checkbox(changeIsTab)', function(data){
        console.log(data.elem); //得到checkbox原始DOM对象
        console.log(data.elem.checked); //是否被选中，true或者false
        console.log(data.value); //复选框value值，也可以通过data.elem.value得到
        console.log(data.othis); //得到美化后的DOM对象
        if (data.elem.checked) {
            $('#ori_date').removeAttr('lay-verify');
            $('#date').removeAttr('lay-verify');
            $('#utc').removeAttr('lay-verify');
        } else {
            $('#ori_date').attr('lay-verify','required');
            $('#date').attr('lay-verify','required');
            $('#utc').attr('lay-verify','required');
        }
    });

    form.on('select(changeUtc)', function(data){
        changeDate();
    })

    $('body').on("change",'#ori_date',function(){
        changeDate();
    })

    function changeDate() {
        if (!$('#ori_date').val() || !$('#utc').val()) {
            return;
        }
        var date = new Date($('#ori_date').val());
        var time = 8 - $('#utc').val();
        date.setHours(date.getHours() + time);

        var y = date.getFullYear();
        var m = (date.getMonth() + 1) < 10 ? ("0" + (date.getMonth() + 1)) : (date.getMinutes() + 1);
        var d = date.getDate() < 10 ? ("0" + date.getDate()) : date.getDate();
        var h = date.getHours() < 10 ? ('0' + date.getHours()) : date.getHours()
        var f = date.getMinutes() < 10 ? ('0' + date.getMinutes()) : date.getMinutes()
        var s = date.getSeconds() < 10 ? ('0' + date.getSeconds()) : date.getSeconds()

        const newDate = y + '-' + m + '-' + d + " " + h + ":" + f + ":" + s;
        $('#date').val(newDate);
    }
    return Controller;
});