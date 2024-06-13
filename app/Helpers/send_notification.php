<?php


function SendNotificationHelper( $receivers=[] ,$title = '',$body = '',$ref='',$type=0,$image=""){
  //ios understand data object but android understand notification object
  


  $headers = array
  (
      'Authorization: key=' . DB::table('settings')->find(11)->value,
      'Content-Type: application/json'
  );

  $ch_2 = curl_init();

  
  $curl=json_encode(array(
      'notification'=> array(
          'title'     => $title,
          'body'      => $body,
      ),
      'priority'=> 'high',
      "registration_ids" => $receivers,

      "data" => array(
              "title" => $title,
              "reference_id" => $ref,
              "image" => $image,
              "type_n"=>$type
          )
  ));
  curl_setopt($ch_2, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
  curl_setopt($ch_2, CURLOPT_POST, true);
  curl_setopt($ch_2, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch_2, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch_2, CURLOPT_POSTFIELDS,$curl );
  $result[] = curl_exec($ch_2);
  $result[]=$receivers;

  curl_close($ch_2);
  // dd($result);
  return $result;


}