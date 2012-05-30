CKEDITOR.plugins.add('flvPlayer',
{
    init: function(editor)    
    {        
        //plugin code goes here
        var pluginName = 'flvPlayer';        
        CKEDITOR.dialog.add(pluginName, this.path + 'dialogs/flvPlayer.js');
        editor.config.flv_path = editor.config.flv_path || ( this.path);
        editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName));        
        /*editor.addCommand('flvPlayer', new CKEDITOR.dialogCommand('flvPlayer'));
        CKEDITOR.dialog.add('flvPlayer',
        function(editor) {
            return {
                title: '����Flv��Ƶ',
                minWidth: 350,
                minHeight: 100,
                contents: [{
                    id: 'tab1',
                    label: 'First Tab',
                    title: 'First Tab',
                    elements: [{
                        id: 'pagetitle',
                        type: 'text',
                        label: '��������һҳ���±���<br />(������Ĭ��ʹ�õ�ǰ����+������ʽ)'
                    }]
                }],
                onOk: function() {
                    editor.insertHtml(" [page = "+this.getValueOf( 'tab1', 'pagetitle' )+"]");
                }
            };
        });*/
        editor.ui.addButton('flvPlayer',
        {               
            label: '����Flv��Ƶ',
            command: pluginName,
			icon: this.path + 'images/flvPlayer.gif'
        });
    }
});