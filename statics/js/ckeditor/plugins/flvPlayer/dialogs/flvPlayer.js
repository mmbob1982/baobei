CKEDITOR.dialog.add('flvPlayer',　function(a){
    var b = a.config;
    var　escape　=　function(value){
　　　　　　　　return　value;
　　　　};
　　　　return　{

　　　　　　　　title:　'峨秘Flv篇撞',
　　　　　　　　resizable:　CKEDITOR.DIALOG_RESIZE_BOTH,
　　　　　　　　minWidth: 350,
                minHeight: 300,
　　　　　　　　contents:　[{
　　　　　　　　　　id: 'info',
                    label: '械号',
                    accessKey: 'P',
                    elements:[
                        {
                        type: 'hbox',
                        widths : [ '80%', '20%' ],
                        children:[{
                                id: 'src',
                                type: 'text',
                                label: '坿猟周'
                            },{
                                type: 'button',
                                id: 'browse',
                                filebrowser: 'info:src',
                                hidden: true,
                                align: 'center',
                                label: '箝誓捲暦匂'
                            }]
                        },
                        {
                        type: 'hbox',
                        widths : [ '35%', '35%', '30%' ],
                        children:[{
                            type:　'text',
　　　　　　　　　　　　　　label:　'篇撞錐業',
　　　　　　　　　　　　　　id:　'mywidth',
　　　　　　　　　　　　　　'default':　'470px',
　　　　　　　　　　　　　　style:　'width:50px'
                        },{
                            type:　'text',
　　　　　　　　　　　　　　label:　'篇撞互業',
　　　　　　　　　　　　　　id:　'myheight',
　　　　　　　　　　　　　　'default':　'320px',
　　　　　　　　　　　　　　style:　'width:50px'
                        },{
                            type:　'select',
　　　　　　　　　　　　　　label:　'徭強殴慧',
　　　　　　　　　　　　　　id:　'myloop',
　　　　　　　　　　　　　　required:　true,
　　　　　　　　　　　　　　'default':　'false',
　　　　　　　　　　　　　　items:　[['頁',　'true'],　['倦',　'false']]
                        }]//children finish
                        },{
　　　　　　　　　　        type:　'textarea',
　　　　　　　　　　　　　　style:　'width:300px;height:220px',
　　　　　　　　　　　　　　label:　'圓誓',
　　　　　　　　　　　　　　id:　'code'
　　　　　　　　　　    }]
                    }, {
                        id: 'Upload',
                        hidden: true,
                        filebrowser: 'uploadButton',
                        label: '貧勧',
                        elements: [{
                            type: 'file',
                            id: 'upload',
                            label: '貧勧',
                            size: 38
                        },
                        {
                            type: 'fileButton',
                            id: 'uploadButton',
                            label: '窟僕欺捲暦匂',
                            filebrowser: 'info:src',
                            'for': ['Upload', 'upload']//'page_id', 'element_id'
                        }]
　　　　　　　　}],
　　　　　　　　onOk:　function(){
　　　　　　　　　　　　mywidth　=　this.getValueOf('info',　'mywidth');
　　　　　　　　　　　　myheight　=　this.getValueOf('info',　'myheight');
　　　　　　　　　　　　myloop　=　this.getValueOf('info',　'myloop');
　　　　　　　　　　　　mysrc　=　this.getValueOf('info',　'src');
　　　　　　　　　　　　html　=　''　+　escape(mysrc)　+　'';
　　　　　　　　　　　　//editor.insertHtml("<pre　class=\"brush:"　+　lang　+　";\">"　+　html　+　"</pre>");
　　　　　　　　　　　　a.insertHtml("<embed height=\""　+　myheight　+　"\" width=\""　+　mywidth　+　"\" flashvars=\"icon=false\&amp;file="　+　html　+　"\&amp;skin=" +b.flv_path + "player\/skin.zip\&amp;autostart=" +　myloop　+　"\" allowfullscreen=\"true\" allowscriptaccess=\"always\" bgcolor=\"#ffffff\" src=\"" + b.flv_path +"player\/player.swf\"></embed>");
　　　　　　　　},
　　　　　　　　onLoad:　function(){
　　　　　　　　}
　　　　};
});