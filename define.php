<?php

define('LINKS_SPLIT_CHAR'	,'&nbsp;|&nbsp;');

define('ROWS_OF_PAGE_STAFF',		48);
define('ROWS_OF_PAGE_CLIENT',		48);
define('ROWS_OF_PAGE_SUPPLIER',		48);
define('ROWS_OF_PAGE_STANDBY',		48);
define('ROWS_OF_PAGE_FILE',		48);
define('ROWS_OF_PAGE_MARK',		48);
define('ROWS_OF_PAGE_OUT',		24);
define('ROWS_OF_PAGE_SALE',		24);
define('ROWS_OF_PAGE_LEND',		24);
define('ROWS_OF_PAGE_REPAIR',		16);
define('ROWS_OF_PAGE_ARCHIVE',		24);

define('MARK_ITEM_FILE_ID'	,'mark_item');
define('MARK_ITEM_UID'		,0);
define('MARK_ITEM_NAME'		,1);
define('MARK_ITEM_STATUS'	,2);
define('MARK_ITEM_TIME'		,3);
define('MARK_ITEM_README'	,4);

define('MARK_FILE_ID'		,'mark');
define('MARK_UID'		,0);
define('MARK_CLIENT_ID'		,1);
define('MARK_NAME'		,2);

define('FILE_FILE_ID'			,'file');
define('FILE_UID'			,0);
define('FILE_NAME'			,1);

define('REPAIR_ARCHIVE_FILE_ID'		,'repair_archive');
define('REPAIR_ARCHIVE_UID'		,0);
define('REPAIR_ARCHIVE_CLIENT_ID'	,1);
define('REPAIR_ARCHIVE_STAFF_ID'	,2);
define('REPAIR_ARCHIVE_SUPPLIER_ID'	,3);
define('REPAIR_ARCHIVE_TIME'		,4);
define('REPAIR_ARCHIVE_TIME_RETURN'	,5);
define('REPAIR_ARCHIVE_REPORT'		,6);
define('REPAIR_ARCHIVE_COST'		,7);
define('REPAIR_ARCHIVE_NAME'		,8);
define('REPAIR_ARCHIVE_REASON'		,9);
define('REPAIR_ARCHIVE_SERIAL_IDS'	,10);

define('REPAIR_FILE_ID'		,'repair');
define('REPAIR_UID'		,0);
define('REPAIR_CLIENT_ID'	,1);
define('REPAIR_STAFF_ID'	,2);
define('REPAIR_SUPPLIER_ID'	,3);
define('REPAIR_TIME'		,4);
define('REPAIR_NAME'		,5);
define('REPAIR_REASON'		,6);
define('REPAIR_SERIAL_IDS'	,7);

define('OUT_FILE_ID'		,'out');
define('OUT_UID'		,0);
define('OUT_CLIENT_ID'		,1);
define('OUT_STAFF_ID'		,2);
define('OUT_REASON'		,3);
define('OUT_TIME'		,4);

define('LEND_FILE_ID'		,'lend');
define('LEND_UID'		,0);
define('LEND_STANDBY_ID'	,1);
define('LEND_CLIENT_ID'		,2);
define('LEND_TIME'		,3);
define('LEND_TIME_RETURN'	,4);

define('SALE_FILE_ID'		,'sale');
define('SALE_UID'		,0);
define('SALE_CLIENT_ID'		,1);
define('SALE_TIME'		,2);
define('SALE_TITLE'		,3);
define('SALE_CONTENT'		,4);

define('EXPIRED_FILE_ID'	,'expired');
define('EXPIRED_UID'		,0);
define('EXPIRED_CLIENT_ID'	,1);
define('EXPIRED_NAME'		,2);
define('EXPIRED_LOCATION'	,3);
define('EXPIRED_TIME'		,4);

define('STANDBY_FILE_ID'	,'standby');
define('STANDBY_UID'		,0);
define('STANDBY_STATUS'		,1);
define('STANDBY_CLIENT_ID'	,2);
define('STANDBY_LEND_ID'	,3);
define('STANDBY_LEND_TIME'	,4);
define('STANDBY_NAME'		,5);
define('STANDBY_LOCATION'	,6);
define('STANDBY_SERIAL_IDS'	,7);

define('STANDBY_STATUS_DISABLED',	0);
define('STANDBY_STATUS_NORMAL',		1);
define('STANDBY_STATUS_SCRAPPED',	2);
define('STANDBY_STATUS_LOST',		3);

define('SUPPLIER_FILE_ID'	,'supplier');
define('SUPPLIER_UID'		,0);
define('SUPPLIER_NAME'		,1);
define('SUPPLIER_TELEPHONE'	,2);
define('SUPPLIER_ADDRESS'	,3);

define('CLIENT_FILE_ID'		,'client');
define('CLIENT_UID'		,0);
define('CLIENT_COOPERATION'	,1);
define('CLIENT_NAME'		,2);
define('CLIENT_TELEPHONE'	,3);
define('CLIENT_ADDRESS'		,4);
define('CLIENT_TAG'		,5);
define('CLIENT_PROPERTY'	,6);

define('CLIENT_COOPERATION_END',	0);
define('CLIENT_COOPERATION_NORMAL',	1);
define('CLIENT_COOPERATION_PAUSE',	2);


define('ARCHIVE_FILE_ID'	,'archive');
define('ARCHIVE_UID'		,0);
define('ARCHIVE_STAFF_ID'	,1);
define('ARCHIVE_CLIENT_ID'	,2);
define('ARCHIVE_OPENED_TIME'	,3);
define('ARCHIVE_OPENED_STAFF_ID',4);
define('ARCHIVE_TAKING_TIME'	,5);
define('ARCHIVE_CLOSED_TIME'	,6);
define('ARCHIVE_FOLDER'		,7);
define('ARCHIVE_TAG'		,8);
define('ARCHIVE_TITLE'		,9);
define('ARCHIVE_CONTENT'	,10);

define('CASE_FILE_ID'		,'case');
define('CASE_UID'		,0);
define('CASE_STAFF_ID'		,1);
define('CASE_CLIENT_ID'		,2);
define('CASE_OPENED_TIME'	,3);
define('CASE_OPENED_STAFF_ID'	,4);
define('CASE_PREDESTINATE_TIME'	,5);
define('CASE_TAKING_TIME'	,6);
define('CASE_ARCHIVE_FOLDER'	,7);
define('CASE_TAG'		,8);
define('CASE_TITLE'		,9);
define('CASE_CONTENT'		,10);

define('CASE_REPLY_FILE_ID'		,'reply');
define('CASE_REPLY_UID'			,0);
define('CASE_REPLY_TYPE'		,1);
define('CASE_REPLY_STAFF_ID'		,2);
define('CASE_REPLY_TIME'		,3);
define('CASE_REPLY_ATTACHMENTS_IDS'	,4);
define('CASE_REPLY_CONTENT'		,5);

define('CASE_REPLY_TYPE_STAFF'	,0);
define('CASE_REPLY_TYPE_SYSTEM'	,1);

define('ATTACHMENTS_FILE_ID'	,'attachments');
define('ATTACHMENTS_UID'	,0);
define('ATTACHMENTS_FOLLOW_UID'	,1);
define('ATTACHMENTS_TIME'	,2);
define('ATTACHMENTS_NAME'	,3);
define('ATTACHMENTS_TYPE'	,4);
define('ATTACHMENTS_SIZE'	,5);
define('ATTACHMENTS_EXTENSION'	,6);
define('ATTACHMENTS_FILE_NAME'	,7);

define('GROUP_FILE_ID'		,'group');
define('GROUP_UID'		,0);
define('GROUP_NAME'		,1);
define('GROUP_RING'		,2);

define('STAFF_FILE_ID'		,'staff');
define('STAFF_UID'		,0);
define('STAFF_STATUS'		,1);
define('STAFF_GROUP_ID'		,2);
define('STAFF_ACCOUNT'		,3);
define('STAFF_PASSWORD'		,4);
define('STAFF_NAME'		,5);
define('STAFF_TELEPHONE'	,6);

define('CATEGORY_FILE_ID'	,'category');
define('CATEGORY_UID'		,0);
define('CATEGORY_NAME'		,1);

define('PAGE_TOTAL_ROWS'	,0);
define('PAGE_LIST_ROWS'		,1);
define('PAGE_CURRENT'		,2);
define('PAGE_COUNT'		,3);
define('PAGE_BEGIN_ROW'		,4);
define('PAGE_LIMIT_ROW'		,5);
define('PAGE_BEGIN_ROW_N'	,6);
define('PAGE_LIMIT_ROW_N'	,7);

define('ERROR_UNKNOWN_STAFF'	,1);
define('ERROR_NO_RING'		,2);
define('ERROR_ARGUMENTS'	,3);
define('ERROR_DUMP_FILE'	,4);
define('ERROR_MUST_EXIST'	,5);
define('ERROR_IN_USE'		,6);
define('ERROR_UNKNOWN_ID'	,7);
define('ERROR_LOAD_FILE'	,8);
define('ERROR_ACCOUNT_EXIST'	,9);
define('ERROR_NO_DEFAULT_GROUP'	,10);

define('RING_GROUP_INSERT'	,0);
define('RING_GROUP_SAVE'	,1);
define('RING_GROUP_DELETE'	,2);
define('RING_GROUP_DEFAULT'	,3);
define('RING_STAFF_INSERT'	,4);
define('RING_STAFF_SAVE'	,5);
define('RING_STAFF_DELETE'	,6);
define('RING_STAFF_CHANGE_PWD'	,7);
define('RING_STAFF_CHANGE_GRP'	,8);
define('RING_CATEGORY_INSERT'	,9);
define('RING_CATEGORY_SAVE'	,10);
define('RING_CATEGORY_DELETE'	,11);
define('RING_CASE_INSERT'	,12);
define('RING_CASE_SAVE'		,13);
define('RING_CASE_DELETE'	,14);
define('RING_CASE_TAKE'		,15);
define('RING_CASE_RETURN'	,16);
define('RING_CASE_CLOSE'	,17);
define('RING_ARCHIVE_SAVE'	,18);
define('RING_ARCHIVE_DELETE'	,19);
define('RING_CLIENT_INSERT'	,20);
define('RING_CLIENT_SAVE'	,21);
define('RING_CLIENT_DELETE'	,22);
define('RING_CLIENT_ATTACHMENTS',23);
define('RING_SUPPLIER_INSERT'	,24);
define('RING_SUPPLIER_SAVE'	,25);
define('RING_SUPPLIER_DELETE'	,26);
define('RING_SUPPLIER_ATTACHMENTS',27);
define('RING_STANDBY_INSERT'	,28);
define('RING_STANDBY_SAVE'	,29);
define('RING_STANDBY_DELETE'	,30);
define('RING_STANDBY_ATTACHMENTS',31);
define('RING_EXPIRED_INSERT'	,32);
define('RING_EXPIRED_SAVE'	,33);
define('RING_EXPIRED_DELETE'	,34);
define('RING_EXPIRED_ATTACHMENTS',35);
define('RING_SALE_INSERT'	,36);
define('RING_SALE_SAVE'		,37);
define('RING_SALE_DELETE'	,38);
define('RING_SALE_ATTACHMENTS'	,39);
define('RING_LEND_INSERT'	,40);
define('RING_LEND_SAVE'		,41);
define('RING_LEND_DELETE'	,42);
define('RING_LEND_ATTACHMENTS'	,43);
define('RING_LEND_RETURN'	,44);
define('RING_OUT_INSERT'	,45);
define('RING_OUT_SAVE'		,46);
define('RING_OUT_DELETE'	,47);
define('RING_OUT_ATTACHMENTS'	,48);
define('RING_REPAIR_INSERT'	,49);
define('RING_REPAIR_SAVE'	,50);
define('RING_REPAIR_DELETE'	,51);
define('RING_REPAIR_ATTACHMENTS',52);
define('RING_REPAIR_RETURN'	,53);
define('RING_REPAIR_ARCHIVE_SAVE'	,54);
define('RING_REPAIR_ARCHIVE_DELETE'	,55);
define('RING_FILE_INSERT'	,56);
define('RING_FILE_SAVE'		,57);
define('RING_FILE_DELETE'	,58);
define('RING_FILE_ATTACHMENTS'	,59);
define('RING_MARK_INSERT'	,60);
define('RING_MARK_SAVE'		,61);
define('RING_MARK_DELETE'	,62);
define('RING_MARK_ATTACHMENTS'	,63);
define('RING_LENGTH'		,64);


?>