<?php

namespace App\Helpers;

use Cache;
use DB;
use Image;
use Request;
use Route;
use Schema;
use Session;
use Storage;
use Validator;
use App\Models\Settings;
use DateTime;
use App\Models\AdminUser;

class CommonHelper
{
    /**
     *  Comma-delimited data output from the child table
     */
     public static function first($table, $id)
    {
        $table = self::parseSqlTable($table)['table'];
        if (is_array($id)) {
            $first = DB::table($table);
            foreach ($id as $k => $v) {
                $first->where($k, $v);
            }

            return $first->first();
        } else {
            $pk = self::pk($table);

            return DB::table($table)->where($pk, $id)->first();
        }
    }
    public static function getSetting($name)
    {
        // if (Cache::has('setting_'.$name)) {
        //     return Cache::get('setting_'.$name);
        // }

        $query = DB::table('admin_settings')->select($name)->first();
        if(!empty($query))
        {
            Cache::forever('setting_'.$name, $query->$name);

            return $query->$name;
        }
       
    }
    public static function sendEmail($config = [])
    {
      
        $to = $config['to'];
        $data = $config['data'];
        $template = $config['template'];

        $template = CommonHelper::first('cms_email_templates', ['slug' => $template]);

        if(!empty($config['content']))
        {
            $html = $config['content'];
        }
        else{
            $html = $template->content;
        }
       
        $subject = $template->subject;
        foreach ($data as $key => $val) {
            $html = str_replace('['.$key.']', $val, $html);
            $template->subject = str_replace('['.$key.']', $val, $template->subject);
            $subject = str_replace('['.$key.']', $val, $subject);
        }
        $attachments = (!empty($config['attachments'])) ?$config['attachments']: [];
        $setting_dtls = Settings::find(1);
        $logo =  $setting_dtls->logo;

        if (!empty($config['send_at'])) {
            $a = [];
            $a['send_at'] = $config['send_at'];
            $a['email_recipient'] = $to;
            $a['email_from_email'] = $template->from_email ?: CommonHelper::getSetting('email_sender');
            $a['email_from_name'] = $template->from_name ?: CommonHelper::getSetting('appname');
            $a['email_cc_email'] = $template->cc_email;
            $a['email_subject'] = $subject;
            $a['email_content'] = $html;
            $a['email_attachments'] = serialize($attachments);
            $a['is_sent'] = 0;
            DB::table('cms_email_queues')->insert($a);

            return true;
        }
        //dd($html);

        \Mail::send("admin.emails.email_template", ['content' => $html,'logo'=>$logo], function ($message) use ($to, $subject, $template, $attachments) {
            $message->priority(1);
            $message->to($to);

            if ($template->from_email) {
                $from_name = ($template->from_name) ?: AdminHelper::getSetting('appname');
                $message->from($template->from_email, $from_name);
            }

            if ($template->cc_email) {
                $message->cc($template->cc_email);
            }

            if (count($attachments)) {
                foreach ($attachments as $attachment) {
                    $message->attach($attachment);
                }
            }

            $message->subject($subject);
        });
    }
    public static function sendEmailOrder($config = [])
    {
      
        $to = $config['to'];
        $data = $config['data'];
        $template = $config['template'];

        $template = CommonHelper::first('cms_email_templates', ['slug' => $template]);

        if(!empty($config['content']))
        {
            $html = $config['content'];
        }
        else{
            $html = $template->content;
        }
       
        $subject = $template->subject;
        foreach ($data as $key => $val) {
            $html = str_replace('['.$key.']', $val, $html);
            $template->subject = str_replace('['.$key.']', $val, $template->subject);
            $subject = str_replace('['.$key.']', $val, $subject);
        }
        $attachments = (!empty($config['attachments'])) ?$config['attachments']: [];
        $setting_dtls = Settings::find(1);
        $logo =  $setting_dtls->logo;

        if (!empty($config['send_at'])) {
            $a = [];
            $a['send_at'] = $config['send_at'];
            $a['email_recipient'] = $to;
            $a['email_from_email'] = $template->from_email ?: CommonHelper::getSetting('email_sender');
            $a['email_from_name'] = $template->from_name ?: CommonHelper::getSetting('appname');
            $a['email_cc_email'] = $template->cc_email;
            $a['email_subject'] = $subject;
            $a['email_content'] = $html;
            $a['email_attachments'] = serialize($attachments);
            $a['is_sent'] = 0;
            DB::table('cms_email_queues')->insert($a);

            return true;
        }
        //dd($html);

        \Mail::send("emails.email_template_order", ['content' => $html,'logo'=>$logo], function ($message) use ($to, $subject, $template, $attachments) {
            $message->priority(1);
            $message->to($to);

            if ($template->from_email) {
                $from_name = ($template->from_name) ?: AdminHelper::getSetting('appname');
                $message->from($template->from_email, $from_name);
            }

            if ($template->cc_email) {
                $message->cc($template->cc_email);
            }

            if (count($attachments)) {
                foreach ($attachments as $attachment) {
                    $message->attach($attachment);
                }
            }

            $message->subject($subject);
        });
    }


      /*-------------------------------For Stock Logs-----------------------*/
      public static function insertLogStock($seller_id,$product_id,$description, $details = '')
      {
          //if (AdminHelper::getSetting('api_debug_mode')) {
              $a = [];
              $a['created_at'] = date('Y-m-d H:i:s');
              $a['ipaddress'] = $_SERVER['REMOTE_ADDR'];
              $a['useragent'] = $_SERVER['HTTP_USER_AGENT'];
              $a['url'] = Request::url();
              $a['description'] = $description;
              $a['details'] = $details;
              $a['created_by'] = $seller_id;
              $a['seller_id'] = $seller_id;
              $a['product_id'] = $product_id;
              $a['stock_type'] = 1;
              DB::table('stock_logs')->insert($a);
          //}
      }
       public static function insertLogStockData($design_id,$created_by,$description,$stock_type,$qty, $changed_qty, $details = '')
      {
          //if (AdminHelper::getSetting('api_debug_mode')) {
              $a = [];
              $a['created_at'] = date('Y-m-d H:i:s');
              $a['ipaddress'] = $_SERVER['REMOTE_ADDR'];
              $a['useragent'] = $_SERVER['HTTP_USER_AGENT'];
              $a['url'] = Request::url();
              $a['description'] = $description;
              $a['details'] = $details;
              $a['created_by'] = $created_by;
              $a['design_id'] = $design_id;
              $a['stock_type'] = $stock_type;
              $a['quantity'] = $qty;
              $a['current_quantity'] = $changed_qty;
              DB::table('stock_logs')->insert($a);
              
          //}
      }
      /*-------------------------------For Stock Logs End-------------------*/


    public static function sendNotification($config = [])
    {
        $content = $config['content'];
        $to = $config['to'];
        $users_id = (!empty($config['users_id']))?$config['users_id']:[];     
        if(!empty($users_id))   
        {
            foreach ($users_id as $id) {
                $a = [];
                $a['user_id'] = $id;
                $a['content'] = $content;
                $a['url'] = $to;
                $a['is_read'] = 0;
                $a['created_at'] = date('Y-m-d H:i:s');
                
                DB::table('notifications')->insert($a);
            }
        }
        

        return true;
    }


    public static function parseSqlTable($table)
    {

        $f = explode('.', $table);

        if (count($f) == 1) {
            return ["table" => $f[0], "database" => config('crudbooster.MAIN_DB_DATABASE')];
        } elseif (count($f) == 2) {
            return ["database" => $f[0], "table" => $f[1]];
        } elseif (count($f) == 3) {
            return ["table" => $f[0], "schema" => $f[1], "table" => $f[2]];
        }

        return false;
    }
   public static function dateFormat($date)
   {
        return date('Y-m-d', strtotime($date));
   }

   public static function dateTimeFormat($date)
   {
        return date('Y-m-d h:i A', strtotime($date));
   }

  
   public static function useAgeinYear($date)
   {
        $from = new DateTime($date);
        $to   = new DateTime('today');
        return $from->diff($to)->y;
   }
   

    public static function encrypt($plainText,$key)
    {
        $secretKey = CommonHelper::hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = openssl_encrypt($plainText, "AES-128-CBC", $secretKey, OPENSSL_RAW_DATA, $initVector);
        $encryptedText = bin2hex($encryptedText);
        return $encryptedText;
   }
   public static function decrypt($encryptedText,$key)
   {
        $secretKey         = CommonHelper::hextobin(md5($key));
        $initVector         =  pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText      = hextobin($encryptedText);
        $decryptedText         =  openssl_decrypt($encryptedText,"AES-128-CBC", $secretKey, OPENSSL_RAW_DATA, $initVector);
        return $decryptedText;
   }
    //*********** Padding Function *********************
    public static function pkcs5_pad ($plainText, $blockSize)
    {
        $pad = $blockSize - (strlen($plainText) % $blockSize);
        return $plainText . str_repeat(chr($pad), $pad);
    }
     //********** Hexadecimal to Binary function for php 4.0 version ********
    public static function hextobin($hexString) 
   { 
    $length = strlen($hexString);
    $binString = "";
    $count = 0;
    while ($count < $length) {
        $subString = substr($hexString, $count, 2);
        $packedString = pack("H*", $subString);
        if ($count == 0) {
            $binString = $packedString;
        } 
        else {
            $binString .= $packedString;
        }
        
        $count += 2;
    }
    return $binString;
    } 
    

   
}

