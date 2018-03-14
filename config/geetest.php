<?php
return [

	/*
	|--------------------------------------------------------------------------
	| Config Language
	|--------------------------------------------------------------------------
	|
	| Here you can config your yunpian api key from yunpian provided.
	|
	| Options: ['zh-cn', 'zh-tw', 'en', 'ja', 'ko']
	|
	*/
	'lang' => 'zh-cn',

	/*
	|--------------------------------------------------------------------------
	| Config Geetest Id
	|--------------------------------------------------------------------------
	|
	| Here you can config your yunpian api key from yunpian provided.
	|
	*/
	'geetest_id' => env('5f58829fa7196959f1c448a3113262c7'),

	/*
	|--------------------------------------------------------------------------
	| Config Geetest Key
	|--------------------------------------------------------------------------
	|
	| Here you can config your yunpian api key from yunpian provided.
	|
	*/
	'geetest_key' => env('3ad56ae832457e45a18a187142833ae0'),

	/*
	|--------------------------------------------------------------------------
	| Config Geetest URL
	|--------------------------------------------------------------------------
	|
	| Here you can config your geetest url for ajax validation.
	|
	*/
	'geetest_url' => 'auth/geetest',

	/*
	|--------------------------------------------------------------------------
	| Config Client Fail Alert Text
	|--------------------------------------------------------------------------
	|
	| Here you can config the alert text when it failed in client.
	|
	*/
	'client_fail_alert' => '请正确完成验证码操作',

	/*
	|--------------------------------------------------------------------------
	| Config Server Fail Alert
	|--------------------------------------------------------------------------
	|
	| Here you can config the alert text when it failed in server (two factor validation).
	|
	*/
	'server_fail_alert' => '验证码校验失败',


];