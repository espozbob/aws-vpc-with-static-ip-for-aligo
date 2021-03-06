<?php
/**************** 문자전송하기 예제 ******************/
/* "result_code":결과코드,"message":결과문구, */
/* "msg_id":메세지ID,"error_cnt":에러갯수,"success_cnt":성공갯수 */
/* 동일내용 > 전송용 입니다.  
/******************** 인증정보 ********************/
$sms_url = "https://apis.aligo.in/send/"; // 전송요청 URL
$sms['user_id'] = "userid"; // SMS 아이디
$sms['key'] = "abcedg123456";//인증키
/******************** 인증정보 ********************/

/******************** 전송정보 ********************/
$_POST['msg'] = '%고객명%님. 안녕하세요. API TEST SEND'; // 메세지 내용
$_POST['receiver'] = '01111111111,01111111112'; // 수신번호
$_POST['destination'] = '01111111111|담당자,01111111112|홍길동'; // 수신인 %고객명% 치환
$_POST['sender'] ="1833-7442"; // 발신번호
$_POST['rdate'] = ''; // 예약일자 - 20161004 : 2016-10-04일기준
$_POST['rtime'] = ''; // 예약시간 - 1930 : 오후 7시30분
$_POST['testmode_yn'] = 'Y'; // Y 인경우 실제문자 전송X , 자동취소(환불) 처리
$_POST['subject'] = '제목입력'; //  LMS, MMS 제목 (미입력시 본문중 44Byte 또는 엔터 구분자 첫라인)
// $_POST['image'] = '/tmp/pic_57f358af08cf7_sms_.jpg'; // MMS 이미지 파일 위치
/******************** 전송정보 ********************/

$sms['msg'] = stripslashes($_POST['msg']);
$sms['receiver'] = $_POST['receiver'];
$sms['destination'] = $_POST['destination'];
$sms['sender'] = $_POST['sender'];
$sms['rdate'] = $_POST['rdate'];
$sms['rtime'] = $_POST['rtime'];
$sms['testmode_yn'] = empty($_POST['testmode_yn']) ? '' : $_POST['testmode_yn'];
$sms['title'] = $_POST['subject'];
// 이미지 전송시
if(!empty($_POST['image'])) {
	if(file_exists($_POST['image'])) {
		$tmpFile = explode('/',$_POST['image']);
		$str_filename = $tmpFile[sizeof($tmpFile)-1];
		$tmp_filetype = 'image/jpeg';

		if ((version_compare(PHP_VERSION, '5.5') >= 0)) {
			$sms['image'] = new CURLFile($_POST['image']['tmp_name'], $tmp_filetype, $str_filename);
			curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, true);
		} else {
			$sms['image'] = '@'.$_POST['image']['tmp_name'].';filename='.$str_filename. ';type='.$tmp_filetype;
		}

	}
}
/*****/

$host_info = explode("/", $sms_url);
$port = $host_info[0] == 'https:' ? 443 : 80;

$oCurl = curl_init();
curl_setopt($oCurl, CURLOPT_PORT, $port);
curl_setopt($oCurl, CURLOPT_URL, $sms_url);
curl_setopt($oCurl, CURLOPT_POST, 1);
curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($oCurl, CURLOPT_POSTFIELDS, $sms);
curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
$ret = curl_exec($oCurl);
curl_close($oCurl);

echo $ret;
$retArr = json_decode($ret); // 결과배열
// print_r($retArr);
