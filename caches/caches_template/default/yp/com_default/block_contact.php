<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><div class="qq-contact">
    <h2>QQ MESSENGER: 
    <a onclick="var tempSrc='http://sighttp.qq.com/wpa.js?rantime='+Math.random()+'&amp;sigkey=d828947cf9df022a8e99ea3ef9718cdd11b23118217c80050b5d84e9bffa060b';var oldscript=document.getElementById('testJs');var newscript=document.createElement('script');newscript.setAttribute('type','text/javascript'); newscript.setAttribute('id', 'testJs');newscript.setAttribute('src',tempSrc);if(oldscript == null){document.body.appendChild(newscript);}else{oldscript.parentNode.replaceChild(newscript, oldscript);}return false;" target="_blank;" ;="" href="http://sighttp.qq.com/cgi-bin/check?sigkey=d828947cf9df022a8e99ea3ef9718cdd11b23118217c80050b5d84e9bffa060b"><?php echo $array['qq'];?></a>  
    </h2>
    <h2>
    <a href="mailto:<?php echo $array['email'];?>">E-mail:<?php echo $array['email'];?></a>
    </h2>
    <h3>TEL:<?php echo $array['telephone'];?></h3>
</div>
