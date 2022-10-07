CKEDITOR.editorConfig = function (config) {
    config.language = 'zh-cn';
    config.image_previewText = ' ';
    config.height = 500;
    config.width = 'auto';

	// config.extraPlugins = 'image2';

	// config.extraPlugins =  'simage';  //to enable to plugin
	// config.imageUploadURL = "/admin/ajax/uploadEditor";
	// config.dataParser = func(data);

    // config.toolbarGroups = [
    //     {name: 'document', groups: ['mode', 'document', 'doctools']},
    //     {name: 'styles', groups: ['Font', 'FontSize']},
    //     {name: 'colors'},
    //     {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
    //     {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
    //     {name: 'insert'},
    //     {name: 'others'},
    //     {name: 'forms'},
    //     {name: 'links'},
    //     {name: 'clipboard', groups: ['clipboard', 'undo']},
    //     { name: 'insert', groups: [ 'EasyImageUpload' ] },
    //     {name: 'tools'},
    // ];
    config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] },

		// { name: 'image2', groups: [ 'image2' ] },
		// { name: 'simage', groups: [ 'simage' ] }
	];
    config.filebrowserImageUploadUrl = config.filebrowserImageUploadUrl || "/admin/ajax/uploadEditor";

    config.removeButtons = 'Underline,Subscript,Superscript';

    config.format_tags = 'p;h1;h2;h3;pre';

    // config.removeDialogTabs = 'image:advanced;link:advanced';
    config.removeButtons = 'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Subscript,Superscript,RemoveFormat,Outdent,Indent,CreateDiv,BidiLtr,BidiRtl,Language,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Flash,FontSize,Font,TextColor,BGColor,Maximize,ShowBlocks,About,Styles,Anchor';

    config.font_names = '微软雅黑/Microsoft YaHei;宋体/SimSun;新宋体/NSimSun;仿宋/FangSong;楷体/KaiTi;黑体/SimHei;' + config.font_names;
};
