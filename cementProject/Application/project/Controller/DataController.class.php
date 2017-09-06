<?php
/**
 * Created by PhpStorm.
 * User: XH
 * Date: 2017/1/12
 * Time: 14:15
 */

namespace project\Controller;
use Think\Controller;

class DataController extends Controller
{
    public function dataReceive(){
        date_default_timezone_set('PRC');
        $recordString = file_get_contents('php://input');//接收wife socket过来的数据
        $record = json_decode($recordString); //json解析并且下面分别得到三个数据键值
        $identifier=$record->id;
        $simNumber=$record->sim;
        $location=$record->lo;
        $isLack=$record->st;
        $time=date("Y-m-d H:i:s",time());
        $data=M("data");
        $conditon["identifier"]=$identifier;
        $conditon["simNumber"]=$simNumber;
        $conditon["location"]=$location;
        $conditon["isLack"]=$isLack;
        $conditon["uploadTime"]=$time;
        $data->data($conditon)->add();
        $file="log.txt";
        $succeed=array("time"=>$time,"icon"=>"接收成功","identifier"=>$identifier," ","simNumber"=>$simNumber," ","location"=>$location," ","isLack"=>$isLack,"\n");
        $fail=array("time"=>$time,"icon"=>"接收失败","\n");
        if(!$data){
            file_put_contents($file,$fail,FILE_APPEND);
            throw new Exception("could not insert data");
        }else{
            file_put_contents($file,$succeed,FILE_APPEND);
        }
    }


    public function socketReceive(){
        /**
         *  PHP Socket Server
         * */
        header('Content-Type:text/html; charset=utf-8;');
        $table=M('Data');
        $file="log.txt";//用于测试的记录文件
        //确保客户端连接时不会超时
        error_reporting(0);
        set_time_limit(0);
        //设置地址与端口
        $address = '10.228.82.198'; //服务端ip
        $port = 8083;//端口号
        //创建socket：AF_INET=是ipv4 如果用ipv6，则参数为 AF_INET6 ， SOCK_STREAM为socket的tcp类型，如果是UDP则使用SOCK_DGRAM
        $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("socket_create() failed : ".socket_strerror(socket_last_error()). "\n");
       //阻塞模式
       socket_set_block($sock) or die("socket_set_block() failed : ".socket_strerror(socket_last_error()) ."\n");
        //绑定到socket端口
        $result = socket_bind($sock, $address, $port) or die("socket_bind() failed : ". socket_strerror(socket_last_error()) . "\n");
        //开始监听
        $result = socket_listen($sock, 4) or die("socket_listen() failed : ". socket_strerror(socket_last_error()) . "\n");
        if($result){
            file_put_contents($file,"开始监听,",FILE_APPEND);
        }

        do {//Never stop the daemon
            //它接收连接请求并调用一个子链接socket来处理客户端和服务器间的信息
            $msgsock = socket_accept($sock) or die("sock_accept() failed : ". socket_strerror(socket_last_error()) . "\n");
            if($msgsock){
                file_put_contents($file,"连接成功,",FILE_APPEND);
            }else{
                file_put_contents($file,"连接失败,".socket_strerror(socket_last_error()),FILE_APPEND);
            }
            //读取客户端数据
            $buf = socket_read($msgsock, 8192);
            if($buf){//如果读取客户端数据成功
              $time=date("Y-m-d H:i:s");
              $pattern="/^(N|Y)\d{15}/";//接收数据的模式：第一位是N/Y，后面15位是数字
              if(preg_match($pattern, $buf)&&(strlen($buf)==17)){
                  file_put_contents($file,"收到的数据为：$buf ".$time."\n\t",FILE_APPEND);
                  $flag=substr($buf,0,1);//拿到收到数据的第一位是否缺料标志
                  $simCard=substr($buf,1,15);//拿到后15位sim卡卡号  
                  $search=$table->where("simNumber='$simCard'")->find();
                  $queryTime=$search["lacktime"]; //拿到缺料时间的字段值
                  if($search){//如果sim卡号已经存在，则更新
                      if($flag=="Y"){
                          $isLack="是";
                         if($queryTime==null){
                            $conditon1['lackTime']=$time;//只记录第一次检测到缺料的时间
                           }else{
                              $conditon1['lackTime']=$queryTime;//不是第一次检测到缺料则保持缺料时间不变
                             }  
                      }else{
                          $isLack="否";
                          $conditon1['lackTime']=null;//缺料时间置空
                          }
                      $conditon1['isLack']=$isLack;
                      $conditon1['uploadTime']=$time;
                      $update=$table->where("simNumber='$simCard'")->setField($conditon1);
                  }elseif ($search==NULL) {//如果不存在，则存入
                          if($flag=="Y"){
                             $isLack="是";
                             $conditon2['lackTime']=$time;  
                          }else{
                             $isLack="否";
                             $conditon2['lackTime']=null;  
                          }
                      $conditon2['isLack']=$isLack;
                      $conditon2['uploadTime']=$time;   
                      $conditon2['simNumber']=$simCard;
                      $save=$table->add($conditon2);
                      }

                }else{
                   $len=strlen($buf);
                   file_put_contents($file,"收到的数据乱码,数据为：$buf 位数为：$len ".$time."\n\t",FILE_APPEND);
                     }
            //数据传输，向客户端写入返回结果
              $msg = "succeed";
              socket_write($msgsock, $msg, strlen($msg)) or die("socket_write() failed : ". socket_strerror(socket_last_error()). "\n");
              //输出返回到客户端时，父/子socket都应通过socket_close来终止
              socket_close($msgsock);  
            }else{
                 file_put_contents($file,"读取数据失败,".socket_strerror(socket_last_error()),FILE_APPEND);
                socket_close($msgsock);  

            }
            
        }while(true);

        socket_close($sock);//关闭socket

    }

//返回给dataTable的所有监测工地混泥砂浆罐信息
    public function allCansInfo(){
        $table=M('Data');
        $info=$table->field("number,id,worksite,location,longitude,latitude,isLack,lackTime,uploadTime")->select();
        $array=array('data' => $info );
        $this->ajaxReturn($array,"json");
    }
    
 //返回给audio的关于混泥砂浆罐是否缺料的信息
   public function lackInfo(){
        $table=M('Data');
        $info=$table->field("isLack")->select();
        $array=array('data' => $info );
        $this->ajaxReturn($array,"json");
    }

//返回给baidu地图的所有监测工地混泥砂浆罐信息
    public function dataForMap(){
        $table=M('Data');
        $info=$table->where("isLack='是'")->field("location,worksite,id,longitude,latitude")->select();
        $array=array('data' => $info );
        $this->ajaxReturn($array,"json");
    }
}