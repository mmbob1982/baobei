INSERT INTO `phpcms_model_field` (`modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES ($modelid, 1, 'companyname', '��ҵ����', '', '', 1, 100, '', '��������ҵ����', 'text', 'array (\n  ''size'' => ''35'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0);
INSERT INTO `phpcms_model_field` (`modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES ($modelid, 1, 'catids', '��Ӫ��ҵ', '', 'size="8" style="width:195px;"', 1, 200, '', '', 'catids', 'array (\n  ''boxtype'' => ''multiple'',\n  ''filtertype'' => ''1'',\n)', 'onchange="select_catids();"', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 0, 0, 0);
INSERT INTO `phpcms_model_field` (`modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES ($modelid, 1, 'pattern', '��Ӫģʽ', '', '', 1, 255, '', '', 'box', 'array (\n  ''options'' => ''������|������\r\nó����|ó����\r\n������|������\r\n��������������|��������������'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''width'' => '''',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 0, 0, 0);
INSERT INTO `phpcms_model_field` (`modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES ($modelid, 1, 'products', '��Ӫ��Ʒ�����', '', '', 0, 0, '', '', 'textarea', 'array (\n  ''width'' => ''60'',\n  ''height'' => ''125'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0);
INSERT INTO `phpcms_model_field` (`modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES ($modelid, 1, 'genre', '��˾����', '', '', 1, 30, '', '', 'box', 'array (\n  ''options'' => ''��ҵ��λ|��ҵ��λ\r\n���徭Ӫ|���徭Ӫ\r\n��ҵ��λ���������|��ҵ��λ���������\r\nδ������ע�ᣬ����|δ������ע�ᣬ����'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''varchar'',\n  ''width'' => ''150'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''δ������ע�ᣬ����'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 2, 0, 0);
INSERT INTO `phpcms_model_field` (`modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES ($modelid, 1, 'areaname', '��˾���ڵ�', '', '', 1, 10, '', '', 'box', 'array (\n  ''options'' => ''����|����\r\n�Ϻ�|�Ϻ�\r\n����|����\r\n����|����\r\n����|����\r\n�Ͼ�|�Ͼ�\r\n�人|�人\r\n���|���\r\n�ɶ�|�ɶ�\r\n������|������\r\n����|����\r\n����|����\r\n����|����\r\n����|����\r\n����|����\r\n����|����\r\n�ൺ|�ൺ\r\n����|����\r\n����|����\r\n����|����\r\n��ɳ|��ɳ\r\n�Ϸ�|�Ϸ�\r\n����|����\r\n�ϲ�|�ϲ�\r\n֣��|֣��\r\n����|����\r\n����|����\r\n����|����\r\nʯ��ׯ|ʯ��ׯ\r\n��ݸ|��ݸ\r\n����|����\r\n����|����\r\n����|����\r\n�㶫|�㶫\r\n����|����\r\n����|����\r\n����|����\r\n�ӱ�|�ӱ�\r\n������|������\r\n����|����\r\n����|����\r\n����|����\r\n����|����\r\n����|����\r\n����|����\r\n����|����\r\n���ɹ�|���ɹ�\r\n����|����\r\n�ຣ|�ຣ\r\nɽ��|ɽ��\r\nɽ��|ɽ��\r\n����|����\r\n�Ĵ�|�Ĵ�\r\n�½�|�½�\r\n����|����\r\n����|����\r\n�㽭|�㽭\r\n����|����\r\n̨��|̨��\r\n���|���\r\n����|����\r\n��ɽ|��ɽ\r\n�麣|�麣\r\n��ɽ|��ɽ\r\n����|����\r\n����|����'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''varchar'',\n  ''width'' => '''',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 3, 0, 0);
INSERT INTO `phpcms_model_field` (`modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES ($modelid, 1, 'address', '��Ӫ��ַ', '', '', 0, 100, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '-99', '-99', 0, 1, 0, 1, 0, 1, 1, 0, 4, 0, 0);
INSERT INTO `phpcms_model_field` (`modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES ($modelid, 1, 'qq', '��ҵQQ', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 0, 0, 0);
INSERT INTO `phpcms_model_field` (`modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES ($modelid, 1, 'web_url', '������ַ', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 0, 0, 0);