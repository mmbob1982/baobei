CKEDITOR.dialog.add('flvPlayer',��function(a){
    var b = a.config;
    var��escape��=��function(value){
����������������return��value;
��������};
��������return��{

����������������title:��'����Flv��Ƶ',
����������������resizable:��CKEDITOR.DIALOG_RESIZE_BOTH,
����������������minWidth: 350,
                minHeight: 300,
����������������contents:��[{
��������������������id: 'info',
                    label: '����',
                    accessKey: 'P',
                    elements:[
                        {
                        type: 'hbox',
                        widths : [ '80%', '20%' ],
                        children:[{
                                id: 'src',
                                type: 'text',
                                label: 'Դ�ļ�'
                            },{
                                type: 'button',
                                id: 'browse',
                                filebrowser: 'info:src',
                                hidden: true,
                                align: 'center',
                                label: '���������'
                            }]
                        },
                        {
                        type: 'hbox',
                        widths : [ '35%', '35%', '30%' ],
                        children:[{
                            type:��'text',
����������������������������label:��'��Ƶ���',
����������������������������id:��'mywidth',
����������������������������'default':��'470px',
����������������������������style:��'width:50px'
                        },{
                            type:��'text',
����������������������������label:��'��Ƶ�߶�',
����������������������������id:��'myheight',
����������������������������'default':��'320px',
����������������������������style:��'width:50px'
                        },{
                            type:��'select',
����������������������������label:��'�Զ�����',
����������������������������id:��'myloop',
����������������������������required:��true,
����������������������������'default':��'false',
����������������������������items:��[['��',��'true'],��['��',��'false']]
                        }]//children finish
                        },{
��������������������        type:��'textarea',
����������������������������style:��'width:300px;height:220px',
����������������������������label:��'Ԥ��',
����������������������������id:��'code'
��������������������    }]
                    }, {
                        id: 'Upload',
                        hidden: true,
                        filebrowser: 'uploadButton',
                        label: '�ϴ�',
                        elements: [{
                            type: 'file',
                            id: 'upload',
                            label: '�ϴ�',
                            size: 38
                        },
                        {
                            type: 'fileButton',
                            id: 'uploadButton',
                            label: '���͵�������',
                            filebrowser: 'info:src',
                            'for': ['Upload', 'upload']//'page_id', 'element_id'
                        }]
����������������}],
����������������onOk:��function(){
������������������������mywidth��=��this.getValueOf('info',��'mywidth');
������������������������myheight��=��this.getValueOf('info',��'myheight');
������������������������myloop��=��this.getValueOf('info',��'myloop');
������������������������mysrc��=��this.getValueOf('info',��'src');
������������������������html��=��''��+��escape(mysrc)��+��'';
������������������������//editor.insertHtml("<pre��class=\"brush:"��+��lang��+��";\">"��+��html��+��"</pre>");
������������������������a.insertHtml("<embed height=\""��+��myheight��+��"\" width=\""��+��mywidth��+��"\" flashvars=\"icon=false\&amp;file="��+��html��+��"\&amp;skin=" +b.flv_path + "player\/skin.zip\&amp;autostart=" +��myloop��+��"\" allowfullscreen=\"true\" allowscriptaccess=\"always\" bgcolor=\"#ffffff\" src=\"" + b.flv_path +"player\/player.swf\"></embed>");
����������������},
����������������onLoad:��function(){
����������������}
��������};
});